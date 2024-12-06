<?php
/**
 * Description of TotShippingPreview
 *
 * @author    202-ecommerce
 * @copyright 202-ecommerce
 * @license   202-ecommerce
 * @version   1.2.0
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Upgrade for 1.1.6
 * @param Module $module
 * @return bool
 */
function upgrade_module_1_2_0($object)
{
    $sql = sql_upgrade_1_2_0();

    if (!empty($sql) && is_array($sql)) {
        foreach ($sql as $request) {
            if (!Db::getInstance()->execute($request)) {
                return false;
            }
        }
    }

    $object->installOverrides();

    if (!$object->registerHook('displayAdminProductsExtra')
        || !$object->registerHook('actionProductUpdate')
        || !$object->registerHook('actionCarrierUpdate')
    ) {
        return false;
    }

    return true;
}

/**
 * SQL Upgrade 1.2.0
 * @return array
 */
function sql_upgrade_1_2_0()
{
    $sql = array();

    $sql[_DB_PREFIX_.'totshippingpreview'] = '
        CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'totshippingpreview` (
            `id_totshippingpreview` int(16) NOT NULL AUTO_INCREMENT,
            `id_product` INT(11),
            `delivery_time` INT(11),
            PRIMARY KEY (`id_totshippingpreview`)
        ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;
    ';

    $sql[_DB_PREFIX_.'totshippingpreview_lang'] = '
        CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'totshippingpreview_lang` (
            `id_totshippingpreview` int(16) NOT NULL,
            `id_lang` int(11) NOT NULL,
            `origin_country` VARCHAR(255),
            `delivery_country` VARCHAR(255),
            PRIMARY KEY (`id_totshippingpreview`, `id_lang`)
        ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;
    ';

    $sql[_DB_PREFIX_.'totshippingpreview_carrier'] = '
        CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'totshippingpreview_carrier` (
            `id_totshippingpreview_carrier` int(16) NOT NULL,
            `mindays` int(11),
            `maxdays` int(11),
            PRIMARY KEY (`id_totshippingpreview_carrier`)
        ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;
    ';

    return $sql;
}
