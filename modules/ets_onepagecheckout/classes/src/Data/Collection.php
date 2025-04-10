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

namespace Hybridauth\Data;

if (!defined('_PS_VERSION_')) { exit; }
/**
 * A very basic Data collection.
 */
final class Collection
{
    /**
    * Data collection
    *
    * @var mixed
    */
    protected $collection = null;

    /**
    * @param mixed $data
    */
    public function __construct($data = null)
    {
        $this->collection = new \stdClass();

        if (is_object($data)) {
            $this->collection = $data;
        }

        $this->collection = (object) $data;
    }

    /**
    * Retrieves the whole collection as array
    *
    * @return mixed
    */
    public function toArray()
    {
        return (array) $this->collection;
    }

    /**
    * Retrieves an item
    *
    * @param $property
    *
    * @return mixed
    */
    public function get($property)
    {
        if ($this->exists($property)) {
            return $this->collection->$property;
        }

        return null;
    }

    /**
    * Add or update an item
    *
    * @param $property
    * @param mixed $value
    */
    public function set($property, $value)
    {
        if ($property) {
            $this->collection->$property = $value;
        }
    }

    /**
    * .. until I come with a better name..
    *
    * @param $property
    *
    * @return Collection
    */
    public function filter($property)
    {
        if ($this->exists($property)) {
            $data = $this->get($property);

            if (! is_a($data, 'Collection')) {
                $data = new Collection($data);
            }

            return $data;
        }

        return new Collection(array());
    }

    /**
    * Checks whether an item within the collection
    *
    * @param $property
    *
    * @return bool
    */
    public function exists($property)
    {
        return property_exists($this->collection, $property);
    }

    /**
    * Finds whether the collection is empty
    *
    * @return bool
    */
    public function isEmpty()
    {
        return ! (bool) $this->count();
    }

    /**
    * Count all items in collection
    *
    * @return int
    */
    public function count()
    {
        return count($this->properties());
    }

    /**
    * Returns all items properties names
    *
    * @return array
    */
    public function properties()
    {
        $properties = array();

        foreach ($this->collection as $property) {
            $properties[] = $property;
        }

        return $properties;
    }

    /**
    * Returns all items values
    *
    * @return array
    */
    public function values()
    {
        $values = array();

        foreach ($this->collection as $property) {
            $values[] = $this->get($property);
        }

        return $values;
    }
}
