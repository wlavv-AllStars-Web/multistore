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
    exit;
}

class TotShippingPreview extends Module
{
    public $configuration = array('TOT_SHIPPING_ZONE', 'TOT_SHIPPING_ZONE_2', 'TOT_SHIPPING_BEFORE', 'TOT_SHIPPING_AFTER');
    public $cart;
    public $id_product;
    public $id_product_attribute;
    public $quantity;

    private $debug = true;

    public function __construct()
    {
        $this->name = 'totshippingpreview';
        $this->tab = 'front_office_features';
        $this->version = '1.3.0';
        $this->author = '202 ecommerce';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->module_key = '6bfea4c37d6497d67a8e3f0b25b9a0bd';
        parent::__construct();

        $this->displayName = $this->l('Shipping fee preview');
        $this->description = $this->l('Allows to preview your shipping fees');
        $this->upgrade();

        /* Backward compatibility pour les version 1.4 */
        if (_PS_VERSION_ < '1.5') {
            require(_PS_MODULE_DIR_.$this->name.'/backward_compatibility/backward.php');
        }
        require_once(_PS_MODULE_DIR_.$this->name.'/classes/ShippingPreview.php');
    }

    /**
     * Upgrade module
     * @return boolean if upgrade successfull
     */
    private function upgrade()
    {
        // Get version in database
        $version = Configuration::get('TOTSHIPPINGPREVIEW_VERSION');
        // if no version OR version in database is oldest than file version
        if ($version === false || $this->version > $version) {
            // if version 1.0.0
            if ($version === false) {
                // If no registered hook
                if (!$this->isRegisteredInHook('header')) {
                    $this->registerHook('header');
                }
            }
            Configuration::updateValue('TOTSHIPPINGPREVIEW_VERSION', $this->version);
        }
    }

    public static function getStatesByIdZone($id_zone)
    {
        if (empty($id_zone)) {
            die(Tools::displayError());
        }

        return Db::getInstance()->executeS('SELECT * FROM `'._DB_PREFIX_.'state` s INNER JOIN `'._DB_PREFIX_.'country` c ON c.`id_country` = s.`id_country` WHERE c.`id_zone` = '.(int)$id_zone);
    }

    public function install()
    {
        if (!parent::install()) {
            return false;
        }

        if (!$this->registrationHook()) {
            return false;
        }

        if (!$this->installSQL()) {
            return false;
        }

        return true;
    }

    private function registrationHook()
    {
        if (!$this->registerHook('extraRight')
            || !$this->registerHook('shoppingCart')
            || !$this->registerHook('header')
            || !$this->registerHook('displayAdminProductsExtra')
            || !$this->registerHook('actionCarrierUpdate')
            || !$this->registerHook('actionProductUpdate')
            || !$this->registerHook('backOfficeHeader')) {
            return false;
        }

        return true;
    }

    private function installSQL()
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

