<?php

class ModuleRepository_091bb2f extends \PrestaShop\PrestaShop\Core\Module\ModuleRepository implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \PrestaShop\PrestaShop\Core\Module\ModuleRepository|null wrapped object, if the proxy is initialized
     */
    private $valueHolder6c09a = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializerbd672 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties5464e = [
        
    ];

    public function getList() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getList', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;

        return $this->valueHolder6c09a->getList();
    }

    public function getInstalledModules() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getInstalledModules', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;

        return $this->valueHolder6c09a->getInstalledModules();
    }

    public function getMustBeConfiguredModules() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getMustBeConfiguredModules', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;

        return $this->valueHolder6c09a->getMustBeConfiguredModules();
    }

    public function getUpgradableModules() : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getUpgradableModules', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;

        return $this->valueHolder6c09a->getUpgradableModules();
    }

    public function getModule(string $moduleName) : \PrestaShop\PrestaShop\Core\Module\ModuleInterface
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getModule', array('moduleName' => $moduleName), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;

        return $this->valueHolder6c09a->getModule($moduleName);
    }

    public function getModulePath(string $moduleName) : ?string
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getModulePath', array('moduleName' => $moduleName), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;

        return $this->valueHolder6c09a->getModulePath($moduleName);
    }

    public function setActionUrls(\PrestaShop\PrestaShop\Core\Module\ModuleCollection $collection) : \PrestaShop\PrestaShop\Core\Module\ModuleCollection
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'setActionUrls', array('collection' => $collection), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;

        return $this->valueHolder6c09a->setActionUrls($collection);
    }

    public function clearCache(?string $moduleName = null, bool $allShops = false) : bool
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'clearCache', array('moduleName' => $moduleName, 'allShops' => $allShops), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;

        return $this->valueHolder6c09a->clearCache($moduleName, $allShops);
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\PrestaShop\PrestaShop\Core\Module\ModuleRepository $instance) {
            unset($instance->moduleDataProvider, $instance->adminModuleDataProvider, $instance->hookManager, $instance->cacheProvider, $instance->modulePath, $instance->installedModules, $instance->modulesFromHook, $instance->contextLangId);
        }, $instance, 'PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository')->__invoke($instance);

        $instance->initializerbd672 = $initializer;

        return $instance;
    }

    public function __construct(\PrestaShop\PrestaShop\Adapter\Module\ModuleDataProvider $moduleDataProvider, \PrestaShop\PrestaShop\Adapter\Module\AdminModuleDataProvider $adminModuleDataProvider, \Doctrine\Common\Cache\CacheProvider $cacheProvider, \PrestaShop\PrestaShop\Adapter\HookManager $hookManager, string $modulePath, int $contextLangId)
    {
        static $reflection;

        if (! $this->valueHolder6c09a) {
            $reflection = $reflection ?? new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');
            $this->valueHolder6c09a = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\PrestaShop\PrestaShop\Core\Module\ModuleRepository $instance) {
            unset($instance->moduleDataProvider, $instance->adminModuleDataProvider, $instance->hookManager, $instance->cacheProvider, $instance->modulePath, $instance->installedModules, $instance->modulesFromHook, $instance->contextLangId);
        }, $this, 'PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository')->__invoke($this);

        }

        $this->valueHolder6c09a->__construct($moduleDataProvider, $adminModuleDataProvider, $cacheProvider, $hookManager, $modulePath, $contextLangId);
    }

    public function & __get($name)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, '__get', ['name' => $name], $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;

        if (isset(self::$publicProperties5464e[$name])) {
            return $this->valueHolder6c09a->$name;
        }

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder6c09a;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder6c09a;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, '__set', array('name' => $name, 'value' => $value), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder6c09a;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder6c09a;
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, '__isset', array('name' => $name), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder6c09a;

            return isset($targetObject->$name);
        }

        $targetObject = $this->valueHolder6c09a;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, '__unset', array('name' => $name), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;

        $realInstanceReflection = new \ReflectionClass('PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder6c09a;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $this->valueHolder6c09a;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, '__clone', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;

        $this->valueHolder6c09a = clone $this->valueHolder6c09a;
    }

    public function __sleep()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, '__sleep', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;

        return array('valueHolder6c09a');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\PrestaShop\PrestaShop\Core\Module\ModuleRepository $instance) {
            unset($instance->moduleDataProvider, $instance->adminModuleDataProvider, $instance->hookManager, $instance->cacheProvider, $instance->modulePath, $instance->installedModules, $instance->modulesFromHook, $instance->contextLangId);
        }, $this, 'PrestaShop\\PrestaShop\\Core\\Module\\ModuleRepository')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializerbd672 = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializerbd672;
    }

    public function initializeProxy() : bool
    {
        return $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'initializeProxy', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolder6c09a;
    }

    public function getWrappedValueHolderValue()
    {
        return $this->valueHolder6c09a;
    }
}
