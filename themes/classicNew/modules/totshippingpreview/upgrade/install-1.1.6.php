<?php
/**
 * Description of TotShippingPreview
 *
 * @author    202-ecommerce
 * @copyright 202-ecommerce
 * @license   202-ecommerce
 * @version   1.1.6
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Upgrade for 1.1.6
 * @param Module $module
 * @return bool
 */
function upgrade_module_1_1_6($module)
{
    $sql = sql_upgrade_1_1_6();

    if (!empty($sql) && is_array($sql)) {
        foreach ($sql as $request) {
            if (!Db::getInstance()->execute($request)) {
                TotShippingPreview::writeLog("Erreur requette sql");

                return false;
            }
        }
    }

    if (!$module->registerHook('displayAdminProductsExtra')
        || !$module->registerHook('actionProductUpdate')
    ) {
        return false;
    }

    return true;
}

/**
 * SQL Upgrade 1.2.0
 * @return array
 */
function sql_upgrade_1_1_6()
{
    $sql = array();

    return $sql;
}