        foreach ($sql as $q) {
            if (!Db::getInstance()->execute($q)) {
                return false;
            }
        }
        return true;
    }

    public function uninstall()
    {
        $this->uninstallSQL();
        
        if (!$this->unRegistratioHook()) {
            return false;
        }

        $conf_to_delete = array('TOTSHIPPINGPREVIEW_VERSION', 'TOT_SHIPPING_ZONE', 'TOT_SHIPPING_ZONE_2', 'TOT_SHIPPING_BEFORE', 'TOT_SHIPPING_AFTER', 'TOTSP_TXT_COL', 'TOTSP_BG_COL', 'TOTSP_TXT_COL_HOV', 'TOTSP_BG_COL_HOV', 'TOTSP_BTN_TXT', 'TOTSP_BTN_PIC');

        foreach ($conf_to_delete as $conf) {
            if (!Configuration::deleteByName($conf)) {
                return false;
            }
        }
        
        parent::uninstall();

        return true;
    }

    private function uninstallSQL()
    {
        $sql = array();

        $sql[_DB_PREFIX_.'totshippingpreview'] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'totshippingpreview`';

        $sql[_DB_PREFIX_.'totshippingpreview_lang'] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'totshippingpreview_lang`';

        $sql[_DB_PREFIX_.'totshippingpreview_carrier'] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'totshippingpreview_carrier`';

        foreach ($sql as $q) {
            if (!Db::getInstance()->execute($q)) {
                return false;
            }
        }
    }

    private function unRegistratioHook()
    {
        if (!$this->unregisterHook('extraRight')
            || !$this->unregisterHook('shoppingCart')
            || !$this->unregisterHook('header')
            || !$this->unregisterHook('displayAdminProductsExtra')
            || !$this->unregisterHook('actionProductUpdate')
            || !$this->unregisterHook('backOfficeHeader')) {
            return false;
        }

        return true;
    }

    ############################################################################################################
    # Configuration part
    ############################################################################################################

    public function getContent()
    {
        if (Tools::isSubmit('submitForm') || Tools::isSubmit('totshippingpreview_customization_submit')) {
            $this->postProcess();
        }

        $admin_dir = dirname($_SERVER['PHP_SELF']);
        $languages = Language::getLanguages();

        $this->smarty->assign(array(
            'tot_shipping_zone'   => Configuration::get('TOT_SHIPPING_ZONE'),
            'tot_shipping_zone_2' => Configuration::get('TOT_SHIPPING_ZONE_2'),
            'thismodule'          => $this,
            'tot_shipping_after'  => $this->getConfigurationAllLanguage('TOT_SHIPPING_AFTER'),
            'tot_shipping_before' => $this->getConfigurationAllLanguage('TOT_SHIPPING_BEFORE'),
            'default_lang'        => Configuration::get('PS_LANG_DEFAULT'),
            'languages'           => $languages,
            'lang_current'        => $this->context->language->id,
            'admin_link'          => $admin_dir,
            'iso'                 => $this->context->language->iso_code,
        ));

        // Customization config values
        $totTxt = array();
        foreach ($languages as $lang) {
            if (Configuration::get('TOTSP_BTN_TXT', $lang['id_lang'])) {
                $totTxt[$lang['id_lang']] = Configuration::get('TOTSP_BTN_TXT', $lang['id_lang']);
            }
        }

        $this->smarty->assign(array(
            'totTxtCol' => Configuration::get('TOTSP_TXT_COL'),
            'totBgCol' => Configuration::get('TOTSP_BG_COL'),
            'totTxtColHov' => Configuration::get('TOTSP_TXT_COL_HOV'),
            'totBgColHov' => Configuration::get('TOTSP_BG_COL_HOV'),
            'totPic' => Configuration::get('TOTSP_BTN_PIC'),
            'totImgDir' => $this->_path.'/views/img/',
            'totTxt' => $totTxt,
            'totTab' => $this->tab
        ));
        
        $this->context->controller->addCSS($this->_path.'views/css/admin.css', 'all');
        if (version_compare('1.5', _PS_VERSION_, '>')) {
            $this->smarty->template_dir = dirname(__FILE__).'/views/templates/admin';
        }

        $html = '';
        $html .= $this->displayBann();
        $html .= '
            <div id="tot-tab-title">
                <a class="title-tab" id="tab1">'.$this->l('General settings').'</a>
                <a class="title-tab" id="tab2">'.$this->l('Customization').'</a>
                <a class="title-tab">'.$this->l('See more').'</a>
            </div>
            <div id="tot-tab-content">
                <div class="tot-tab">';

        $form = $this->createForm();
        $html .= $form;
        $html .= $this->display(__FILE__, 'views/templates/admin/back.tpl');
        $html .= '
                </div>';

        // Customization page
        $html .= '<div class="tot-tab">';
        $html .= $this->display(__FILE__, 'views/templates/admin/customization.tpl');
        $html .= '</div>';

        if (!Module::isInstalled('totshowmailalerts')) {
            $link_additional_module1 = 'http://addons.prestashop.com/en/6320-product-out-of-stock-emails-and-number-of-requests.html';
            $module1                 = false;
        } else {
            $link_additional_module1 = 'index.php?controller='.Tools::getValue('controller').'&configure=totshowmailalerts&token='.Tools::getValue('token').'&tab_module='.$this->tab.'&module_name=totshowmailalerts';
            $module1                 = true;
        }

        if (!Module::isInstalled('totloyaltyadvanced')) {
            $link_additional_module2 = 'https://addons.prestashop.com/en/referral-loyalty-programs/7301-advanced-loyalty-program.html';
            $module2                 = false;
        } else {
            $link_additional_module2 = 'index.php?controller='.Tools::getValue('controller').'&configure=totloyaltyadvanced&token='.Tools::getValue('token').'&tab_module='.$this->tab.'&module_name=totloyaltyadvanced';
            $module2                 = true;
        }

        if (!Module::isInstalled('totstoredelivery')) {
            $link_additional_module3 = 'https://addons.prestashop.com/en/collection-points-in-store-pick-up/24229-store-delivery-in-store-availability-pickup-at-store.html';
            $module3                 = false;
        } else {
            $link_additional_module3 = 'index.php?controller='.Tools::getValue('controller').'&configure=totstoredelivery&token='.Tools::getValue('token').'&tab_module='.$this->tab.'&module_name=totstoredelivery';
            $module3                 = true;
        }

        if (!Module::isInstalled('totsmartdelivery')) {
            $link_additional_module4 = 'https://addons.prestashop.com/en/shipping-carriers/8383-smartdelivery-transport-management-delivery-rounds.html';
            $module4                 = false;
        } else {
            $link_additional_module4 = 'index.php?controller='.Tools::getValue('controller').'&configure=totsmartdelivery&token='.Tools::getValue('token').'&tab_module='.$this->tab.'&module_name=totsmartdelivery';
            $module4                 = true;
        }
        
        $assigns = array(
            '_path'                   => $this->_path,
            'link_additional_module1' => $link_additional_module1,
            'module1'                 => $module1,
            'link_additional_module2' => $link_additional_module2,
            'module2'                 => $module2,
            'link_additional_module3' => $link_additional_module3,
            'module3'                 => $module3,
            'link_additional_module4' => $link_additional_module4,
            'module4'                 => $module4,
        );
        
        $this->context->smarty->assign($assigns);

        $html .= '
                <div class="tot-tab seemore">
                    '.$this->display(__FILE__, 'views/templates/admin/seemore.tpl').'
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                     $(".title-tab:eq('.Tools::getValue("id_tab", 0).')").addClass("active");
                     
                     $("#tot-tab-content .tot-tab").hide();
                     
                     $("#tot-tab-content .tot-tab:eq('.Tools::getValue("id_tab", 0).')").show();
                     
                     $(".title-tab").click(function(){
                          if ($(this).hasClass("active")) {
                               return;
                          }
                          $(".title-tab").removeClass("active");
                          $(this).addClass("active");
                          var idx = $(this).index();
                          $("#tot-tab-content .tot-tab").hide();
                          $("#tot-tab-content .tot-tab:eq("+idx+")").show();
                     });
                });
            </script>';

        return $html;
    }

    private function createForm()
    {
        $fields_value = array(
            'tot_shipping_zone'   => Configuration::get('TOT_SHIPPING_ZONE'),
            'tot_shipping_zone_2' => Configuration::get('TOT_SHIPPING_ZONE_2'),
            'tot_shipping_after'  => $this->getConfigurationAllLanguage('TOT_SHIPPING_AFTER'),
            'tot_shipping_before' => $this->getConfigurationAllLanguage('TOT_SHIPPING_BEFORE'),
        );

         $options_zone_1 = array(
            array(
                 'value' => 'empty',
                 'text' => ''
            ),
            array(
                 'value' => 'zones',
                 'text' => $this->l('Zones'),
            ),
            array(
                'value' => 'countries',
                'text' => $this->l('Countries'),
            ),
            array(
                'value' => 'states',
                'text' => $this->l('States'),
            )
        );

        $options_zone_2 = array(
            array(
                'value' => 'empty',
                'text' => ''
            )
        );

        if (Configuration::get('TOT_SHIPPING_ZONE') == 'zones') {
            $options_zone_2 = array(
                array(
                    'value' => 'empty',
                    'text' => ''
                ),
                array(
                    'value' => 'countries',
                    'text' => $this->l('Countries')
                ),
                array(
                    'value' => 'states',
                    'text' => $this->l('States')
                )
            );
        }

        if (Configuration::get('TOT_SHIPPING_ZONE') == 'countries') {
            $options_zone_2 = array(
                array(
                    'value' => 'empty',
                    'text' => ''
                ),
                array(
                    'value' => 'states',
                    'text' => $this->l('States')
                )
            );
        }

        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Configuration'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'label' => $this->l('Choose your first level:'),
                        'name' => 'tot_shipping_zone',
                        'type' => 'select',
                        'options' => array(
                            'query' => $options_zone_1,
                            'id' => 'value',
                            'name' => 'text'
                        ),
                    ),
                    array(
                        'label' => $this->l('Choose your second level:'),
                        'name' => 'tot_shipping_zone_2',
                        'type' => 'select',
                        'options' => array(
                            'query' => $options_zone_2,
                            'id' => 'value',
                            'name' => 'text'
                        ),
                    ),
                    array(
                        'label' => $this->l('Text before button:'),
                        'name' => 'tot_shipping_before',
                        'type' => 'textarea',
                        'lang' => true,
                        'autoload_rte' => true,
                    ),
                    array(
                        'label' => $this->l('Text after button:'),
                        'name' => 'tot_shipping_after',
                        'type' => 'textarea',
                        'lang' => true,
                        'autoload_rte' => true,
                    ),

                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                    'class' => 'button'
                )
            )
        );
   
        if (version_compare(_PS_VERSION_, '1.5', '>')) {
            $l = 'index.php?controller='.Tools::getValue('controller');
            $l .= '&token='.Tools::getValue('token');
            $l .= '&configure='.$this->name;
            $l .= '&tab_module='.$this->tab;
            $l .= '&module_name='.$this->name;
        } else {
            $l = 'index.php?tab='.Tools::getValue('tab');
            $l .= '&token='.Tools::getValue('token');
            $l .= '&configure='.$this->name;
            $l .= '&tab_module='.$this->tab;
            $l .= '&module_name='.$this->name;
        }
        
        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        $helper = new HelperForm();
        $helper->module = $this;
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = $l;
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;
        $helper->languages = $this->context->controller->getLanguages();
        $helper->submit_action = 'submitForm';
        $helper->fields_value = (array)$fields_value;

        return $helper->generateForm(array($fields_form));
    }

    private function postProcess()
    {
        if (Tools::isSubmit('submitForm')) {
            $this->tab = '#tab1';
            if (Tools::getValue('tot_shipping_zone')) {
                Configuration::updateValue('TOT_SHIPPING_ZONE', Tools::getValue('tot_shipping_zone'));
            }
            if (Tools::getValue('tot_shipping_zone_2')) {
                Configuration::updateValue('TOT_SHIPPING_ZONE_2', Tools::getValue('tot_shipping_zone_2'));
            }
            $langs = $this->context->controller->getLanguages();
            $after = $this->getConfigurationAllLanguage('TOT_SHIPPING_AFTER');
            $before = $this->getConfigurationAllLanguage('TOT_SHIPPING_BEFORE');
            foreach ($langs as $key => $lang) {
                if (Tools::getValue('tot_shipping_before_'.$lang['id_lang'])) {
                    $before[$lang['id_lang']] = Tools::getValue('tot_shipping_before_'.$lang['id_lang']);
                }
                if (Tools::getValue('tot_shipping_after_'.$lang['id_lang'])) {
                    $after[$lang['id_lang']] = Tools::getValue('tot_shipping_after_'.$lang['id_lang']);
                }
            }
            $error = 0;
            if (!Configuration::updateValue('TOT_SHIPPING_BEFORE', $before, true)) {
                $error = 1;
            }
            if (!Configuration::updateValue('TOT_SHIPPING_AFTER', $after, true)) {
                $error = 1;
            }
        }

        if (Tools::isSubmit('totshippingpreview_customization_submit')) {
            $this->tab = '#tab2';
            $error = 0;
            $txt = Tools::getValue('tot_txt');
            $bg = Tools::getValue('tot_bg');
            $txthov = Tools::getValue('tot_txt_hov');
            $bghov = Tools::getValue('tot_bg_hov');
            $txtlang = Tools::getValue('tot_disp_txt');

            Configuration::updateValue('TOTSP_TXT_COL', $txt);
            Configuration::updateValue('TOTSP_BG_COL', $bg);
            Configuration::updateValue('TOTSP_TXT_COL_HOV', $txthov);
            Configuration::updateValue('TOTSP_BG_COL_HOV', $bghov);
            Configuration::updateValue('TOTSP_BTN_TXT', $txtlang);

            $img = $_FILES['tot_pic']['tmp_name'] ?? null;
            $img_name = $_FILES['tot_pic']['name'] ?? null;

            if ($img && is_uploaded_file($img)) {
                if (ImageManager::isRealImage($img) && ImageManager::validateUpload($img)) {
                    $img_dir = dirname(__FILE__) . '/views/img/';
                    if (move_uploaded_file($img, $img_dir . $img_name)) {
                        Configuration::updateValue('TOTSP_BTN_PIC', $img_name);
                    } else {
                        // Handle move_uploaded_file failure
                        error_log('Failed to move uploaded file to destination directory.');
                    }
                } else {
                    // Handle validation failure
                    error_log('Uploaded file is not a valid image.');
                }
            } else {
                // Handle empty or missing file
                error_log('No file uploaded or file path is invalid.');
            }
        }
    }

    private function getConfigurationAllLanguage($key)
    {
        $config = array();
        foreach (Language::getLanguages() as $language) {
            $config[$language['id_lang']] = Configuration::get($key, $language['id_lang']);
        }

        return $config;
    }

    private function displayBann()
    {
        $html = '
                <div class="panel-heading clearfix banner_container">
                    <table class="banner">
                        <tr>
                            <td class="text">
                                <img src="'.$this->_path.'views/img/header-logo.png" />
                                <br /><span class="white"><span>'.$this->displayName.'</span></span>
                                <p>'.$this->description.'</p>
                            </td>
                            
                            <td class="lesbuttons">
                                
                                <a href="https://addons.prestashop.com/en/contact-us?id_product=8222" target="_blank" title="'.$this->l('Contact us').'">
                                    <img src="'.$this->_path.'views/img/banner/question-mark.png" />
                                </a>

                                <a href="https://addons.prestashop.com/en/ratings.php" target="_blank" title="'.$this->l('Rate our module').'">
                                    <img src="'.$this->_path.'views/img/banner/star.png" />
                                </a>
                                
                                <a href="https://addons.prestashop.com/en/27_202-ecommerce" target="_blank">
                                    <img src="'.$this->_path.'views/img/banner/logo-202-v2.png" style="width:150px;margin:5px;" id="logo202" />
                                </a>

                            </td>
                        </tr>
                    </table>
                </div>';

        return $html;
    }

    ############################################################################################################
    # Admin part
    ############################################################################################################
    /**
     * Use to save action from the tab in Admin Carrier Wizard
     * @param $params
     */
    public function hookActionCarrierUpdate($params)
    {
        $sql = new DbQuery();
        $sql->select('*');
        $sql->from('totshippingpreview_carrier', 't');
        $sql->where('t.id_totshippingpreview_carrier = '.$params['carrier']->id_reference);
        $result_id = Db::getInstance()->getValue($sql);

        if ($result_id) {
            $sql = 'UPDATE `'._DB_PREFIX_.'totshippingpreview_carrier` SET ';

            $sql .= '`mindays`='.(Tools::getValue('mindays')!=''?Tools::getValue('mindays'):'NULL');

            $sql .= ',`maxdays`='.(Tools::getValue('maxdays')!=''?Tools::getValue('maxdays'):'NULL').' WHERE id_totshippingpreview_carrier = '.$params['carrier']->id_reference;
        } else {
            $sql = 'INSERT INTO `'._DB_PREFIX_.'totshippingpreview_carrier` (`id_totshippingpreview_carrier`, `mindays`, `maxdays`) VALUES ('.$params['carrier']->id_reference.','.(Tools::getValue('mindays')!=''?Tools::getValue('mindays'):'NULL').','.(Tools::getValue('maxdays')!=''?Tools::getValue('maxdays'):'NULL').')';
        }

        Db::getInstance()->Execute($sql);
    }

    /**
     * Define a new tab in the Admin Product
     * @param $params
     * @return string
     */
    public function hookDisplayAdminProductsExtra($params)
    {
        $cookie = $this->context->cookie;
        $this->allow_employee_form_lang = (int)Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG');
        if ($this->allow_employee_form_lang && !$cookie->employee_form_lang) {
            $cookie->employee_form_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        }
        $iso_tiny_mce = $this->context->language->iso_code;
        $iso_tiny_mce = (file_exists(_PS_JS_DIR_.'tiny_mce/langs/'.$iso_tiny_mce.'.js') ? $iso_tiny_mce : 'en');

        $lang_exists = false;
        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            if (isset($cookie->employee_form_lang) && $cookie->employee_form_lang == $lang['id_lang']) {
                $lang_exists = true;
            }
        }

        $sql = new DbQuery();
        $sql->select('id_totshippingpreview');
        $sql->from('totshippingpreview', 't');
        $sql->where('t.id_product = '.Tools::getValue('id_product'));
        $result_id = Db::getInstance()->getValue($sql);

        $shipping_preview = new ShippingPreview($result_id);

        if (version_compare(_PS_VERSION_, '1.6', '>')) {
            $ps = 1;
        } else {
            $ps = 0;
        }
 
        $admin_dir = dirname($_SERVER['PHP_SELF']);
        $datas = array(
            'ad'                    => __PS_BASE_URI__.basename(_PS_ADMIN_DIR_),
            'name'                  => $this->displayName,
            'place_delivery'        => $shipping_preview->delivery_country,
            'origin_country'        => $shipping_preview->origin_country,
            'delivery_time'        => $shipping_preview->delivery_time,
            'id_lang'               => (int)$this->context->language->id,
            'languages'             => $languages,
            'default_form_language' => $lang_exists ? (int)$cookie->employee_form_lang : (int)Configuration::get('PS_LANG_DEFAULT'),
            'iso_tiny_mce'          => $iso_tiny_mce,
            'ps' => $ps,
            'thismodule'          => $this,
            'admin_link'          => $admin_dir,
            'default_lang'        => Configuration::get('PS_LANG_DEFAULT'),
        );

        //self::debug($datas, 1);

        $this->context->smarty->assign($datas);

        return $this->display(__FILE__, 'AdminProduct.tpl');
    }

    /**
     * Use to save action from the tab in Admin Product
     * @param $params
     */
    public function hookActionProductUpdate($params)
    {
        if(Tools::getValue('delivery_time') === false) {
            return;
        }
        $languages = Language::getLanguages(false);

        if (version_compare(_PS_VERSION_, '1.6', '>')) {
            $product_id = $params['id_product'];
        } else {
            $product_id = Tools::getValue('id_product');
        }

        $sql = new DbQuery();
        $sql->select('id_totshippingpreview');
        $sql->from('totshippingpreview', 't');
        $sql->where('t.id_product = '.$product_id);
        $result_id = Db::getInstance()->getValue($sql);

        $shipping_preview = new ShippingPreview($result_id);

        $shipping_preview->id_product = $product_id;
        $shipping_preview->delivery_time = (Tools::getValue('delivery_time')!=''?(int)Tools::getValue('delivery_time'):null);

        foreach ($languages as $language) {
            $shipping_preview->delivery_country[$language['id_lang']] = Tools::getValue('place_delivery_'.$language['id_lang']);
            $shipping_preview->origin_country[$language['id_lang']] = Tools::getValue('origin_country_'.$language['id_lang']);
        }

        $shipping_preview->save(true);
    }

    ############################################################################################################
    # Other
    ############################################################################################################

    /**
     * Add CSS
     */
    public function hookHeader()
    {
        //order-opc == one page checkout
        $page = $this->smarty->getTemplateVars('page_name');
        if (($page === 'product' || $page === 'order' || $page === 'order-opc') && Tools::getValue('step') == 0) {
            $css_file = $this->_path.'views/css/totshippingpreview.css';
            if (version_compare(_PS_VERSION_, '1.5', '>')) {
                $this->context->controller->addCSS($css_file);
            } else {
                Tools::addCSS($css_file);
            }
        }
    }

    public function hookBackOfficeHeader()
    {
        $tpl_vars = $this->smarty->getTemplateVars();

        $expl_current = explode('=', $tpl_vars['current']);

        $table = $tpl_vars['table'];


        if (($expl_current[1] == 'AdminCarrierWizard' && $table == 'carrier') || $expl_current[1] == 'AdminProducts') {
            $css_file = $this->_path.'views/css/totshippingpreview.css';
            
            if (version_compare(_PS_VERSION_, '1.5', '>')) {
                $this->context->controller->addCSS($css_file);
            } else {
                Tools::addCSS($css_file);
            }
        }

        $this->context->controller->addJqueryPlugin('colorpicker');
    }

    public function hookShoppingCart()
    {
        return $this->displayHook(0, 0, true);
    }

    private function displayHook($id_product = 0, $id_product_attribute = 0, $cart = false)
    {
            $sql = new DbQuery();
            $sql->select('id_totshippingpreview');
            $sql->from('totshippingpreview', 't');
            $sql->where('t.id_product = '.$id_product);
            $result_id = Db::getInstance()->getValue($sql);

            $shipping_preview = new ShippingPreview($result_id);

            // print_r($shipping_preview,1);
            // exit;


            if (!$cart) {
                $product = new product($id_product);
                if(StockAvailableCore::getQuantityAvailableByProduct($product->id) < 1 && $product->out_of_stock == '0') {
                    return;
                }
                $carriers = $product->getCarriers();

                if ($carriers == null) {
                    $carriers = Carrier::getCarriers(
                        $this->context->language->id,
                        true,
                        false,
                        false,
                        null,
                        (version_compare(_PS_VERSION_, '1.5', '>') ? Carrier::ALL_CARRIERS : 5)
                    );
                }
            } else {
                $carriers = Carrier::getCarriers(
                    $this->context->language->id,
                    true,
                    false,
                    false,
                    null,
                    (version_compare(_PS_VERSION_, '1.5', '>') ? Carrier::ALL_CARRIERS : 5)
                );
            }

            $tot_product_delay = null;

            // Récupération des délais produit
            if (!$cart) {
                // Page Produit
                // on va chercher le delai du produit
                $sql = 'SELECT delivery_time FROM `'._DB_PREFIX_.'totshippingpreview`
                    WHERE id_product='.$id_product;

                $result = Db::getInstance()->executeS($sql);

                if (count($result) > 0) {
                    if (is_null($result[0]['delivery_time'])) {
                        $tot_product_delay = 0;
                    } else {
                        $tot_product_delay = (int)$result[0]['delivery_time'];
                    }
                } else {
                    $tot_product_delay = 0;
                }
            } else {
                // Panier
                $cart_products = $this->context->cart->getProducts();
                $id_products = '';

                for ($i=0; $i<count($cart_products); $i++) {
                    $id_products .= ($i>0?',':'').$cart_products[$i]['id_product'];
                }

                if ($id_products != "") {
                    $sql = 'SELECT delivery_time FROM `' . _DB_PREFIX_ . 'totshippingpreview` WHERE id_product IN (' . $id_products . ')';
                    $delays = Db::getInstance()->executeS($sql);
                } else {
                    $delays = array();
                }

                foreach ($delays as $delay) {
                    if (is_null($tot_product_delay)) {
                        $tot_product_delay = $delay['delivery_time'];
                    } else {
                        $tot_product_delay += $delay['delivery_time'];
                    }
                }
            }

            $count = 0;

            $mindays = 0;
            $maxdays = 0;

            $only_min = true;

            $current_zone_id = $this->context->country->id_zone;

            foreach ($carriers as $carrier) {
                $carrier_obj = new Carrier($carrier['id_carrier']);

                $carrier_zones = $carrier_obj->getZones();

                $zone_ids = array();

                foreach ($carrier_zones as $carrier_zone) {
                    array_push($zone_ids, $carrier_zone['id_zone']);
                }

                if (!in_array($current_zone_id, $zone_ids)) {
                    continue;
                }

                $sql = 'SELECT mindays, maxdays FROM `'._DB_PREFIX_.'totshippingpreview_carrier` WHERE id_totshippingpreview_carrier ='.$carrier['id_reference'];

                $result = Db::getInstance()->executeS($sql);

                if (count($result)) {
                    $res_min = (int)$result[0]['mindays'];
                    $res_max = (int)$result[0]['maxdays'];

                    if ($mindays == 0) {
                        $mindays = $res_min;
                    } elseif ($res_min < $mindays && $res_min !== 0) {
                        $mindays = $res_min;
                    }

                    if ($res_max > 0 && $only_min) {
                        $only_min = false;
                    }

                    $maxdays = ($res_max > $maxdays ? $res_max : $maxdays);
                }

                $count++;
            }

            $min_days_nb = $mindays + $tot_product_delay;
            $max_days_nb = $maxdays + $tot_product_delay;

            if ($this->context->language->id == Configuration::get('PS_LANG_DEFAULT')) {
                $delivery_country = $shipping_preview->delivery_country[$this->context->language->id];
                
                $origin_country = $shipping_preview->origin_country[$this->context->language->id];

                echo $origin_country;
            } else {
                $delivery_country = ($shipping_preview->delivery_country[$this->context->language->id] != '' ? $shipping_preview->delivery_country[$this->context->language->id] : $shipping_preview->delivery_country[Configuration::get('PS_LANG_DEFAULT')]);
                
                $origin_country = ($shipping_preview->origin_country[$this->context->language->id] != '' ? $shipping_preview->origin_country[$this->context->language->id] : $shipping_preview->origin_country[Configuration::get('PS_LANG_DEFAULT')]);
            }
            $isMobile = isset($params['mobile']) ? (bool)$params['mobile'] : 0;

            $this->smarty->assign(array(
                'ajax_url'                    => $this->_path.'views/js/ajax/getshippingfee.php',
                'first_level'                 => Configuration::get('TOT_SHIPPING_ZONE'),
                'second_level'                => Configuration::get('TOT_SHIPPING_ZONE_2'),
                'zones'                       => $this->getZones('TOT_SHIPPING_ZONE', $cart, $carriers),
                'zones_2'                     => $this->getZones('TOT_SHIPPING_ZONE_2', $cart, $carriers),
                'tot_id_product'              => $id_product,
                'tot_cart'                    => $cart,
                'tot_id_product_attribute'    => $id_product_attribute,
                'tot_id_preview_fee'          => isset($this->context->cookie->tot_id_preview_fee) ? $this->context->cookie->tot_id_preview_fee : '',
                'tot_id_preview_fee_2'        => isset($this->context->cookie->tot_id_preview_fee_2) ? $this->context->cookie->tot_id_preview_fee_2 : '',
                'tot_shipping_before'         => Configuration::get('TOT_SHIPPING_BEFORE', $this->context->language->id),
                'tot_shipping_after'          => Configuration::get('TOT_SHIPPING_AFTER', $this->context->language->id),
                'tot_shipping_url_rewritting' => Configuration::get('PS_REWRITING_SETTINGS', $this->context->language->id),
                'current_controller'          => Tools::getValue('controller'),
                'delivery_country'            => $delivery_country,
                'origin_country'              => $origin_country,
                'min_days_nb' => $min_days_nb,
                'max_days_nb' => $max_days_nb,
                'only_min' => $only_min,
                'mobile' => $isMobile,
            ));

            // Customization config values
            $lang_current = $this->context->language->id;
            $languages = Language::getLanguages();
            $totTxt = array();
            foreach ($languages as $lang) {
                $totTxt[$lang['id_lang']] = Configuration::get('TOTSP_BTN_TXT', $lang['id_lang']);
            }

            $this->smarty->assign(array(
                'totTxtCol' => Configuration::get('TOTSP_TXT_COL'),
                'totBgCol' => Configuration::get('TOTSP_BG_COL'),
                'totTxtColHov' => Configuration::get('TOTSP_TXT_COL_HOV'),
                'totBgColHov' => Configuration::get('TOTSP_BG_COL_HOV'),
                'totImgDir' => $this->_path.'/views/img/',
                'totPic' => Configuration::get('TOTSP_BTN_PIC'),
                'totTxt' => $totTxt,
                'lang_current' =>$lang_current
            ));

            return $this->display(__FILE__, 'views/templates/hook/shipping_preview.tpl');
    }

    private function _getCarriersZones($carriers)
    {
        $zone = array();
        
        // Contains ids of zones to avoid duplicates
        $id_zones = array();

        foreach ($carriers as $carrier) {
            // Single carrier
            $c = new Carrier($carrier['id_carrier']);
            
            // For each zone of the carrier
            foreach ($c->getZones() as $z) {
                // If the zone had not been added yet
                if (!in_array($z['id_zone'], $id_zones) && $z['active']) {
                    $id_zones[] = $z['id_zone'];
                    $zone[] = array('id_zone' => $z['id_zone'], 'name' => $z['name']);
                }
            }
        }

        return $zone;
    }

    private function _getCartZones()
    {
        $zone = array();
        $zones = array();
        $zones_count = array();

        // Used to count the number of carriers for the cart
        $carriers = array();

        foreach ($this->context->cart->getProducts() as $product) {
            $p = new Product($product['id_product']);

            // Check if product has assigned carriers
            if (count($p->getCarriers())) {
                $carrier_list = $p->getCarriers();
            } else {
                // All active carriers
                $carrier_list = Carrier::getCarriers(
                    $this->context->language->id,
                    true,
                    false,
                    false,
                    null,
                    (version_compare(_PS_VERSION_, '1.5', '>') ? Carrier::ALL_CARRIERS : 5)
                );
            }

            foreach ($carrier_list as $carrier) {
                // Single carrier
                $c = new Carrier($carrier['id_carrier']);

                // For each zone of the carrier
                foreach ($c->getZones() as $z) {
                    if (array_key_exists($z['id_zone'], $zones_count)) {
                        if (!in_array($carrier['id_carrier'], $zones_count[$z['id_zone']])) {
                            $zones_count[$z['id_zone']][] = $carrier['id_carrier'];
                        }
                    } else {
                        $zones_count[$z['id_zone']][] = $carrier['id_carrier'];
                    }

                    $zones[ $z['id_zone'] ] = array(
                        'id_zone' => $z['id_zone'],
                        'name' => $z['name'],
                        'active' => $z['active']
                    );
                }

                if (!in_array($carrier['id_carrier'], $carriers)) {
                    $carriers[] = $carrier['id_carrier'];
                }

            }
        }

        foreach ($zones_count as $key => $value) {
            if ($zones[$key]['active']) {
                $zone[] = array('id_zone' => $zones[$key]['id_zone'], 'name' => $zones[$key]['name']);
            }
        }

        return $zone;
    }

    private function _getCountries($zones)
    {
        $countries = array();

       // foreach ($zones as $zone) {
        //    foreach (Country::getCountriesByZoneId($zone['id_zone'], $this->context->language->id) as $country) {
			foreach (Country::getCountries($this->context->language->id) as $country) {
                if ($country['active']) {
                    $countries[] = $country;
                }
            }
      //  }

        return $countries;
    }

    private function _getStates($countries)
    {
        $states = array();

        foreach ($countries as $country) {
            foreach (State::getStatesByIdCountry($country['id_country']) as $state) {
                if ($state['active']) {
                    $states[] = $state;
                }
            }
        }

        return $states;
    }

    private function getZones($conf, $is_cart, $carriers)
    {
        if (Configuration::get($conf) == 'zones') {
            if (!$is_cart) {
                $zone = $this->_getCarriersZones($carriers);
            } else {
                $zone = $this->_getCartZones();
            }

            foreach (array_keys($zone) as $key) {
                $zone[$key]['id'] = $zone[$key]['id_zone'];
            }
        } elseif (Configuration::get($conf) == 'countries') {
            if (!$is_cart) {
                $zone = $this->_getCountries($this->_getCarriersZones($carriers));
            } else {
                $zone = $this->_getCountries($this->_getCartZones());
            }

            foreach (array_keys($zone) as $key) {
                $zone[$key]['id'] = $zone[$key]['id_country'];
            }
        } else {
            if (!$is_cart) {
                $zone = $this->_getStates($this->_getCountries($this->_getCarriersZones($carriers)));
            } else {
                $zone = $this->_getStates($this->_getCountries($this->_getCartZones()));
            }

            foreach (array_keys($zone) as $key) {
                $zone[$key]['id'] = $zone[$key]['id_state'];
            }
        }

        return $zone;
    }

    public function hookExtraRight()
    {
        return $this->displayHook(Tools::getValue('id_product'), (int)Product::getDefaultAttribute(Tools::getValue('id_product')), (int)false);
    }

    public function setGlobal($cart, $id_product, $id_product_attribute, $total_price, $quantity=1)
    {
        $this->cart = $cart;
        $this->id_product = $id_product;
        $this->id_product_attribute = $id_product_attribute;
        $this->total_price = $total_price;
	$this->quantity = (int)$quantity;
    }

    public function displayPreview($id_zone, $id_product, $quantity = null)
    {
        $product = new Product($id_product);
        
        $total_price = $product->getPrice();

        if ($this->cart == 0) {
            $carriers = $product->getCarriers();
            if ($carriers == null) {
                $carriers = Carrier::getCarriers(
                    $this->context->language->id,
                    true,
                    false,
                    $id_zone,
                    null,
                    (version_compare(_PS_VERSION_, '1.5', '>') ? Carrier::ALL_CARRIERS : 5)
                );
            }
            // verification si carrier de cette produit est dispo dans le zone
            foreach ($carriers as $key => $carrier_in_zone) {
                $var_carrier = new Carrier($carrier_in_zone['id_carrier']);
                $var_carrier_id = $var_carrier->checkCarrierZone($var_carrier->id, $id_zone);
                if (!$var_carrier_id || $var_carrier_id == '') {
                    unset($carriers[$key]);
                }
            }
        }

        $tot_product_delay = null;

        // Récupération des délais produit
        if ($this->cart != 0) {
            // Panier
            $cart_products = $this->context->cart->getProducts();
            $id_products = '';
            $nb_products = count($cart_products);

            $carriers = array();
            $carriers_id = array();
            $carriers_use_count = array();

            for ($i=0; $i<count($cart_products); $i++) {
                $id_products .= ($i>0?',':'').$cart_products[$i]['id_product'];

                // Pour chaque produit on récupère les transporteurs
                $prod = new Product($cart_products[$i]['id_product']);
                $product_carriers = $prod->getCarriers();

                if (count($product_carriers)) {
                    foreach ($product_carriers as $product_carrier) {
                        if (!in_array($product_carrier['id_carrier'], $carriers_id)) {
                            //array_push($carriers, $product_carrier);
                            $carriers[$product_carrier['id_carrier']] = $product_carrier;
                            array_push($carriers_id, $product_carrier['id_carrier']);
                        }

                        if (isset($carriers_use_count[$product_carrier['id_carrier']])) {
                            $carriers_use_count[$product_carrier['id_carrier']] += 1;
                        } else {
                            $carriers_use_count[$product_carrier['id_carrier']] = 1;
                        }
                    }
                } else {
                    $glob_carriers = Carrier::getCarriers(
                        $this->context->language->id,
                        true,
                        false,
                        $id_zone,
                        null,
                        (version_compare(_PS_VERSION_, '1.5', '>') ? Carrier::ALL_CARRIERS : 5)
                    );

                    foreach ($glob_carriers as $glob_carrier) {
                        if (!in_array($glob_carrier['id_carrier'], $carriers_id)) {
                            //array_push($carriers, $glob_carrier);
                            $carriers[$glob_carrier['id_carrier']] = $glob_carrier;
                            array_push($carriers_id, $glob_carrier['id_carrier']);
                        }

                        if (isset($carriers_use_count[$glob_carrier['id_carrier']])) {
                            $carriers_use_count[$glob_carrier['id_carrier']] += 1;
                        } else {
                            $carriers_use_count[$glob_carrier['id_carrier']] = 1;
                        }
                    }
                }
            }

            // We filter out the carriers not used by all products
            foreach ($carriers_use_count as $carrier_id => $count) {
                if ($count != $nb_products) {
                    unset($carriers[$carrier_id]);
                }
            }

            foreach ($carriers as $key => $carrier_in_zone) {
                $var_carrier = new Carrier($carrier_in_zone['id_carrier']);
                $var_carrier_id = $var_carrier->checkCarrierZone($var_carrier->id, $id_zone);
                if (!$var_carrier_id || $var_carrier_id == '') {
                    unset($carriers[$key]);
                }
            }

            if ($id_products != "") {
                $sql = 'SELECT delivery_time FROM `'._DB_PREFIX_.'totshippingpreview` WHERE id_product IN ('.$id_products.')';
                $delays = Db::getInstance()->executeS($sql);
            } else {
                $delays = array();
            }

            foreach ($delays as $delay) {
                if (is_null($tot_product_delay)) {
                    $tot_product_delay = $delay['delivery_time'];
                } else {
                    $tot_product_delay += $delay['delivery_time'];
                }
            }
        }

        $shipping_product = $this->getShippingProduct($id_product);
        $shippingfee = array();
        $carrier_fees = array();
        $array_fees = array();
        $it = 0;

        foreach ($carriers as $carrier) {
	    $product_weight = $this->getWeight((int)$carrier['id_carrier']); 
            $is_free_carrier = (bool)$carrier['is_free'];
            if ($is_free_carrier == 1
                || ($this->context->cart->getOrderTotal(true, Cart::ONLY_PRODUCTS) >= Configuration::get('PS_SHIPPING_FREE_PRICE') && Configuration::get('PS_SHIPPING_FREE_PRICE') > 0)
                || ($total_price >= Configuration::get('PS_SHIPPING_FREE_PRICE') && Configuration::get('PS_SHIPPING_FREE_PRICE') > 0)
                || (($this->context->cart->getTotalWeight() >= Configuration::get('PS_SHIPPING_FREE_WEIGHT')) && (Configuration::get('PS_SHIPPING_FREE_WEIGHT') > 0))
                || (($product_weight >= Configuration::get('PS_SHIPPING_FREE_WEIGHT')) && (Configuration::get('PS_SHIPPING_FREE_WEIGHT') > 0))
            ) {
                $fees = 0;
            } elseif ($shipping_product && $shipping_product[0]['additional_shipping_cost'] > 0) {
                $fees = $this->getShippingFee($id_zone, $carrier['id_carrier'], $total_price) + $shipping_product[0]['additional_shipping_cost'];

                $fees = Tools::convertPrice($fees);
                $fees = number_format($fees, 2);
            } else {
                $fees = $this->getShippingFee($id_zone, $carrier['id_carrier'], $total_price);
                $fees = Tools::convertPrice($fees);
                $fees = number_format($fees, 2);
            }

            $carrier_obj = new Carrier($carrier['id_carrier']);
            $language_id = Context::getContext()->language->id;
            $carriers_delay = $carrier_obj->delay;

            $sql = 'SELECT mindays, maxdays FROM `'._DB_PREFIX_.'totshippingpreview_carrier` WHERE id_totshippingpreview_carrier ='.$carrier['id_reference'];
            $result = Db::getInstance()->executeS($sql);

            $mindays = 0;
            $maxdays = 0;
            $only_min = true;
            $only_max = false;

            if (count($result)) {
                $res_min = $result[0]['mindays'];
                $res_max = $result[0]['maxdays'];
                    
                if ($res_min == 0 && !$only_max) {
                    $only_max = true;
                    $only_min = false;
                }

                if ($res_max > 0 && $only_min) {
                    $only_min = false;
                }
                
                $mindays = ($res_min > $mindays ? $res_min : $mindays);
                $maxdays = ($res_max > $maxdays ? $res_max : $maxdays);
            }

            if (file_exists(_PS_SHIP_IMG_DIR_.$carrier_obj->id.'.jpg')) {
                $logo = _THEME_SHIP_DIR_.$carrier_obj->id.'.jpg';
            } else {
                $logo = false;
            }

            if ($mindays > 0 || $maxdays > 0) {
                if ($mindays != $maxdays) {
                    $min_delay = $mindays + $tot_product_delay;
                    $max_delay = $maxdays + $tot_product_delay;

                    if (!$only_min) {
                        if (!$only_max) {
                            $delay_output = sprintf($this->l('Between %1$d and %2$d days'), $min_delay, $max_delay);
                        } else {
                            $delay_output = sprintf($this->l('At the latest %d'), $max_delay).' '.($max_delay > 1?$this->l('days'):$this->l('day'));
                        }
                    } else {
                        $delay_output = sprintf($this->l('At the earliest %d'), $min_delay).' '.($min_delay > 1?$this->l('days'):$this->l('day'));
                    }
                } else {
                    $delay = $mindays + $tot_product_delay;
                    $delay_output = ($delay > 1 ? sprintf($this->l('%d days'), $delay) : $this->l('1 day')).$this->l(' minimum');
                }
            } else {
                $delay_output = $carriers_delay[$language_id];
            }
            $carrier_fees[$it] = array(
                'name' => $carrier['name'],
                'delay' => $delay_output,
                'logo'  => $logo,
				'wm_id' => $carrier['id_carrier']
            );
            $it++;
			
			$customer = Group::getCurrent();
			$customer_type = $customer->id;

			if($carrier['name'] != 'PICKUP'){
				array_push($array_fees, array('fee' => $fees, 'name' => $carrier['name']));
			}else{
				if($customer_type > 4){
					array_push($array_fees, array('fee' => $fees, 'name' => $carrier['name']));
				}

			}
			
            /**array_push($array_fees, array('fee' => $fees, 'name' => $carrier['name']));**/
        }

        sort($array_fees);
		
		/*webmaster total cart*/
		/*$wmtotal=0;
		$wmtotal = $this->context->cart->getOrderTotal(true, Cart::ONLY_PRODUCTS);
		if($wmtotal == 0){
			$wmtotal = $total_price;
		}
		$wmtotal = round($wmtotal, 2);*/
		/*webmaster total cart*/
		
        foreach ($array_fees as $fee) {

            foreach ($carrier_fees as $car_fee) {
                if ($car_fee['name'] == $fee['name']) {
                    $shippingfee[$car_fee['name']] = array(
                        'fees' => $fee['fee'],
                        'delay' => $car_fee['delay'],
                        'logo' => $car_fee['logo'],
						'wm_id' => $car_fee['wm_id']
						/*'wm_total' => ($wmtotal + $fee['fee'])*/
                    );
                }
            }
        }

        $this->smarty->assign(array(
            'shipping_fee' => $shippingfee,
        ));

        return $this->display(__FILE__, 'views/templates/front/shippingFees.tpl');
    }

    public static function getShippingProduct($id_product)
    {
        $sql = 'SELECT * FROM `'._DB_PREFIX_.'product`
                WHERE '._DB_PREFIX_.'product.id_product = '.$id_product;

        return Db::getInstance()->executeS($sql);
    }

    public function getShippingFee($id_zone, $id_carrier, $total_price = null)
    {
        $carrier = new Carrier($id_carrier);

        $shipping_method = $carrier->getShippingMethod();

        $carrier_zone = Carrier::checkCarrierZone($id_carrier, $id_zone);

        if (empty($carrier_zone)) {
            return -1;
        }

        if (($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT && $carrier->getMaxDeliveryPriceByWeight($id_zone) === false)
            || ($shipping_method == Carrier::SHIPPING_METHOD_PRICE && $carrier->getMaxDeliveryPriceByPrice($id_zone) === false)
        ) {
            return -1;
        }

        if (version_compare('1.5', _PS_VERSION_, '<')) {
            //Check if one product contains a dimension which is bigger than carrier
            if ($this->cart) {
                foreach ($this->context->cart->getProducts() as $product) {
                    if (!$this->checkProduct($product, $carrier)) {
                        return -1;
                    }
                }
            } else {
                $product = new Product($this->id_product, $this->id_product_attribute);
                $product_array = array(
                    'width'  => $product->width,
                    'height' => $product->height,
                    'depth'  => $product->depth,
                    'weight' => $product->weight,
                );
                if (!$this->checkProduct($product_array, $carrier)) {
                    return -1;
                }
            }
        }
        $context = new Context();
        if ($shipping_method != Carrier::SHIPPING_METHOD_FREE) {
            if ($carrier->range_behavior) {
                // Get only carriers that have a range compatible with cart
                if (($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT && (!Carrier::checkDeliveryPriceByWeight($carrier->id, $this->getWeight($carrier->id), $id_zone)))
                    || ($shipping_method == Carrier::SHIPPING_METHOD_PRICE
                        && (!Carrier::checkDeliveryPriceByPrice($carrier->id, $this->getPrice(), $id_zone, $context->currency)))) {
                    return -1;
                }
            }
        }

        //Calculate price of the shipping

        if ($shipping_method == Carrier::SHIPPING_METHOD_FREE) {
            $shipping_fee = 0;
        } else {
            if ($shipping_method == Carrier::SHIPPING_METHOD_WEIGHT) {
                $shipping_fee = $carrier->getDeliveryPriceByWeight($this->getWeight($carrier->id), $id_zone);    
            } else {
                if ($shipping_method == Carrier::SHIPPING_METHOD_PRICE) {
                    if ($total_price > 0) {
                        $shipping_fee = $carrier->getDeliveryPriceByPrice($total_price, $id_zone, $context->currency);
                    } else {
                        $shipping_fee = $carrier->getDeliveryPriceByPrice($this->getPrice(), $id_zone, $context->currency);
                    }
                }
            }
        }
        //Calculate price for the handling
        if ($carrier->shipping_handling) {
            $shipping_handling = Configuration::get('PS_SHIPPING_HANDLING');
        } else {
            $shipping_handling = 0;
        }

        //Calculate global shipping fees
        $tax_rate = Tax::getCarrierTaxRate($id_carrier);
        $global_shipping_fee = $shipping_fee + $shipping_handling;

        // fromat with two number after comma, ex. 6.55, 6.50, 6.00
        $global_shipping_fee_format = $global_shipping_fee * (1 + ($tax_rate / 100));

        return number_format($global_shipping_fee_format, 2, '.', '');
        // old version: return round($global_shipping_fee * (1 + ($tax_rate / 100)), 2);
    }

    public function checkProduct($product, $carrier)
    {
        if ($product['width'] > $carrier->max_width && $carrier->max_width != 0) {
            return false;
        }
        if ($product['height'] > $carrier->max_height && $carrier->max_height != 0) {
            return false;
        }
        if ($product['depth'] > $carrier->max_depth && $carrier->max_depth != 0) {
            return false;
        }
        if ($product['weight'] > $carrier->max_weight && $carrier->max_weight != 0) {
            return false;
        }

        return true;
    }

    public function getWeight($id_carrier = null)
    {
        if ($this->cart == true) {
            return $this->context->cart->getTotalWeight(null, $id_carrier);
        } else {
            $product = new Product($this->id_product, $this->id_product_attribute);
            $combinations = $product->getAttributeCombinations($this->context->language->id);
            $combinationWeight = 0;
            foreach ($combinations as $combination) {
                if ($combination['id_product_attribute'] == $this->id_product_attribute) {
                    $combinationWeight += $combination['weight'];
                    break;
                }
            }

            include_once(_PS_ROOT_DIR_.'/modules/dimensionalweight/dimensionalweight.php');
            $dimensionalweight = new DimensionalWeight();
            if (!$dimensionalweight->active || !$id_carrier) {
                return $product->weight * $this->quantity + $combinationWeight * $this->quantity;
            }

            $dim_weight_params = $dimensionalweight->getCarrierRuleWithIdCarrier($id_carrier);
            if (!is_null($product))
            {
                $total_weight = 0;
                $real_weight = $product->weight + $combinationWeight;
                if (!empty($dim_weight_params))
                {
                    $dim_weight = (($product->width * $product->height * $product->depth) / $dim_weight_params['factor']);
                    $weight = ($dim_weight > $real_weight ? $dim_weight : $real_weight);
                    $total_weight += $weight * $this->quantity;
                }
                else
                    $total_weight = $product->weight * $this->quantity + $combinationWeight * $this->quantity;
                return $total_weight;
            }
        }
    }

    public function getPrice()
    {
        if ($this->cart == true) {
            return $this->context->cart->getOrderTotal(true, Cart::BOTH_WITHOUT_SHIPPING);
        } else {
            $product = new Product($this->id_product, $this->id_product_attribute);
            $price= round($product->getPrice(), 2) * $this->quantity;
            if(Configuration::get('TOT_SHIPPING_SHOW_PRICE_WITH_CART', 0)) {
                $price += $this->context->cart->getOrderTotal(true, Cart::BOTH_WITHOUT_SHIPPING);
            }

            return $price;
        }
    }

    public function getOverrideText($text)
    {
        switch ($text) {
            case 'min_label':
                $output = $this->l('Estimation min. (days)');
                break;
            case 'min_hint':
                $output = $this->l('Enter the minimum delivery time for the chosen carrier. This value will be used for the computation of delivery times by the "Shipping fee preview" module');
                break;
            case 'max_label':
                $output = $this->l('Estimation max. (days)');
                break;
            case 'max_hint':
                $output = $this->l('Enter the maximum delivery time for the chosen carrier. This value will be used for the computation of delivery times by the "Shipping fee preview" module');
                break;
            case 'error':
                $output = $this->l('Minimum estimation bigger than maximum estimation');
                break;
            default:
                $output = $this->l('If these fields are not filled the time estimation will not be displayed on your site. In this case the Transit time will be displayed in shipping preview');
                break;
        }

        return $output;
    }

    ############################################################################################################
    # Logger // Debug
    ############################################################################################################

    public function writeLog($message)
    {
        if ($this->debug) {
            $log = '['.date('Y-m-d H:i:s').'] '.$message."\n";
            file_put_contents(_PS_MODULE_DIR_.$this->name.'/log.txt', $log, FILE_APPEND);
        }
    }
}
