<?php

$ps_dir_path_home = dirname(__FILE__) . '/../../../../../';
$config_file = $ps_dir_path_home . 'config/config.inc.php';
if (file_exists($config_file)) {
    include_once($config_file);
    include_once($ps_dir_path_home . 'init.php');
}

include_once(_PS_MODULE_DIR_ . 'totshippingpreview/totshippingpreview.php');

if (!Tools::getValue('choice')) {
    die;
}

if (Tools::getValue('choice') == 1) {
    Context::getContext()->cookie->__set('tot_id_preview_fee', Tools::getValue('id'));    /* $_SESSION['tot_id_preview_fee'] = Tools::getValue('id'); */
} elseif (Tools::getValue('choice') == 2) {
    Context::getContext()->cookie->__set('tot_id_preview_fee_2', Tools::getValue('id')); /* $_SESSION['tot_id_preview_fee_2'] = Tools::getValue('id'); */
}
$shipping_preview = new TotShippingPreview();

$temp = Configuration::get('TOT_SHIPPING_ZONE');
$temp2 = Configuration::get('TOT_SHIPPING_ZONE_2');

if (version_compare(_PS_VERSION_, '1.5', '>')) {
    $id_lang = Context::getContext()->language->id;
} else {
    global $cookie;
    $id_lang = $cookie->id_lang;
}

$display = false;
if (Tools::getValue('choice') == 1) {
    if ($temp === 'countries') {
        $country = new Country(Tools::getValue('id'));
        if ($country->contains_states == false || $temp2 == "empty") {
            $display = true;
        } else {
            $type = 'states';
            $tmp = State::getStatesByIdCountry(Tools::getValue('id'));
            $data = array();
            if (!count($tmp)) {
                $display = true;
            } else {
                foreach ($tmp as $key => $value) {
                    if (!$value['active']) {
                        unset($tmp[$key]);
                    } else {
                        $tmp[$key]['id'] = $tmp[$key]['id_state'];
                    }
                }
                $data = $tmp;
            }
        }
    } elseif ($temp === 'zones') {
        if ($temp2 == "empty") {
            $display = true;
        } elseif ($temp2 == 'countries') {
            $type = 'countries';
            $tmp = Country::getCountriesByZoneId(Tools::getValue('id_zone'), $id_lang);
            foreach ($tmp as $key => $value) {
                if (!$value['active']) {
                    unset($tmp[$key]);
                } else {
                    $tmp[$key]['id'] = $tmp[$key]['id_country'];
                }
            }
            $data = $tmp;
        } else {
            $type = 'states';
            $tmp = TotShippingPreview::getStatesByIdZone(Tools::getValue('id_zone'));
            foreach ($tmp as $key => $value) {
                if (!$value['active']) {
                    unset($tmp[$key]);
                } else {
                    $tmp[$key]['id'] = $tmp[$key]['id_state'];
                }
            }
            $data = $tmp;
        }
    } else {
        $display = true;
    }
}

if (Tools::getValue('choice') == 2 || $display === true) {
    $shipping_preview->setGlobal(
        Tools::getValue('cart'),
        Tools::getValue('id_product'),
        Tools::getValue('id_product_attribute'),
        Tools::getValue('total_price'),
        Tools::getValue('quantity')
    );
    $type = 'tab';
    $data = $shipping_preview->displayPreview(Tools::getValue('id_zone'), Tools::getValue('id_product'), Tools::getValue('quantity'));
}


$array = array(
    'type' => $type,
    'data' => $data,
    'display' => $display
);

echo json_encode($array);
