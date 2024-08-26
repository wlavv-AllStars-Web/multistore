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

function upgrade_module_4_2_0($object)
{
    if (!is_a($object, 'UkooCompat')) {
        return false;
    }

    // Modification de la table "ukoocompat_import_file"
    if (!Db::getInstance()->execute(
        'ALTER TABLE `'._DB_PREFIX_.'ukoocompat_import_file`
        ADD `delete_old_datas` TINYINT(1) NOT NULL DEFAULT \'0\' AFTER `create_alias`'
    )
    ) {
        return false;
    }

    return true;
}
