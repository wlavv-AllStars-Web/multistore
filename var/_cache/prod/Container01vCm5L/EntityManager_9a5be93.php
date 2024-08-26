<?php

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{
    private $valueHolder6c09a = null;
    private $initializerbd672 = null;
    private static $publicProperties5464e = [
        
    ];
    public function getConnection()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getConnection', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->getConnection();
    }
    public function getMetadataFactory()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getMetadataFactory', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->getMetadataFactory();
    }
    public function getExpressionBuilder()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getExpressionBuilder', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->getExpressionBuilder();
    }
    public function beginTransaction()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'beginTransaction', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->beginTransaction();
    }
    public function getCache()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getCache', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->getCache();
    }
    public function transactional($func)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'transactional', array('func' => $func), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->transactional($func);
    }
    public function wrapInTransaction(callable $func)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'wrapInTransaction', array('func' => $func), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->wrapInTransaction($func);
    }
    public function commit()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'commit', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->commit();
    }
    public function rollback()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'rollback', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->rollback();
    }
    public function getClassMetadata($className)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getClassMetadata', array('className' => $className), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->getClassMetadata($className);
    }
    public function createQuery($dql = '')
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'createQuery', array('dql' => $dql), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->createQuery($dql);
    }
    public function createNamedQuery($name)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'createNamedQuery', array('name' => $name), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->createNamedQuery($name);
    }
    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->createNativeQuery($sql, $rsm);
    }
    public function createNamedNativeQuery($name)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->createNamedNativeQuery($name);
    }
    public function createQueryBuilder()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'createQueryBuilder', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->createQueryBuilder();
    }
    public function flush($entity = null)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'flush', array('entity' => $entity), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->flush($entity);
    }
    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->find($className, $id, $lockMode, $lockVersion);
    }
    public function getReference($entityName, $id)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->getReference($entityName, $id);
    }
    public function getPartialReference($entityName, $identifier)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->getPartialReference($entityName, $identifier);
    }
    public function clear($entityName = null)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'clear', array('entityName' => $entityName), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->clear($entityName);
    }
    public function close()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'close', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->close();
    }
    public function persist($entity)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'persist', array('entity' => $entity), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->persist($entity);
    }
    public function remove($entity)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'remove', array('entity' => $entity), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->remove($entity);
    }
    public function refresh($entity)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'refresh', array('entity' => $entity), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->refresh($entity);
    }
    public function detach($entity)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'detach', array('entity' => $entity), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->detach($entity);
    }
    public function merge($entity)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'merge', array('entity' => $entity), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->merge($entity);
    }
    public function copy($entity, $deep = false)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->copy($entity, $deep);
    }
    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->lock($entity, $lockMode, $lockVersion);
    }
    public function getRepository($entityName)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getRepository', array('entityName' => $entityName), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->getRepository($entityName);
    }
    public function contains($entity)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'contains', array('entity' => $entity), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->contains($entity);
    }
    public function getEventManager()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getEventManager', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->getEventManager();
    }
    public function getConfiguration()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getConfiguration', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->getConfiguration();
    }
    public function isOpen()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'isOpen', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->isOpen();
    }
    public function getUnitOfWork()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getUnitOfWork', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->getUnitOfWork();
    }
    public function getHydrator($hydrationMode)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->getHydrator($hydrationMode);
    }
    public function newHydrator($hydrationMode)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->newHydrator($hydrationMode);
    }
    public function getProxyFactory()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getProxyFactory', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->getProxyFactory();
    }
    public function initializeObject($obj)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'initializeObject', array('obj' => $obj), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->initializeObject($obj);
    }
    public function getFilters()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'getFilters', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->getFilters();
    }
    public function isFiltersStateClean()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'isFiltersStateClean', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->isFiltersStateClean();
    }
    public function hasFilters()
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, 'hasFilters', array(), $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        return $this->valueHolder6c09a->hasFilters();
    }
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;
        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);
        $instance->initializerbd672 = $initializer;
        return $instance;
    }
    protected function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, \Doctrine\Common\EventManager $eventManager)
    {
        static $reflection;
        if (! $this->valueHolder6c09a) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolder6c09a = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
        }
        $this->valueHolder6c09a->__construct($conn, $config, $eventManager);
    }
    public function & __get($name)
    {
        $this->initializerbd672 && ($this->initializerbd672->__invoke($valueHolder6c09a, $this, '__get', ['name' => $name], $this->initializerbd672) || 1) && $this->valueHolder6c09a = $valueHolder6c09a;
        if (isset(self::$publicProperties5464e[$name])) {
            return $this->valueHolder6c09a->$name;
        }
        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');
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
        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');
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
        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');
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
        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');
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
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
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
