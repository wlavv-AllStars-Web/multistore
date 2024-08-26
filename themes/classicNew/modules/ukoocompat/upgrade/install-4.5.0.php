<?php
/**
 * Recherche de produits par compatibilité
 *
 * @author    Guillaume Heid - Ukoo <modules@ukoo.fr>
 * @copyright Ukoo 2015 - 2016
 * @license   Ukoo - Tous droits réservés
 *
 * "In Ukoo we trust!"
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_4_5_0($object)
{
    // Modification de la table "ukoocompat_search"
    if (!Db::getInstance()->execute(
        'ALTER TABLE `'._DB_PREFIX_.'ukoocompat_search`
        ADD `display_subcategories_products` TINYINT(1) NOT NULL DEFAULT "0"'
    )
    ) {
        return false;
    }

    return true;
}
