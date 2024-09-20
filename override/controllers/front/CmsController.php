<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */
class CmsControllerCore extends FrontController
{
    public const CMS_CASE_PAGE = 1;
    public const CMS_CASE_CATEGORY = 2;

    /** @var string */
    public $php_self = 'cms';
    public $assignCase;

    /**
     * @deprecated Since 8.1, it will become protected in next major version. Use getCms() method instead.
     *
     * @var CMS|null
     */
    public $cms;

    /**
     * @deprecated Since 8.1, it will become protected in next major version. Use getCmsCategory() method instead.
     *
     * @var CMSCategory|null
     */
    public $cms_category;

    /** @var bool */
    public $ssl = false;

    public function canonicalRedirection($canonicalURL = '')
    {
        if (Validate::isLoadedObject($this->cms) && ($canonicalURL = $this->context->link->getCMSLink($this->cms, $this->cms->link_rewrite))) {
            parent::canonicalRedirection($canonicalURL);
        } elseif (Validate::isLoadedObject($this->cms_category) && ($canonicalURL = $this->context->link->getCMSCategoryLink($this->cms_category))) {
            parent::canonicalRedirection($canonicalURL);
        }
    }

    /**
     * Initialize cms controller.
     *
     * @see FrontController::init()
     */
    public function init()
    {
        if ($id_cms = (int) Tools::getValue('id_cms')) {
            $this->cms = new CMS($id_cms, $this->context->language->id, $this->context->shop->id);
        } elseif ($id_cms_category = (int) Tools::getValue('id_cms_category')) {
            $this->cms_category = new CMSCategory($id_cms_category, $this->context->language->id, $this->context->shop->id);
        }

        if (Configuration::get('PS_SSL_ENABLED') && Tools::getValue('content_only') && $id_cms && Validate::isLoadedObject($this->cms)
            && in_array($id_cms, $this->getSSLCMSPageIds())) {
            $this->ssl = true;
        }

        parent::init();

        $this->canonicalRedirection();

        if (Validate::isLoadedObject($this->cms)) {
            $adtoken = Tools::getAdminToken('AdminCmsContent' . (int) Tab::getIdFromClassName('AdminCmsContent') . (int) Tools::getValue('id_employee'));
            if (!$this->cms->isAssociatedToShop() || !$this->cms->active && Tools::getValue('adtoken') != $adtoken) {
                $this->redirect_after = '404';
                $this->redirect();
            } else {
                $this->assignCase = self::CMS_CASE_PAGE;
            }
        } elseif (Validate::isLoadedObject($this->cms_category) && $this->cms_category->active) {
            $this->assignCase = self::CMS_CASE_CATEGORY;
        } else {
            $this->redirect_after = '404';
            $this->redirect();
        }
    }

