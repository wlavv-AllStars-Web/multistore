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

function upgrade_module_4_1_0($object)
{
    // Greffé à deux nouvelles positions
    if (!$object->registerHook('displayUkooCompatCatalogTree')
        || !$object->registerHook('displayTopColumn')
    ) {
        return false;
    }

    return true;
}
