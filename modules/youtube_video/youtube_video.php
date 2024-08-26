<?php

if (!defined('_PS_VERSION_'))
    exit();

class Youtube_Video extends Module
{
    public function __construct()
    {
        $this->name = 'youtube_video';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Paulo Gonçalves';
        $this->need_instance = 1;
        $this->ps_versions_compliancy = [
            'min' => '1.7.0.0',
            'max' => '8.99.99',
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans('YouTube Video', [], 'Modules.Mymodule.Admin');
        $this->description = $this->trans('This module is developed to display an YouTube video.', [], 'Modules.Mymodule.Admin');

        $this->confirmUninstall = $this->trans('Are you sure you want to uninstall?', [], 'Modules.Mymodule.Admin');

        if (!Configuration::get('MYMODULE_NAME')) {
            $this->warning = $this->trans('No name provided', [], 'Modules.Mymodule.Admin');
        }
    }

    public function install()
    {
        if (Shop::isFeatureActive())
            Shop::setContext(Shop::CONTEXT_ALL);
    
        return parent::install() &&
            $this->registerHook('displayHome') && Configuration::updateValue('youtube_video_url', 'wlsdMpnDBn8');
    }
    
    public function uninstall()
    {
        if (!parent::uninstall() || !Configuration::deleteByName('youtube_video_url'))
            return false;
        return true;
    }

    public function hookDisplayHome($params)
    {
        // < assign variables to template >
        $this->context->smarty->assign(
            array('youtube_urls' => array(
                Configuration::get('youtube_video_url'),
                Configuration::get('youtube_video_url2'),
                Configuration::get('youtube_video_url3'),
            ))
        );
        return $this->display(__FILE__, 'youtube_video.tpl');
    }

    public function displayForm()
    {
        // < init fields for form array >
        $fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->trans('YouTube Module'),
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->trans('URL of the YouTube video'),
                    'name' => 'youtube_video_url',
                    'required' => true
                ),
                array(
                    'type' => 'text',
                    'label' => $this->trans('URL of the YouTube video 2'),
                    'name' => 'youtube_video_url2',
                    'required' => true
                ),
                array(
                    'type' => 'text',
                    'label' => $this->trans('URL of the YouTube video 3'),
                    'name' => 'youtube_video_url3',
                    'required' => true
                ),
            ),
            'submit' => array(
                'title' => $this->trans('Save'),
                'class' => 'btn btn-default pull-right'
            )
        );
       
        // < load helperForm >
        $helper = new HelperForm();

        // < module, token and currentIndex >
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

        // < title and toolbar >
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;        // false -> remove toolbar
        $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
        $helper->submit_action = 'submit'.$this->name;
        $helper->toolbar_btn = array(
            'save' =>
                array(
                    'desc' => $this->trans('Save'),
                    'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
                        '&token='.Tools::getAdminTokenLite('AdminModules'),
                ),
            'back' => array(
                'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->trans('Back to list')
            )
        );

        // < load current value >
        $helper->fields_value['youtube_video_url'] = Configuration::get('youtube_video_url');
        $helper->fields_value['youtube_video_url2'] = Configuration::get('youtube_video_url2');
        $helper->fields_value['youtube_video_url3'] = Configuration::get('youtube_video_url3');

        return $helper->generateForm($fields_form);
    }

    public function getContent()
    {
        $output = null;


        // < here we check if the form is submited for this module >
        if (Tools::isSubmit('submit'.$this->name)) {
            $youtube_url = strval(Tools::getValue('youtube_video_url'));
            $youtube_url2 = strval(Tools::getValue('youtube_video_url2'));
            $youtube_url3 = strval(Tools::getValue('youtube_video_url3'));

                // < make some validation, check if we have something in the input >
            if (!isset($youtube_url) || !isset($youtube_url2) || !isset($youtube_url3)) {
                $output .= $this->displayError($this->trans('Please insert something in all fields.'));
            } else {
                // < this will update the value of the Configuration variable >
                Configuration::updateValue('youtube_video_url', $youtube_url);
                Configuration::updateValue('youtube_video_url2', $youtube_url2);
                Configuration::updateValue('youtube_video_url3', $youtube_url3);

                // < this will display the confirmation message >
                $output .= $this->displayConfirmation($this->trans('Video URLs updated!'));
            }
        }
        return $output.$this->displayForm();
    }

}