    /**
     * Assign template vars related to page content.
     *
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        if ($this->assignCase == self::CMS_CASE_PAGE) {
            $cmsVar = $this->objectPresenter->present($this->cms);

            // Chained hook call - if multiple modules are hooked here, they will receive the result of the previous one as a parameter
            $filteredCmsContent = Hook::exec(
                'filterCmsContent',
                ['object' => $cmsVar],
                null,
                false,
                true,
                false,
                null,
                true
            );
            if (!empty($filteredCmsContent['object'])) {
                $cmsVar = $filteredCmsContent['object'];
            }

            $this->context->smarty->assign([
                'cms' => $cmsVar,
            ]);

            if ($this->cms->indexation == 0) {
                $this->context->smarty->assign('nobots', true);
            }

            $this->setTemplate(
                'cms/page',
                ['entity' => 'cms', 'id' => $this->cms->id]
            );
        } elseif ($this->assignCase == self::CMS_CASE_CATEGORY) {
            $cmsCategoryVar = $this->getTemplateVarCategoryCms();

            // Chained hook call - if multiple modules are hooked here, they will receive the result of the previous one as a parameter
            $filteredCmsCategoryContent = Hook::exec(
                'filterCmsCategoryContent',
                ['object' => $cmsCategoryVar],
                null,
                false,
                true,
                false,
                null,
                true
            );
            if (!empty($filteredCmsCategoryContent['object'])) {
                $cmsCategoryVar = $filteredCmsCategoryContent['object'];
            }

            $this->context->smarty->assign($cmsCategoryVar);
            $this->setTemplate(
                'cms/category',
                ['entity' => 'cms_category', 'id' => $this->cms_category->id]
            );
        }
        parent::initContent();
        $this->context->smarty->assign('countries', self::getCountries());
        
    }

    /**
     * Return an array of IDs of CMS pages, which shouldn't be forwared to their canonical URLs in SSL environment.
     * Required for pages which are shown in iframes.
     */
    protected function getSSLCMSPageIds()
    {
        return [(int) Configuration::get('PS_CONDITIONS_CMS_ID'), (int) Configuration::get('LEGAL_CMS_ID_REVOCATION')];
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        if ($this->assignCase == self::CMS_CASE_CATEGORY) {
            $cmsCategory = new CMSCategory($this->cms_category->id_cms_category);
        } else {
            $cmsCategory = new CMSCategory($this->cms->id_cms_category);
        }

        if ($cmsCategory->id_parent != 0) {
            foreach (array_reverse($cmsCategory->getParentsCategories()) as $category) {
                if ($category['active']) {
                    $cmsSubCategory = new CMSCategory($category['id_cms_category']);
                    $breadcrumb['links'][] = [
                        'title' => $cmsSubCategory->getName(),
                        'url' => $this->context->link->getCMSCategoryLink($cmsSubCategory),
                    ];
                }
            }
        }

        if ($this->assignCase == self::CMS_CASE_PAGE && $this->context->controller instanceof CmsControllerCore) {
            $breadcrumb['links'][] = [
                'title' => $this->context->controller->cms->meta_title,
                'url' => $this->context->link->getCMSLink($this->context->controller->cms),
            ];
        }

        return $breadcrumb;
    }

    public function getTemplateVarPage()
    {
        $page = parent::getTemplateVarPage();

        if ($this->assignCase == self::CMS_CASE_CATEGORY) {
            $page['body_classes']['cms-id-' . $this->cms_category->id] = true;
        } else {
            $page['body_classes']['cms-id-' . $this->cms->id] = true;
            if (!$this->cms->indexation) {
                $page['meta']['robots'] = 'noindex';
            }
        }

        return $page;
    }

    public function getTemplateVarCategoryCms()
    {
        $categoryCms = [];

        $categoryCms['cms_category'] = $this->objectPresenter->present($this->cms_category);
        $categoryCms['sub_categories'] = [];
        $categoryCms['cms_pages'] = [];

        foreach ($this->cms_category->getSubCategories($this->context->language->id) as $subCategory) {
            $categoryCms['sub_categories'][$subCategory['id_cms_category']] = $subCategory;
            $categoryCms['sub_categories'][$subCategory['id_cms_category']]['link'] = $this->context->link->getCMSCategoryLink($subCategory['id_cms_category'], $subCategory['link_rewrite']);
        }

        foreach (CMS::getCMSPages($this->context->language->id, (int) $this->cms_category->id, true, (int) $this->context->shop->id) as $cmsPages) {
            $categoryCms['cms_pages'][$cmsPages['id_cms']] = $cmsPages;
            $categoryCms['cms_pages'][$cmsPages['id_cms']]['link'] = $this->context->link->getCMSLink($cmsPages['id_cms'], $cmsPages['link_rewrite']);
        }

        return $categoryCms;
    }

    /**
     * @return CMS|null
     */
    public function getCms()
    {
        return $this->cms;
    }

    /**
     * @return CMSCategory|null
     */
    public function getCmsCategory()
    {
        return $this->cms_category;
    }

    /**
     * {@inheritdoc}
     */
    public function getCanonicalURL()
    {
        if (Validate::isLoadedObject($this->cms)) {
            return $this->context->link->getCMSLink($this->cms, $this->cms->link_rewrite);
        } elseif (Validate::isLoadedObject($this->cms_category)) {
            return $this->context->link->getCMSCategoryLink($this->cms_category);
        }

        return '';
    }

