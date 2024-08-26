<?php
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class Wmmodule_Homepage extends Module implements WidgetInterface
{
    protected $_html = '';
    protected $default_width = 779;
    protected $default_pause = 5000;
    protected $default_pause_on_hover = 1;
    protected $default_pager = 1;
    protected $templateFile;

    public function __construct()
    {
        $this->name = "wmmodule_homepage";
        $this->tab = "front_office_features";
        $this->version = "1.0.0";
        $this->author = "AllStars WEB";
        $this->need_instance = 0;
        $this->secure_key = Tools::encrypt($this->name);
        $this->bootstrap = true;

        $this->displayName = $this->getTranslator()->trans('Homepage editor', array(), 'Modules.Imageslider.Admin');
        $this->description = $this->getTranslator()->trans('Homepage manager and slider to your site.', array(), 'Modules.Imageslider.Admin');
        $this->ps_versions_compliancy = array('min' => '1.7.0.0', 'max' => _PS_VERSION_);

        parent::__construct();
        
        $this->templateFile = 'module:wmmodule_homepage/views/templates/hook/slider.tpl';
    }
	
    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }
        
        if (parent::install() &&
        $this->registerHook('displayHome') &&
        $this->registerHook('displayBeforeBodyClosingTag') &&
        $this->registerHook('displayTopColumn') &&
        $this->registerHook('actionShopDataDuplication')
    ) {

        $shops = Shop::getContextListShopID();
        $shop_groups_list = array();

        /* Setup each shop */
        foreach ($shops as $shop_id) {
            $shop_group_id = (int)Shop::getGroupFromShop($shop_id, true);

            if (!in_array($shop_group_id, $shop_groups_list)) {
                $shop_groups_list[] = $shop_group_id;
            }

            /* Sets up configuration */
            $res = Configuration::updateValue('ANGARSLIDER_PAUSE', $this->default_pause, false, $shop_group_id, $shop_id);
            $res &= Configuration::updateValue('ANGARSLIDER_PAUSE_ON_HOVER', $this->default_pause_on_hover, false, $shop_group_id, $shop_id);
            $res &= Configuration::updateValue('ANGARSLIDER_PAGER', $this->default_pager, false, $shop_group_id, $shop_id);
        }

        /* Sets up Shop Group configuration */
        if (count($shop_groups_list)) {
            foreach ($shop_groups_list as $shop_group_id) {
                $res &= Configuration::updateValue('ANGARSLIDER_PAUSE', $this->default_pause, false, $shop_group_id);
                $res &= Configuration::updateValue('ANGARSLIDER_PAUSE_ON_HOVER', $this->default_pause_on_hover, false, $shop_group_id);
                $res &= Configuration::updateValue('ANGARSLIDER_PAGER', $this->default_pager, false, $shop_group_id);
            }
        }

        /* Sets up Global configuration */
        $res &= Configuration::updateValue('ANGARSLIDER_PAUSE', $this->default_pause);
        $res &= Configuration::updateValue('ANGARSLIDER_PAUSE_ON_HOVER', $this->default_pause_on_hover);
        $res &= Configuration::updateValue('ANGARSLIDER_PAGER', $this->default_pager);

        $this->installMenu();

        return true;
    }
    }

    public function installMenu()
    {
        $tab = new Tab();

        foreach (Language::getLanguages(true) as $lang) {
            switch ($lang['iso_code']) {
                case 'fr':
                    $tab->name[$lang['id_lang']] = 'HomeEditor';
                    break;
                default:
                    $tab->name[$lang['id_lang']] = 'HomeEditor';
                    break;
            }
        }

        $tab->class_name = 'AdminWmModuleHomepage';
        $tab->id_parent = Tab::getIdFromClassName('SELL');
        $tab->module = $this->name;
        $tab->icon = 'article';
        $tab->add();
    }

    public function uninstall()
    {
        if (parent::uninstall() == false) return false;
		
        return true;
    }

    public function hookdisplayHeader($params)
    {
        $this->context->controller->addCSS($this->_path.'views/css/wmmodule_homepage.css');
        $this->context->controller->addCSS($this->_path.'views/css/hooks.css');
    }

    public function hookDisplayBeforeBodyClosingTag($params)
    {
        $this->smarty->assign(array(
            'pause' => Configuration::get('ANGARSLIDER_PAUSE'),
            'pause_hover' => Configuration::get('ANGARSLIDER_PAUSE_ON_HOVER'),
            'pager' => Configuration::get('ANGARSLIDER_PAGER'),
        ));

        return $this->display(__FILE__, 'views/templates/hook/slider_script.tpl');
    }

    public function renderWidget($hookName = null, array $configuration = array())
    {
        if (!$this->isCached($this->templateFile, $this->getCacheId())) {
            $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));
        }

        return $this->fetch($this->templateFile, $this->getCacheId());
    }

    public function getWidgetVariables($hookName = null, array $configuration = array())
    {
        if ($hookName || $configuration) {
        }
        $slides = $this->getSlides(true);
       // print_r($slides);

        if (is_array($slides)) {
            foreach ($slides as &$slide) {
                $slide['sizes'] = @getimagesize((dirname(__FILE__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $slide['image']));
                if (isset($slide['sizes'][3]) && $slide['sizes'][3]) {
                    $slide['size'] = $slide['sizes'][3];
                }
            }
        }

        $config = $this->getConfigFieldsValues();

        return array(
            'angarslider' => array(
                'pause' => $config['ANGARSLIDER_PAUSE'],
                'pause_hover' => $config['ANGARSLIDER_PAUSE_ON_HOVER'] ? 'true' : 'false',
                'pager' => $config['ANGARSLIDER_PAGER'] ? 'true' : 'false',
                'slides' => $slides,
            ),
        );
    }

    private function updateUrl($link)
    {
        return $link;
    }

    public function clearCache()
    {
        $this->_clearCache($this->templateFile);
    }

    public function hookActionShopDataDuplication($params)
    {
        Db::getInstance()->execute('
            INSERT IGNORE INTO '._DB_PREFIX_.'angarslider (id_angarslider_slides, id_shop)
            SELECT id_angarslider_slides, '.(int)$params['new_id_shop'].'
            FROM '._DB_PREFIX_.'angarslider
            WHERE id_shop = '.(int)$params['old_id_shop']);
        $this->clearCache();
    }

    public function getSlides($active = null)
    {
        $this->context = Context::getContext();
        $id_shop = $this->context->shop->id;
        $id_lang = $this->context->language->id;
        $isoo = $this->context->language->iso_code;

        if($isoo == 'en'){
            $slides = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT `id`,`image_en` as imagem,`link` as link,`title_en` as title, `title_en` as youtube, `icon_type` FROM `'._DB_PREFIX_.'asm_homepage` WHERE `active` = 1');
        }
        if($isoo == 'fr'){
            $slides = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT `id`,`image_fr` as imagem,`link` as link,`title_fr` as title, `title_en` as youtube, `icon_type` FROM `'._DB_PREFIX_.'asm_homepage` WHERE `active` = 1');
            }
        if($isoo == 'es'){
            $slides = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT `id`,`image_es` as imagem,`link` as link,`title_es` as title, `title_en` as youtube, `icon_type` FROM `'._DB_PREFIX_.'asm_homepage` WHERE `active` = 1');
            }
        if($isoo == 'pt'){
            $slides = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT `id`,`image_pt` as imagem,`link` as link,`title_pt` as title, `title_en` as youtube, `icon_type` FROM `'._DB_PREFIX_.'asm_homepage` WHERE `active` = 1');
        }
        foreach ($slides as &$slide) {
            $slide['image_url'] = $slide['imagem'];
            $slide['description'] = $slide['title'];
            $slide['url'] = $this->updateUrl($slide['link']);
        }

        return $slides;
    }

    public function getConfigFieldsValues()
    {
        $id_shop_group = Shop::getContextShopGroupID();
        $id_shop = Shop::getContextShopID();

        return array(
            'ANGARSLIDER_PAUSE' => Tools::getValue('ANGARSLIDER_PAUSE', Configuration::get('ANGARSLIDER_PAUSE', null, $id_shop_group, $id_shop)),
            'ANGARSLIDER_PAUSE_ON_HOVER' => Tools::getValue('ANGARSLIDER_PAUSE_ON_HOVER', Configuration::get('ANGARSLIDER_PAUSE_ON_HOVER', null, $id_shop_group, $id_shop)),
            'ANGARSLIDER_PAGER' => Tools::getValue('ANGARSLIDER_PAGER', Configuration::get('ANGARSLIDER_PAGER', null, $id_shop_group, $id_shop)),
        );
    }

}