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

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/ukoocompat.php');

if (Tools::getIsset('secure_key')) {
    $secure_key = Configuration::get('UKOOCOMPAT_SECUREKEY');
    if (!empty($secure_key) && $secure_key === Tools::getValue('secure_key')) {
        $ukoocompat = new UkooCompat();
        if ($ukoocompat->active) {
            if (Tools::isSubmit('task') && Tools::getValue('task') == "sitemap") {
                $ukoocompat->generateSitemap(
                    (Tools::isSubmit('id_search') ? Tools::getValue('id_search') : false)
                );
            } else {
                d('Unknow task!');
            }
        } else {
            d('Module is disabled!');
        }
    } else {
        d('Bad secure_key!');
    }
} else {
    d('Secure key not send!');
}
