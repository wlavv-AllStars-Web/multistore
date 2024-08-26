<?php
/**
 * Copyright ETS Software Technology Co., Ltd
 *
 * NOTICE OF LICENSE
 *
 * This file is not open source! Each license that you purchased is only available for 1 website only.
 * If you want to use this file on more websites (or projects), you need to purchase additional licenses.
 * You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.
 *
 * @author ETS Software Technology Co., Ltd
 * @copyright  ETS Software Technology Co., Ltd
 * @license    Valid for 1 website (or project) for each purchase of license
 */

namespace Hybridauth;

if (!defined('_PS_VERSION_')) { exit; }
use Hybridauth\Exception\InvalidArgumentException;
use Hybridauth\Exception\UnexpectedValueException;
use Hybridauth\Storage\StorageInterface;
use Hybridauth\Logger\LoggerInterface;
use Hybridauth\Logger\Logger;
use Hybridauth\HttpClient\HttpClientInterface;

/**
 * Hybridauth\Hybridauth
 *
 * For ease of use of multiple providers, Hybridauth implements the class Hybridauth\Hybridauth,
 * a sort of factory/façade which acts as an unified interface or entry point, and it expects a
 * configuration array containing the list of providers you want to use, their respective credentials
 * and authorized callback.
 */
class Hybridauth
{
    /**
    * Hybridauth config.
    *
    * @var array
    */
    protected $config;

    /**
    * Storage.
    *
    * @var StorageInterface
    */
    protected $storage;

    /**
    * HttpClient.
    *
    * @var HttpClientInterface
    */
    protected $httpClient;

    /**
    * Logger.
    *
    * @var LoggerInterface
    */
    protected $logger;

    /**
    * @param array|string        $config     Array with configuration or Path to PHP file that will return array
    * @param HttpClientInterface $httpClient
    * @param StorageInterface    $storage
    * @param LoggerInterface     $logger
    *
    * @throws InvalidArgumentException
    */
    public function __construct(
        $config,
        HttpClientInterface $httpClient = null,
        StorageInterface $storage = null,
        LoggerInterface $logger = null
    ) {
        if (is_string($config) && file_exists($config)) {
            $config = include $config;
        } elseif (! is_array($config)) {
            throw new InvalidArgumentException('Hybridauth config does not exist on the given path.');
        }

        $this->config = $config + array(
            'debug_mode'   => Logger::NONE,
            'debug_file'   => '',
            'curl_options' => null,
            'providers'    => array()
        );
        $this->storage = $storage;
        $this->logger = $logger;
        $this->httpClient = $httpClient;
    }
    /**
    * Instantiate the given provider and authentication or authorization protocol.
    *
    * If not authenticated yet, the user will be redirected to the provider's site for
    * authentication/authorisation, otherwise it will simply return an instance of
    * provider's adapter.
    *
    * @param string $name adapter's name (case insensitive)
    *
    * @return \Hybridauth\Adapter\AdapterInterface
    * @throws InvalidArgumentException
    * @throws UnexpectedValueException
    */
    public function authenticate($name)
    {
        $adapter = $this->getAdapter($name);
        $adapter->authenticate();
        return $adapter;
    }

    /**
    * Returns a new instance of a provider's adapter by name
    *
    * @param string $name adapter's name (case insensitive)
    *
    * @return \Hybridauth\Adapter\AdapterInterface
    * @throws InvalidArgumentException
    * @throws UnexpectedValueException
    */
    public function getAdapter($name)
    {
        $config = $this->getProviderConfig($name);
        if (!$config)
            return false;
        $adapter = isset($config['adapter']) ? $config['adapter'] : sprintf('Hybridauth\\Provider\\%s', $name);
        if (!class_exists($adapter)) {
		    $adapter = null;
		    $fs = new \FilesystemIterator(dirname(__FILE__) . '/Provider/');
		    /** @var \SplFileInfo $file */
		    foreach ($fs as $file) {
			    if (!$file->isDir()) {
				    $provider = strtok($file->getFilename(), '.');
				    if ($name === mb_strtolower($provider)) {
					    $adapter = sprintf('Hybridauth\\Provider\\%s', $provider);
					    break;
				    }
			    }
		    }
                    
		    if ($adapter === null) {
			    throw new InvalidArgumentException('Unknown Provider.');
		    }
	    }
        return new $adapter($config, $this->httpClient, $this->storage, $this->logger);
    }

    /**
    * Get provider config by name.
    *
    * @param string $name adapter's name (case insensitive)
    *
    * @throws UnexpectedValueException
    * @throws InvalidArgumentException
    *
    * @return array
    */
    public function getProviderConfig($name)
    {
        $name = \Tools::strtolower($name);

        $providersConfig = array_change_key_case($this->config['providers'], CASE_LOWER);

        if (! isset($providersConfig[$name])) {
            return false;
            //throw new InvalidArgumentException('Unknown Provider.');
        }

        if (! $providersConfig[$name]['enabled']) {
            return false;
            //throw new UnexpectedValueException('Disabled Provider.');
        }

        $config = $providersConfig[$name];

        if (! isset($config['callback']) && isset($this->config['callback'])) {
            $config['callback'] = $this->config['callback'];
        }

        return $config;
    }

    /**
    * Returns a boolean of whether the user is connected with a provider
    *
    * @param string $name adapter's name (case insensitive)
    *
    * @return boolean
    * @throws InvalidArgumentException
    * @throws UnexpectedValueException
    */
    public function isConnectedWith($name)
    {
        return $this->getAdapter($name)->isConnected();
    }

    /**
    * Returns a list of enabled adapters names
    *
    * @return array
    */
    public function getProviders()
    {
        $providers = array();
        foreach ($this->config['providers'] as $name => $config) {
            if ($config['enabled']) {
                $providers[] = $name;
            }
        }

        return $providers;
    }

    /**
    * Returns a list of currently connected adapters names
    *
    * @return array
    * @throws InvalidArgumentException
    * @throws UnexpectedValueException
    */
    public function getConnectedProviders()
    {
        $providers = array();

        foreach ($this->getProviders() as $name) {
            if ($this->isConnectedWith($name)) {
                 $providers[] = $name;
            }
        }

        return $providers;
    }

    /**
    * Returns a list of new instances of currently connected adapters
    *
    * @return \Hybridauth\Adapter\AdapterInterface[]
    * @throws InvalidArgumentException
    * @throws UnexpectedValueException
    */
    public function getConnectedAdapters()
    {
        $adapters = array();

        foreach ($this->getProviders() as $name) {
            $adapter = $this->getAdapter($name);

            if ($adapter->isConnected()) {
                $adapters[$name] = $adapter;
            }
        }

        return $adapters;
    }

    /**
    * Disconnect all currently connected adapters at once
    */
    public function disconnectAllAdapters()
    {
        foreach ($this->getProviders() as $name) {
            $adapter = $this->getAdapter($name);

            if ($adapter->isConnected()) {
                $adapter->disconnect();
            }
        }
    }

	/**
	 * Disconnect adapter currently connected adapters at once and not included $provider.
	 */
	public function disconnectAdapters($provider)
	{
		foreach ($this->getProviders() as $name) {
			if ($provider != $name){
				$adapter = $this->getAdapter($name);

				if ($adapter->isConnected()) {
					$adapter->disconnect();
				}
			}
		}
	}
}