    public function getCountries(){
        
        // echo '<pre>'.print_r($this->context->language->id,1).'</pre>';
        // exit;
        $query='SELECT '._DB_PREFIX_.'country.id_country, `name`, '._DB_PREFIX_.'country_lang.id_lang, `call_prefix` FROM `'._DB_PREFIX_.'country` INNER JOIN `'._DB_PREFIX_.'country_lang` ON '._DB_PREFIX_.'country.id_country='._DB_PREFIX_.'country_lang.id_country AND '._DB_PREFIX_.'country_lang.id_lang = '.$this->context->language->id.' ORDER BY name ASC';
        
        //echo $query;
        //exit;
        
        
        return  Db::getInstance()->executeS($query);

    }

    public function postProcess()
    {
        $error = 0;
        if(Tools::getValue('action_job') == "form_specificRequest"){
            $var_list['{firstname}'] = Tools::getValue('firstname');
            $var_list['{lastname}'] = Tools::getValue('lastname');
            $var_list['{email}'] = Tools::getValue('email');

            $var_list['{brand}'] = Tools::getValue('brand');
            $var_list['{model}'] = Tools::getValue('model');
            $var_list['{type}'] = Tools::getValue('type');
            $var_list['{version}'] = Tools::getValue('version');

            $var_list['{product_brand}'] = Tools::getValue('product_brand');
            $var_list['{product_type}'] = Tools::getValue('product_type');

            $var_list['{aditional_info}'] = Tools::getValue('aditional_info');

            Mail::Send($this->context->language->id, 'specific_request', 'Specific Request', $var_list, 'pauloallstarsweb@gmail.com', 'Specific Request', null, null, null, null, _PS_MAIL_DIR_, false, null, null, $var_list['{email}']);
            $this->context->smarty->assign(array( 'email_sent' => 1 ));
            Tools::redirect($this->context->link->getCMSLink(53));
        }

        if(Tools::getValue('action_job') == "form_job"){
            
            $var_list['{gender}'] = Tools::getValue('gender') == "1" ? "Male" :"Female";
            $var_list['{name}'] = Tools::getValue('first_name');
            $var_list['{surname}'] = Tools::getValue('last_name');
            $var_list['{email}'] = Tools::getValue('email_job');
            $var_list['{phone_code}'] = Tools::getValue('country_code');
            $var_list['{phone}'] = Tools::getValue('phone_number');
            $var_list['{addresse_line_1}'] = Tools::getValue('address_line_1');
            $var_list['{addresse_line_2}'] = Tools::getValue('address_line_2');
            $var_list['{distrito}'] = Tools::getValue('distrito');
            $var_list['{city}'] = Tools::getValue('city');
            $var_list['{postal_code}'] = Tools::getValue('post_code');
            $var_list['{country}'] = Tools::getValue('country');
            $var_list['{position}'] = Tools::getValue('position');
            $var_list['{from_where}'] = Tools::getValue('from_where');
            $var_list['{contact_preference}'] = Tools::getValue('contact_preference');
            $var_list['{lang}'] = Tools::getValue('lang');

            if (isset($_FILES['fileUpload']['name']) && !empty($_FILES['fileUpload']['name']) && !empty($_FILES['fileUpload']['tmp_name'])){
                
            	$extension = array('.pdf');
            	$filename = uniqid().basename($_FILES['fileUpload']['name']);
            	$filename = str_replace(' ', '-', $filename);
            	$filename = strtolower($filename);
            	$filename = filter_var($filename, FILTER_SANITIZE_STRING);
            	$_FILES['fileUpload']['name'] = $filename;
            	$uploader = new UploaderCore();
            	$uploader->upload($_FILES['fileUpload']);
                $var_list['{cv}'] = '/upload/' . $filename;
            }

            Mail::Send($this->context->language->id, 'job_candidate', 'JOB APPLICATION', $var_list,  'pauloallstarsweb@gmail.com', 'Job Application', null, null, null, null, _PS_MAIL_DIR_, false, null, null, $var_list['{email}']);
            $this->context->smarty->assign(array( 'email_sent' => 2 ));
            
        }else{
            $businessType = Tools::getValue('business_type');
            if (!is_array($businessType)) {
                $businessType = [$businessType];
            }
            $main_market = Tools::getValue('main_market');
            if (!is_array($main_market)) {
                $main_market = [$main_market];
            }
            $annual_sales = Tools::getValue('annual_sales');
            if (!is_array($annual_sales)) {
                $annual_sales = [$annual_sales];
            }

            $var_list['{name}'] = Tools::getValue('name');
            $var_list['{surname}'] = Tools::getValue('surname');
            $var_list['{company}'] = Tools::getValue('company');
            $var_list['{company_tva}'] = Tools::getValue('company_tva');
            $var_list['{email}'] = Tools::getValue('email');
            $var_list['{phone}'] = Tools::getValue('phone');
            $var_list['{site}'] = Tools::getValue('site');
            $var_list['{social}'] = Tools::getValue('social');
            $var_list['{adresse_line_1}'] = Tools::getValue('adresse_line_1');
            $var_list['{adresse_line_2}'] = Tools::getValue('adresse_line_2');
            $var_list['{city}'] = Tools::getValue('city');
            $var_list['{postal_code}'] = Tools::getValue('postal_code');
            $var_list['{country}'] = Tools::getValue('country');
            $var_list['{business_type}'] = implode(', ', $businessType);
            $var_list['{main_market}'] = implode(', ', $main_market);
            $var_list['{annual_sales}'] = implode(', ', $annual_sales);
            $var_list['{supplier_1}'] = Tools::getValue('supplier_1');
            $var_list['{supplier_2}'] = Tools::getValue('supplier_2');
            $var_list['{supplier_3}'] = Tools::getValue('supplier_3');
            $var_list['{observations}'] = Tools::getValue('observations');


        if (Tools::getValue('type') == 'becomedealer') {
            if ( (Tools::getValue('site') == '') && (Tools::getValue('social') == '') ) {
                $this->context->smarty->assign(array( 'form_error' => 1 ));
                $error = 1;
            }elseif ( strlen($var_list['{business_type}']) < 1) {
                $this->context->smarty->assign(array( 'form_error' => 2 ));
                $error = 1;
            }elseif ( strlen($var_list['{main_market}']) < 1) {
                $this->context->smarty->assign(array( 'form_error' => 3 ));
                $error = 1;
            }elseif (!filter_var(Tools::getValue('email'), FILTER_VALIDATE_EMAIL)) {
                $this->context->smarty->assign(array( 'form_error' => 4 ));
                $error = 1;
            }elseif ((Tools::getValue('site') != '') && (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",Tools::getValue('site')))) {
                $this->context->smarty->assign(array( 'form_error' => 5 ));
                $error = 1;
            }elseif ((Tools::getValue('social') != '') &&  (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",Tools::getValue('social')))) {
                $this->context->smarty->assign(array( 'form_error' => 6 ));
                $error = 1;
            }else{
            
                Mail::Send($this->context->language->id, 'become_dealer', 'BECOME A DEALER', $var_list,  'pauloallstarsweb@gmail.com', 'BECOME A DEALER', null, null, null, null, _PS_MAIL_DIR_, false, null, null, $var_list['{email}']);
                $this->context->smarty->assign(array( 'email_sent' => 1 ));
            
            }
    
        }elseif (Tools::getValue('type') == 'becomesupplier') {
            Mail::Send($this->context->language->id, 'become_supplier', 'BECOME A SUPPLIER', $var_list, 'pauloallstarsweb@gmail.com', 'BECOME A SUPPLIER', null, null, null, null, _PS_MAIL_DIR_, false, null, null, $var_list['{email}']);
            $this->context->smarty->assign(array( 'email_sent' => 1 ));
            
        }else{
            $this->context->smarty->assign(array( 'email_sent' => 0 ));
        } 
        }

       
        
    }
}
