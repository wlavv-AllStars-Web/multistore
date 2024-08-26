<?php
/**
 * Copyright ETS Software Technology Co., Ltd
 *
 * NOTICE OF LICENSE
 *
 * This file is not open source! Each license that you purchased is only available for 1 website only.
 * If you want to use this file on more websites (or projects), you need to purchase additional licenses.
 * You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.
 *
 * @author ETS Software Technology Co., Ltd
 * @copyright  ETS Software Technology Co., Ltd
 * @license    Valid for 1 website (or project) for each purchase of license
 */

if (!defined('_PS_VERSION_')) { exit; }

class Ets_onepagecheckoutCallbackModuleFrontController extends ModuleFrontController
{
	public $errors = array();
	public function __construct()
	{	
       parent::__construct();
	}
	public function initContent()
	{
		parent::initContent();
		try
        {
            $hybridauth = new Hybridauth\Hybridauth($this->module->getLoginConfigs());
            $storage = new Hybridauth\Storage\Session();
            if (($provider = $storage->get('provider')))
            {
                if (!(isset($this->context->cookie->soloProvider)) || !$this->context->cookie->soloProvider || $this->context->cookie->soloProvider != $provider)
                {
                    $this->context->cookie->soloProvider = $provider;
                    $this->context->cookie->write();
                }
                $adapter = $hybridauth->getAdapter($provider);
                
                $adapter->authenticate();
                
                $userProfile = $adapter->getUserProfile();
                return $this->etsProsessProfile($userProfile,$storage,$provider);
            }
        }
        catch (Hybridauth\Exception\Exception $exception)
        {
            $this->context->smarty->assign(
                array(
                    'ets_opc_link_back' => $this->context->cookie->ets_opc_link_back,
                    'ph_conn_back_link' =>$this->context->cookie->ph_conn_back_link,
                    'error' =>$this->module->l('Encountered an issue with the social network, please come back later.','callback'),
                )
            );
            echo $this->context->smarty->fetch(dirname(__FILE__).'/../../views/templates/hook/frontJs.tpl');
            exit;
        }
        if (!$this->context->customer->isLogged()){
            Tools::redirectLink($this->context->link->getPageLink('index', Tools::usingSecureMode()? true : false));
        }
	}
    
    public function etsProsessProfile($userProfile = false, $storage = false, $provider = false){
        if (empty($userProfile->email)){
            if (($registerEmail = Tools::getValue('email', null))) {
                if (!Validate::isEmail($registerEmail)) {
                    $this->errors[] = $this->module->l('Email is invalid','callback');
                } elseif(Customer::customerExists($registerEmail)) {
                    $this->errors[] = $this->module->l('Email is exist. Please enter other email.','callback');
                } else {
                    $userProfile->email = $registerEmail;
                }
            }
        }
        if(!$userProfile->firstName)
        {
            if (($firstName = Tools::getValue('first_name', null))) {
                if (!Validate::isCustomerName($firstName)) {
                    $this->errors[] = $this->module->l('First name is invalid','callback');
                }
                else {
                    $userProfile->firstName = $firstName;
                }
            }
        }
        if(!$userProfile->lastName)
        {
            if (($lastName = Tools::getValue('last_name', null))) {
                if (!Validate::isCustomerName($lastName)) {
                    $this->errors[] = $this->module->l('Last name is invalid','callback');
                }
                else {
                    $userProfile->lastName = $lastName;
                }
            }
        }
        if (empty($userProfile->email) || !$userProfile->firstName || !$userProfile->lastName){
            $this->context->smarty->assign(array(
                'action' => $this->context->link->getModuleLink($this->module->name, 'callback', array('provider' => $provider), true),
                'errors' => $this->errors? $this->module->displayError($this->errors) : false,
                'userProfile' =>$userProfile,
            ));
            return $this->setTemplate('module:'.$this->module->name.'/views/templates/front/register.tpl');
        }
        else{
            if (($id_customer = Customer::customerExists($userProfile->email, true, true))) {
                $customer = new Customer($id_customer);
                $customer->newsletter = 1;
                $customer->optin =1;
                if($customer->newsletter_date_add=='0000-00-00 00:00:00')
                    $customer->newsletter_date_add = date('y-m-d H:i:s');
                $customer->update();
                $this->context->updateCustomer($customer);
                Hook::exec('actionAuthentication', array('customer' => $customer,'login_social'=>true));
                $this->saveLogin(false);
            } else {
                $this->module->createUser($userProfile, $provider);
                $this->saveLogin(true);
            }
            if ($storage){
                $storage->set('provider', null);
            }
            if (!$this->errors) {
                $this->context->smarty->assign(
                    array(
                        'ets_opc_link_back' => $this->context->cookie->ets_opc_link_back,
                        'ph_conn_back_link' =>$this->context->cookie->ph_conn_back_link,
                    )
                );
                echo $this->context->smarty->fetch(dirname(__FILE__).'/../../views/templates/hook/frontJs.tpl');
                exit;
            }
        }
    }
    public function saveLogin($create=false)
    {
        if($this->context->cookie->soloProvider && $this->context->customer->id)
        {
            $social =0;
            switch(Tools::strtolower($this->context->cookie->soloProvider))
            {
                case 'paypal' :
                    $social = Ets_onepagecheckout::LOGIN_PAYPAL;
                break;
                case 'facebook' :
                    $social = Ets_onepagecheckout::LOGIN_FACEBOOK;
                break;
                case 'google' :
                    $social = Ets_onepagecheckout::LOGIN_GOOGLE;
                break;
            }
            if($social)
            {
                Ets_opc_db::updateCustomerSocial($this->context->customer->id,$social,$create);
            }
        }
    }
}