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

namespace Hybridauth\Logger;

if (!defined('_PS_VERSION_')) { exit; }
use Hybridauth\Exception\RuntimeException;
use Hybridauth\Exception\InvalidArgumentException;

/**
 * Debugging and Logging utility.
 */
class Logger implements LoggerInterface
{
    const NONE  = 'none';  // turn logging off
    const DEBUG = 'debug'; // debug, info and error messages
    const INFO  = 'info';  // info and error messages
    const ERROR = 'error'; // only error messages

    /**
     * Debug level.
     *
     * One of Logger::NONE, Logger::DEBUG, Logger::INFO, Logger::ERROR
     *
     * @var string
     */
    protected $level;

    /**
     * Path to file writeable by the web server. Required if $this->level !== Logger::NONE.
     *
     * @var string
     */
    protected $file;

    /**
     * @param bool|string $level One of Logger::NONE, Logger::DEBUG, Logger::INFO, Logger::ERROR
     * @param string      $file  File where to write messages
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function __construct($level, $file)
    {
        $this->level = self::NONE;

        if ($level && $level !== self::NONE) {
            $this->initialize($file);

            $this->level = $level === true ? Logger::DEBUG :  $level;
            $this->file = $file;
        }
    }

    /**
     * @param string $file
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    protected function initialize($file)
    {
        if (!$file) {
            throw new InvalidArgumentException('Log file is not specified.');
        }

        if (!file_exists($file) && !touch($file)) {
            throw new RuntimeException(sprintf('Log file %s cannot be created.', $file));
        }

        if (!is_writable($file)) {
            throw new RuntimeException(sprintf('Log file %s is not writeable.', $file));
        }
    }

    /**
     * @inheritdoc
     */
    public function info($message, array $context = array())
    {
        if (!in_array($this->level, array(self::DEBUG, self::INFO))) {
            return;
        }

        $this->log(self::INFO, $message, $context);
    }

    /**
     * @inheritdoc
     */
    public function debug($message, array $context = array())
    {
        if (!in_array($this->level, array(self::DEBUG))) {
            return;
        }

        $this->log(self::DEBUG, $message, $context);
    }

    /**
     * @inheritdoc
     */
    public function error($message, array $context = array())
    {
        if (!in_array($this->level, array(self::DEBUG, self::INFO, self::ERROR))) {
            return;
        }

        $this->log(self::ERROR, $message, $context);
    }

    /**
     * @inheritdoc
     */
    public function log($level, $message, array $context = array())
    {
        $datetime = new \DateTime();
        $datetime = $datetime->format(DATE_ATOM);

        $content = sprintf('%s -- %s -- %s -- %s', $level, $_SERVER['REMOTE_ADDR'], $datetime, $message);
        $content .= ($context ? "\n".print_r($context, true) : '');
        $content .= "\n";

        file_put_contents($this->file, $content, FILE_APPEND);
    }
}
