<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to a commercial license from 202 ecommerce
 * Use, copy, modification or distribution of this source file without written
 * license agreement from 202 ecommerce is strictly forbidden.
 *
 * @author    202 ecommerce <contact@202-ecommerce.com>
 * @copyright Copyright (c) 202 ecommerce 2014
 * @license   Commercial license
 *
 * Support <support@202-ecommerce.com>
 */

if (!defined('_PS_VERSION_')) {
    die(header('HTTP/1.0 404 Not Found'));
}

class ShippingPreview extends ObjectModel
{
    /** @var String $origin_country */
    public $origin_country;
    
    /** @var String $delivery_country */
    public $delivery_country;
    
    /** @var Intenger $delivery_time */
    public $delivery_time;

    /** @var Intenger $delivery_time */
    public $id_product;

    public $force_id = false;

    public static $definition = array(
        'table'     => 'totshippingpreview',
        'primary'   => 'id_totshippingpreview',
        'multilang' => true,
        'fields'    => array(
            # Lang fields
            'origin_country' => array(
                'type'     => parent::TYPE_STRING,
                'required' => false,
                'lang'     => true
            ),
            'delivery_country' => array(
                'type'     => parent::TYPE_STRING,
                'required' => false,
                'lang'     => true
            ),
            'delivery_time' => array(
                'type'     => parent::TYPE_INT,
                'required' => false,
                'lang'     => false,
                'allow_null' => true
            ),
            'id_product' => array(
                'type'     => parent::TYPE_INT,
                'required' => false,
                'lang'     => false
            ),
        ),
    );
}
