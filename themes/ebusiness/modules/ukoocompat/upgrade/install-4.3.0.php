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

function upgrade_module_4_3_0($object)
{
    if (!is_a($object, 'UkooCompat')) {
        return false;
    }

    // Création d'une nouvelle variable de configuration "secure_key" pour sécuriser les appels CRON
    if (!Configuration::updateValue('UKOOCOMPAT_SECUREKEY', Tools::strtoupper(Tools::passwdGen(16)))) {
        return false;
    }

    return true;
}
