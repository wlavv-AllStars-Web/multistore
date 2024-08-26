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

function upgrade_module_4_1_1($object)
{
    // Aucune mise à jour requise au niveau de la BDD ou des hooks
    // Seuls certains fichiers ont été mis à jour pour cette version
    if (!is_a($object, 'UkooCompat')) {
        return false;
    }

    return true;
}
