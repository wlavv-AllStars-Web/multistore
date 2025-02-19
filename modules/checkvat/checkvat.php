<?php
/**
* History:
*
* 1.0 - First version (only for prestashop 1.4)
* 1.5 - Only for prestashop version 1.5
* 1.5.2 - Correction little bug when the group is "Client"
* 1.5.3 - Add possibility to valid if VIES is enable, Add table with last customers in the back office home page
* 1.5.4 - Allow group pro only (not default)
* 1.5.4.1 - optimisation when VIES is "out"
* 1.5.5 - Add VAT number in the invoice and add Croatia in the list of country
* 1.5.6 - little debug (VAT number also included in the footer of PDF)
* 1.6 - update for v1.6, add hookdashboardZoneTwo 
*
*  @author    Vincent MASSON <contact@coeos.pro>
*  @copyright Vincent MASSON <www.coeos.pro>
*  @license   http://www.coeos.pro/boutique/fr/content/3-conditions-generales-de-ventes
*/

if (!defined('_PS_VERSION_'))
	exit;

class CheckVat extends Module
{
	/* @var boolean error */
	protected $error = false;

	/**
	* Module constructor
	*/
	public function __construct()
	{
		$this->name = 'checkvat';
		$this->tab = 'front_office_features';
		$this->version = '1.6';
		$this->author = 'www.coeos.pro';
		$this->module_key = '77467eb09c97f9f12c00533374ef19e4';

		parent::__construct();

		$this->displayName = $this->l('Check VAT');
		$this->description = $this->l('Adds an addon to check VAT');
		$this->confirmUninstall = $this->l('Are you sure you want to remove your module "controller VAT" ?');

		if (Tools::getValue('action') === 'saveVat') {
			$this->handleSaveVat();
		}
	}

	public function handleSaveVat()
{
    // Get the customer ID and VAT number from the request
    $idCustomer = (int)$this->context->customer->id;
    $vatNumber = Tools::getValue('siret');
    

    // Ensure the customer is logged in and input is valid
    if (!$idCustomer) {
        $this->context->controller->errors[] = $this->l('You must be logged in to save your VAT number.');
        Tools::redirect($this->context->link->getPageLink('my-account'));
    }

    if (empty($vatNumber)) {
        $this->context->controller->errors[] = $this->l('VAT number cannot be empty.');
        Tools::redirect($this->context->link->getPageLink('my-account'));
    }

    // Save the VAT number
    if (!$this->saveVatNumber($idCustomer, $vatNumber)) {
        $this->context->controller->errors[] = $this->l('An error occurred while saving the VAT number.');
    } else {
		if ($this->context->controller !== null) {
            $this->context->controller->confirmations[] = $this->l('VAT number saved successfully.');
        }
    }

    // Redirect back to the account page
    Tools::redirect($this->context->link->getPageLink('my-account'));
}

	public function deleteCaracteres()
	{
		return array(' ', '-', '.', '/');
	}
	public function nettoyeVat($vat)
	{
		return str_replace($this->deleteCaracteres(), '', $vat);
	}
	public function mainConfiguration()
	{
		return array(	'VAT_REQUIRED_NEW_CUSTOMER' => $this->l('New customers must provide their VAT number'),
						'VAT_REQUIRED_OLD_CUSTOMER' => $this->l('Customers already registered must provide their VAT number'),
						'VALID_AUTO_IF_VIES_ENABLE' =>
							$this->l('Automatic validation of the account if VIES is not accessible (only for validation automatic)'),
						'CUSTOMER_GROUP_PRO_ONLY' 	=> $this->l('Group "pro" only (not default)'));
	}
	public function nbreCustomersByPage() /* pagination */
	{
		return 50;
	}

	public function valuesConfigurationByDefault()
	{
		$ps_customer_group = Configuration::get('PS_CUSTOMER_GROUP');
		$id_group = isset($ps_customer_group)? (int)$ps_customer_group : 3;
		return array('AT' => array('iso_code' => 'AT', 'vatcode' => 'AT', 'id_group' => $id_group, 'validation_auto' => 1),
					'BE' => array('iso_code' => 'BE', 'vatcode' => 'BE', 'id_group' => $id_group, 'validation_auto' => 1),
					'BG' => array('iso_code' => 'BG', 'vatcode' => 'BG', 'id_group' => $id_group, 'validation_auto' => 1),
					'CY' => array('iso_code' => 'CY', 'vatcode' => 'CY', 'id_group' => $id_group, 'validation_auto' => 1),
					'CZ' => array('iso_code' => 'CZ', 'vatcode' => 'CZ', 'id_group' => $id_group, 'validation_auto' => 1),
					'DE' => array('iso_code' => 'DE', 'vatcode' => 'DE', 'id_group' => $id_group, 'validation_auto' => 1),
					'DK' => array('iso_code' => 'DK', 'vatcode' => 'DK', 'id_group' => $id_group, 'validation_auto' => 1),
					'EE' => array('iso_code' => 'EE', 'vatcode' => 'EE', 'id_group' => $id_group, 'validation_auto' => 1),
					'EL' => array('iso_code' => 'GR', 'vatcode' => 'EL', 'id_group' => $id_group, 'validation_auto' => 1),
					'ES' => array('iso_code' => 'ES', 'vatcode' => 'ES', 'id_group' => $id_group, 'validation_auto' => 1),
					'FI' => array('iso_code' => 'FI', 'vatcode' => 'FI', 'id_group' => $id_group, 'validation_auto' => 1),
					'FR' => array('iso_code' => 'FR', 'vatcode' => 'FR', 'id_group' => $id_group, 'validation_auto' => 1),
					'GB' => array('iso_code' => 'GB', 'vatcode' => 'GB', 'id_group' => $id_group, 'validation_auto' => 1),
					'GR' => array('iso_code' => 'GR', 'vatcode' => 'EL', 'id_group' => $id_group, 'validation_auto' => 1),
					'HR' => array('iso_code' => 'HR', 'vatcode' => 'HR', 'id_group' => $id_group, 'validation_auto' => 1),
					'HU' => array('iso_code' => 'HU', 'vatcode' => 'HU', 'id_group' => $id_group, 'validation_auto' => 1),
					'IE' => array('iso_code' => 'IE', 'vatcode' => 'IE', 'id_group' => $id_group, 'validation_auto' => 1),
					'IT' => array('iso_code' => 'IT', 'vatcode' => 'IT', 'id_group' => $id_group, 'validation_auto' => 1),
					'LT' => array('iso_code' => 'LT', 'vatcode' => 'LT', 'id_group' => $id_group, 'validation_auto' => 1),
					'LU' => array('iso_code' => 'LU', 'vatcode' => 'LU', 'id_group' => $id_group, 'validation_auto' => 1),
					'LV' => array('iso_code' => 'LV', 'vatcode' => 'LV', 'id_group' => $id_group, 'validation_auto' => 1),
					'MT' => array('iso_code' => 'MT', 'vatcode' => 'MT', 'id_group' => $id_group, 'validation_auto' => 1),
					'NL' => array('iso_code' => 'NL', 'vatcode' => 'NL', 'id_group' => $id_group, 'validation_auto' => 1),
					'PL' => array('iso_code' => 'PL', 'vatcode' => 'PL', 'id_group' => $id_group, 'validation_auto' => 1),
					'PT' => array('iso_code' => 'PT', 'vatcode' => 'PT', 'id_group' => $id_group, 'validation_auto' => 1),
					'RO' => array('iso_code' => 'RO', 'vatcode' => 'RO', 'id_group' => $id_group, 'validation_auto' => 1),
					'SE' => array('iso_code' => 'SE', 'vatcode' => 'SE', 'id_group' => $id_group, 'validation_auto' => 1),
					'SI' => array('iso_code' => 'SI', 'vatcode' => 'SI', 'id_group' => $id_group, 'validation_auto' => 1),
					'SK' => array('iso_code' => 'SK', 'vatcode' => 'SK', 'id_group' => $id_group, 'validation_auto' => 1));
	}

	private function saveConfiguration($configuration)
	{
		$config = serialize($configuration);
		Configuration::updateValue('checkvatconfig', $config);
	}
	private function getConfiguration($field = false)
	{
		$config = Configuration::get('checkvatconfig');
		$unsconfig = unserialize($config);
		if (!$field)
			return $unsconfig;
		$tableau = array();
		foreach ($unsconfig as $key => $value)
			$tableau[$key] = $value[$field];
		return $tableau;
	}
	public function listCodeIso()
	{
		return '\''.(implode('\', \'', array_keys($this->valuesConfigurationByDefault()))).'\'';
	}
	public function hookdashboardZoneTwo()
	{
		$tab = Tools::getValue('tab');
		$token = Tools::getValue('token');
		return $this->tableauCustomers($tab, $token);
	}

	public function nbreCustomersWaiting()
	{
		$combinations = array();
		foreach ($this->getConfiguration() as $config)
			$combinations[] = $config['vatcode'].$config['id_group'];
		$sql = '
		SELECT COUNT(cust.`id_customer`) AS `nbreCustomersWaiting` 
		FROM `'._DB_PREFIX_.'customer` cust
		INNER JOIN `'._DB_PREFIX_.'address` addr ON(cust.`id_customer` = addr.`id_customer`)
		WHERE addr.`active` = 1
		AND addr.`deleted` = 0
		AND addr.`vat_number` != \'\'
		AND CONCAT(SUBSTRING(addr.`vat_number`, 1, 2), cust.`id_default_group`) NOT IN (\''.implode('\', \'', $combinations).'\')';
		return Db::getInstance()->getValue($sql);
	}

	public function hookdisplayBackOfficeHome()
	{
		$tab = Tools::getValue('tab');
		$token = Tools::getValue('token');
		return $this->tableauCustomers($tab, $token);
	}

	/**
	* Module installer
	* Create tables
	*/
	public function install()
	{
		if (!parent::install()
		|| !$this->registerHook('customerAccount')
		|| !$this->registerHook('createAccountForm')
		|| !$this->registerHook('Top')
		|| !$this->registerHook('actionSubmitAccountBefore')
		|| !$this->registerHook('displayBackOfficeHome')
		|| !$this->registerHook('dashboardZoneTwo')
		|| !$this->registerHook('actionCustomerAccountAdd')
		|| !$this->registerHook('DisplayTop')
		)
			return false;

		$this->saveConfiguration($this->valuesConfigurationByDefault());

		foreach (array_keys($this->mainConfiguration()) as $config)
			if (!Configuration::updateValue($config, 1))
				return false;

		$translations_1 = array();
		$translations_1['en'] = 'Your VAT number is invalid';
		$translations_1['fr'] = 'Votre numéro de TVA est invalide';
		$translations_1['de'] = 'Ihre Umsatzsteuer-Identifikationsnummer ist ungültig';
		$translations_1['es'] = 'Su número de identificación fiscal no es válido';
		$translations_1['it'] = 'Il tuo numero di partita IVA non è valido';
		$this->addTranslations($translations_1);

		$translations_2 = array();
		$translations_2['en'] = 'You must indicate your VAT number';
		$translations_2['fr'] = 'Vous devez indiquer votre numéro de TVA';
		$translations_2['de'] = 'Sie müssen angeben, Ihre Umsatzsteuer-Identifikationsnummer';
		$translations_2['es'] = 'Usted debe indicar su número de IVA';
		$translations_2['it'] = 'È necessario indicare il numero di partita IVA';
		$this->addTranslations($translations_2);
		return true;
	}

	private function addTranslations(array $translations)
	{
		$original_code = '?>';

		foreach ($translations as $iso_code => $translation)
		{
			$file = '../translations/'.$iso_code.'/errors.php';
			$modif = '$_ERRORS[\''.md5($translations['en']).'\'] = \''.pSQL($translation).'\';
?>';
			if (file_exists($file) && !$this->fileModified($file, md5($translations['en'])))
			{
				$lines = array();

				if ($lines = file($file) && $fp = fopen($file, 'w'))
				{
					foreach ($lines as $line)
						fwrite($fp, str_replace($original_code, $modif, $line));

					fclose($fp);
				}
			}
		}
		return true;
	}
	private function fileModified($file = false, $search)
	{
		if (!$file || !$search || !file_exists($file))
			return false;

		if (!$fp = fopen($file, 'r'))
			return false;
		else
		{
			while (!feof($fp))
			{
				$line = fgets($fp, 255);
				if (strpos($line, $search))
				{
					fclose($fp);
					return true;
				}
			}
			fclose($fp);
		}
		return false;
	}
	/**
	* Module uninstaller
	* Drops tables
	*/
	public function uninstall()
	{
		if (!parent::uninstall())
			return false;
		foreach (array_keys($this->mainConfiguration()) as $config)
			Configuration::deleteByName($config);
		Configuration::deleteByName('checkvatconfig');
		return true;
	}

	public function hookactionSubmitAccountBefore()
	{
		/*
		number_vat_valid = 1 : vat is valide for VIES
		number_vat_valid = 2 : vat is invalide for VIES
		number_vat_valid = 3 : problem with VIES, we don't know if the vat is valide or not
		*/

		$this->context->number_vat_valid = 2;
		$vat_required_new_customer = Configuration::get('VAT_REQUIRED_NEW_CUSTOMER');
		$siret = Tools::getValue('siret');
		$vat_number = $this->nettoyeVat($siret);


		if (Tools::isSubmit('submitCreate') && ($vat_required_new_customer == 1) && !$vat_number)
			$this->context->controller->errors[] = $this->l('You must indicate your VAT number');

		if (Tools::isSubmit('submitCreate') && $vat_number && $siret)
		{
			$this->context->number_vat_valid = $this->checkvatCreateAccount($vat_number);


			if ($this->context->number_vat_valid == 2)
				$this->context->controller->errors[] = $this->trans('Your VAT number is invalid', [], 'Shop.Theme.Registration');
		
		}
		if(Tools::isSubmit('submitCreate') && $vat_number && $this->context->number_vat_valid == 1){
			$this->context->controller->success[] = $this->trans('Account created successfully!', [], 'Shop.Theme.Registration');
			return 1;
		}

		if(Tools::isSubmit('submitCreate') && !$vat_number && !$siret){
			$this->context->controller->success[] = $this->trans('Account created successfully!', [], 'Shop.Theme.Registration');
			return 1;
		}


	}

	public function hookactionCustomerAccountAdd()
	{
	    PrestaShopLogger::addLog('hookactionCustomerAccountAdd called', 1);
		$this->saveVat((int)$this->context->number_vat_valid, (int)$this->context->customer->id);
		Tools::redirect('index.php?controller=my-account');

	}

	/**
	* HOOK hookTop
	*/
	public function hookDisplayTop()
	{
		$vat_required_old_customer = Configuration::get('VAT_REQUIRED_OLD_CUSTOMER');
		if (!$this->context->customer->id)
			return;
		$vat_customer = array();
		$vat_customer = $this->getvatCustomer();
		

		if ($vat_required_old_customer == 1 && !$vat_customer && $this->context->controller->php_self != 'my-account')
		    PrestaShopLogger::addLog('hookDisplayHeader: Redirecting to my-account', 1);
			Tools::redirect('index.php?controller=my-account');
	}

	/**
	* HOOK hookcreateAccountForm
	*/
	public function hookcreateAccountForm()
	{
		$this->context->smarty->assign('msg_vat_valid', false);
		$this->context->smarty->assign('bloc_checkvat', true);
		$this->context->smarty->assign('msg_vat_invalid', false);

		$list_countries_sql = '
			SELECT DISTINCT c.`iso_code`, c_l.`name`
			FROM `'._DB_PREFIX_.'country` c
			INNER JOIN `'._DB_PREFIX_.'country_lang` c_l ON(c_l.`id_country` = c.`id_country`)
			WHERE c_l.`id_lang` = '.(int)$this->context->language->id.'
			AND c.`iso_code` IN('.$this->listCodeIso().')';


		$list_countries = Db::getInstance()->ExecuteS($list_countries_sql);
		$this->context->smarty->assign('list_countries', $list_countries);
		$this->context->smarty->assign('validation_auto', false);

		

		$vat_required_new_customer = Configuration::get('VAT_REQUIRED_NEW_CUSTOMER');
		// pre($vat_required_new_customer);
		$this->context->smarty->assign('vat_required_new_customer', $vat_required_new_customer);

		/* for show the input vat number */
		$this->context->controller->addCSS(($this->_path).'css/checkvat.css');
		$this->context->controller->addJS(($this->_path).'js/checkvat.js');
	}

	/**
	* HOOK hookcustomerAccount
	*/
	
	public function hookcustomerAccount()
	{
	
		if ($this->getvatCustomer()){
			return;
		}


		$this->context->smarty->assign('msg_vat_valid', false);
		$this->context->smarty->assign('bloc_checkvat', true);
		$this->context->smarty->assign('msg_vat_invalid', false);

		$this->context->smarty->assign('validation_auto', false);

		// $action_url = $this->context->link->getModuleLink($this->name, 'checkvat'); 

		// $this->context->smarty->assign('action_url_checkvat', $action_url);

		// $this->context->smarty->assign('action_url_checkvat', $action_url);
		// echo 'paulo';
		// exit;

		if ($vat = Tools::getValue('siret'))
		{

			$vat = $this->nettoyeVat($vat);
			$iso_code = substr($vat, 0, 2);
			$vat = pSQL($vat);

			$iso_code = strtoupper(pSQL($iso_code));
			$structurevatvalide = $this->structureVatValide($iso_code, $vat);
			if (!empty($iso_code) && !empty($vat) && $structurevatvalide)
			{
				$validation_auto = $this->getValidationAuto($iso_code);
				$this->context->smarty->assign('validation_auto', $validation_auto);
				$vatvalidebyvies = $this->vatValideByVies($iso_code, substr($vat, 2));
				switch ($vatvalidebyvies)
				{
					case 1 : // vat valide
						$this->saveVatNumber($this->context->customer->id, $vat);
						$this->context->smarty->assign('msg_vat_valid', true);
						$this->context->smarty->assign('bloc_checkvat', false);
						$this->context->smarty->assign('msg_vat_invalid', false);
						if ($validation_auto)
							$this->validerClient($this->context->customer->id);
						break;

					case 2 : // vat invalide
						$this->context->smarty->assign('msg_vat_valid', false);
						$this->context->smarty->assign('bloc_checkvat', true);
						$this->context->smarty->assign('msg_vat_invalid', true);
						break;
					case 3 : // we don't know if vat is valide
						$valid_auto_if_vies_enable = Configuration::get('VALID_AUTO_IF_VIES_ENABLE');
						if ($validation_auto && $valid_auto_if_vies_enable == 1)
						{
							$this->saveVatNumber($this->context->customer->id, $vat);
							$this->context->smarty->assign('msg_vat_valid', true);
							$this->context->smarty->assign('bloc_checkvat', false);
							$this->context->smarty->assign('msg_vat_invalid', false);
							$this->validerClient($this->context->customer->id);
						}
						else
						{
							$this->saveVatNumber($this->context->customer->id, $vat);
							$this->context->smarty->assign('msg_vat_valid', true);
							$this->context->smarty->assign('bloc_checkvat', false);
							$this->context->smarty->assign('msg_vat_invalid', false);
							$this->context->smarty->assign('validation_auto', false);
						}
						break;
				}
			}
			else
			{
				$this->context->smarty->assign('msg_vat_valid', false);
				$this->context->smarty->assign('bloc_checkvat', true);
				$this->context->smarty->assign('msg_vat_invalid', true);
			}
		}
		$chemin = 'views/templates/front/';
		return $this->display(__FILE__, $chemin.'checkvat_my_account.tpl');
	}

	public function saveVatNumber($id_customer, $vat_number)
	{
		// Ensure the VAT number is safely escaped
		$vat_number = pSQL($vat_number);

		// Update the address table for the given customer ID
		$result = Db::getInstance()->update(
			'address', // Table name
			['vat_number' => $vat_number], // Data to update
			'`id_customer` = ' . (int)$id_customer // WHERE clause
		);

		return (bool)$result;
	}


	public function getvatCustomer($id_customer = false)
	{
		$id_customer = ($id_customer)? $id_customer : (int)$this->context->customer->id;
		if (!(Db::getInstance()->getValue('
			SELECT `vat_number` FROM `'._DB_PREFIX_.'address` 
			WHERE `id_customer` = '.$id_customer.' 
			AND `active` = 1 
			AND `deleted` = 0')))
			return false;
		return true;
	}

	public function getIdGroupForAnIsoCode($iso_code)
	{
		$getconfig = $this->getConfiguration();
		return $getconfig[$iso_code]['id_group'];
	}

	/**
	* Update table checkvat
	*/
	public function updateConfigurationCheckvat()
	{
		$configuration = array();
		foreach ($this->valuesConfigurationByDefault() as $iso_code => $values)
		{
			$configuration[$iso_code]['vatcode']			= $values['vatcode'];
			$configuration[$iso_code]['iso_code'] 			= $values['iso_code'];
			$configuration[$iso_code]['id_group'] 			= (int)Tools::getValue('groupe_'.$iso_code, 0);
			$configuration[$iso_code]['validation_auto'] 	= (int)Tools::getValue('validation_auto_'.$iso_code, 0);
		}
		$this->saveConfiguration($configuration);

		foreach (array_keys($this->mainConfiguration()) as $key)
		{
			$value = Tools::getValue($key, 0);
			Configuration::updateValue($key, $value);
		}
		return true;
	}

	private function displayHelp()
	{
		$img = '<img src="../modules/'.$this->name.'/img/rating.png" style="margin-right:3px" 
		title="'.$this->l('Evaluation').'" alt="'.$this->l('Evaluation').'"/>';
		$output = '<a href="http://addons.prestashop.com/'.$this->context->language->iso_code.'/ratings.php" 
		target="_blank" style="float:right;margin-right:100px;">'.$img.$img.$img.$img.$img.'</a>';
		$output .= '<b>'.$this->l('This module allows you to display the combinations on your shop.').'</b><br /><br />';
		$output .= '<br/><br />MASSON Vincent<br /><a href="http://www.coeos.pro/boutique/">coeos.pro</a><br/>contact@coeos.pro<br/><br/><br/>';
		return $output;
	}

	public function getContent()
	{
		$this->_html = '<h2>'.$this->displayName.'</h2>';

		if (Tools::getValue('updateconfigurationcheckvat'))
		{
			if ($this->updateConfigurationCheckvat())
				$this->_html .= $this->l('The parameters were updated successfully');
			else
				$this->_html .= $this->l('An error occurred while updating');
		}

		if (Configuration::get('PS_B2B_ENABLE') != 1)
			$this->_html .= $this->l('Active the mode B2B for use this module');

		if (Configuration::get('PS_REGISTRATION_PROCESS_TYPE') != 1 && Configuration::get('VAT_REQUIRED_NEW_CUSTOMER') == 1)
			$this->_html .= $this->l('Select "Standard (account creation and address creation)" for the registration process type');

		if (Tools::getValue('resetconfig'))
			$this->saveConfiguration($this->valuesConfigurationByDefault());

		$this->_html .= $this->displayHelp();
		$this->displayForm();
		$tab = Tools::getValue('tab');
		$token = Tools::getValue('token');
		$this->_html .= $this->tableauCustomers($tab, $token);
		return $this->_html;
	}

	public function customersWaiting($page = 0)
	{
		$nb = $this->nbreCustomersByPage();
		$combinations = array();
		foreach ($this->getConfiguration() as $config)
			$combinations[] = $config['vatcode'].$config['id_group'];
		return Db::getInstance()->executeS('
				SELECT c.`id_customer`, c.`id_shop`, c.`firstname`, c.`lastname`, c.`email`, addr.`id_address`, 
					addr.`vat_number`, s.`name`, cl.`name` as `pays`, cy.`iso_code`, c.`id_default_group`
				FROM `'._DB_PREFIX_.'customer` c
				INNER JOIN `'._DB_PREFIX_.'address` addr ON(c.`id_customer` = addr.`id_customer`)
				JOIN `'._DB_PREFIX_.'country_lang` cl ON(cl.`id_country` = addr.`id_country`)
				JOIN `'._DB_PREFIX_.'country` cy ON(cy.`id_country` = addr.`id_country`)
				JOIN `'._DB_PREFIX_.'shop` s ON(s.`id_shop` = c.`id_shop`)
				WHERE addr.`active` = 1
				AND addr.`vat_number` != \'\'
				AND addr.`deleted` = 0
				AND cl.`id_lang` = '.(int)$this->context->language->id.' 
				ORDER BY c.`id_customer` DESC
				LIMIT '.($nb * $page).', '.$nb);
	}

	private function displayForm()
	{
		$url = 'index.php?tab=AdminModules&configure='.$this->name.'&token='.Tools::getValue('token');

		$sql = 'SELECT c.`id_country`, c_l.`name` as country, c.`iso_code`
				FROM `'._DB_PREFIX_.'country` c
				INNER JOIN `'._DB_PREFIX_.'country_lang` c_l ON (c_l.`id_country` = c.`id_country`)
				WHERE c.`iso_code` IN('.$this->listCodeIso().')
				AND c_l.`id_lang` = '.(int)$this->context->language->id.'
				ORDER BY c.`iso_code` ASC';

		$list = array();
		$list = Db::getInstance()->ExecuteS($sql);
		$configuration = $this->getConfiguration();
		foreach (array_keys($list) as $key)
		{
			$list[$key]['id_group'] 		= $configuration[$list[$key]['iso_code']]['id_group'];
			$list[$key]['validation_auto'] 	= $configuration[$list[$key]['iso_code']]['validation_auto'];
		}

		$sql = 'SELECT * FROM `'._DB_PREFIX_.'group` g
				INNER JOIN `'._DB_PREFIX_.'group_lang` g_l ON (g.`id_group` = g_l.`id_group`)
				WHERE g_l.`id_lang`='.(int)$this->context->employee->id_lang;
		$liste_groupes = Db::getInstance()->ExecuteS($sql);

		$this->_html .= '
	 	<fieldset>
			<legend><img src="'.$this->_path.'logo.gif" alt="" title="" /> '.$this->l('Manage your VAT Control Module').'</legend>
			<form method="post" action="'.$url.'">';

		foreach ($this->mainConfiguration() as $key => $commentaire)
			$this->_html .= '<p style="margin:20px;"><input type="checkbox" name="'.$key.'" value="1" 
				'.(((int)Configuration::get($key) == 1)? ' checked' : '').'/> '.$commentaire.'</p>';

		$this->_html .= '
				<style type="text/css">
				#tableConfig{width:100%; border:1px solid #ccced7}
				#tableConfig td{border:1px solid #ccced7;padding:5px;text-align:center}
				</style>
				<table id="tableConfig" style="">
				<tr style="text-align:center;font-weight:bold">
					<td>'.$this->l('Country (ISO Code)').'</td>
					<td>'.$this->l('ISO code').'</td>
					<td>'.$this->l('Customer group').'</td>
					<td>'.$this->l('Validation').'</td>
				</tr>';

		foreach ($list as $ligne)
		{
			$this->_html .= '<tr>
								<td>'.$ligne['country'].'</td>
								<td>'.$ligne['iso_code'].'</td>
								<td><select name="groupe_'.$ligne['iso_code'].'">';
			foreach ($liste_groupes as $groupe)
				$this->_html .= '<option value="'.$groupe['id_group'].'"'.(($ligne['id_group'] == $groupe['id_group'])?
								' selected="selected"' : '').'>'.$groupe['name'].'</option>';

			$this->_html .= '	</select></td>
								<td>
									<select name="validation_auto_'.$ligne['iso_code'].'">
										<option value="1"'.(($ligne['validation_auto'] == 1)? ' selected="selected"' : '').'>
										'.$this->l('Automatic').'</option>
										<option value="0"'.(($ligne['validation_auto'] == 0)? ' selected="selected"' : '').'>
										'.$this->l('Manual').'</option>
									</select>
								</td></tr>';
		}

		$this->_html .= '
			</table>
			<div class="margin-form">
			<input type="submit" class="button" name="updateconfigurationcheckvat" value="'.$this->l('Save').'" 
			id="updateconfigurationcheckvat" style="width:100px;margin-top:20px;font-weight:bold"/>
			</div>
			</form></fieldset><br/>';
	}

	public function tableauCustomers($tab, $token)
	{
		$output = '<div class="clear"></div>';
		if ($id_customer = (int)Tools::getValue('retirerclient'))
		{
			if ($this->retirerClient($id_customer))
				$output .= $this->l('The client was removed from the group successfullyp');
			else
				$output .= $this->l('An error occurred when removing the client group');
		}

		if ($id_customer = (int)Tools::getValue('validerClient'))
		{
			if ($this->validerClient($id_customer))
				$output .= $this->l('The client group was changed successfully');
			else
				$output .= $this->l('An error occured when changing group');
		}

		$list_id_group_for_an_iso_code = $this->getConfiguration();
		$nbre_liste_customer_pro = Db::getInstance()->getValue('SELECT COUNT(*) AS nbre_liste_customer_pro FROM `'._DB_PREFIX_.'address` 
		WHERE `vat_number` != \'\'');
		$url = 'index.php?tab='.$tab.'&configure='.$this->name.'&token='.$token;

		$page = (int)Tools::getValue('page', 0);
		$liste_customer_pro = $this->customersWaiting($page);
		$token_customer = Tools::getAdminToken('AdminCustomers'.(int)Tab::getIdFromClassName('AdminCustomers').(int)$this->context->employee->id);
		$token_addresses = Tools::getAdminToken('AdminAddresses'.(int)Tab::getIdFromClassName('AdminAddresses').(int)$this->context->employee->id);

		if ($liste_customer_pro)
		{
			$output .= '<fieldset>
			<legend><img src="'.$this->_path.'logo.gif" alt="" title="" /> '.((!empty($liste_customer_pro))?
			$this->l('customers waiting for validation') : $this->l('all customers')).'</legend>
			<style type="text/css">
			table#table_customer {width:100%}
			table#table_customer tr{border:1px solid #DFD5C3;}
			table#table_customer td{
				text-align:center;
				padding:5px;
			}
			table#table_customer tr:first-child{background-color:#DFFAD3;border:1px solid #DFD5C3
			}
			</style>
			<table id="table_customer" style=" border-collapse:collapse;margin-top:20px;">
			<tr>
				<td>id_customer</td>
				<td>'.$this->l('shop').' (id)</td>
				<td>'.$this->l('first name').'</td>
				<td>'.$this->l('name').'</td>
				<td>'.$this->l('e-mail').'</td>
				<td>'.$this->l('country').' ('.$this->l('ISO Code').')</td>
				<td>'.$this->l('VAT number').'</td>
				<td>'.$this->l('actions').'</td>
			</tr>';

			foreach ($liste_customer_pro as $value_customer)
				$output .= '
				<tr '.(($value_customer['id_default_group'] != $list_id_group_for_an_iso_code[$value_customer['iso_code']]['id_group'])?
				'style="background-color:#FAE2E3"' : 'style="background-color:#DFFAD3"' ).'>
					<td>'.$value_customer['id_customer'].'</td>
					<td>'.$value_customer['name'].' ('.$value_customer['id_shop'].')</td>
					<td>'.$value_customer['firstname'].'</td>
					<td>'.$value_customer['lastname'].'</td>
					<td>'.$value_customer['email'].'</td>
					<td>'.(($value_customer['pays'].' ('.$value_customer['iso_code'].')') ).'</td>
					<td>'.$value_customer['vat_number'].' 
						<a target="_blank" 
						href="index.php?tab=AdminAddresses&id_address='.$value_customer['id_address'].'&updateaddress&token=
						'.$token_addresses.'"><img src="../img/admin/edit.gif" 
						alt="'.$this->l('Customer').'" title="'.$this->l('Customer').'"/></a>
						</td>
					<td>
						<a href ="index.php?tab=AdminCustomers&id_customer='.$value_customer['id_customer'].'&updatecustomer&token=
						'.$token_customer.'"><img src="../img/admin/tab-customers.gif" alt="'.$this->l('Customer').'" 
						title="'.$this->l('Customer').'"/></a>
						<a style="text-decoration: none;" target="_blank" href="https://ec.europa.eu/taxation_customs/vies/rest-api/ms/'.(($value_customer['iso_code'] == 'GR')? 'EL' : $value_customer['iso_code']).'/vat/'.substr($value_customer['vat_number'], 2).'">
						<img src="../modules/'.$this->name.'/logo.gif" alt="'.$this->l('Validation "VIES" of the VAT number').'" 
						title="'.$this->l('Validation "VIES" of the VAT number').'" />
						</a>	
						 '.(($value_customer['id_default_group'] != $list_id_group_for_an_iso_code[$value_customer['iso_code']]['id_group'])? ' 
						<a href="'.$url.'&validerClient='.$value_customer['id_customer'].'">
						<img src="../modules/'.$this->name.'/img/validate.png" alt="'.$this->l('Validate').'" 
						title="'.$this->l('Validate').'"/></a> ' : '').' 
						 <a href="'.$url.'&retirerclient='.$value_customer['id_customer'].'">
						<img src="../modules/'.$this->name.'/img/delete.gif" alt="'.$this->l('Removing the group').'"
						title="'.$this->l('Removing the group').'"/></a>
					</td>
				</tr>';

			$output .= '</table><br/>

			<p><div style="float:left;margin-right:5px;width:40px;height:15px;background-color:#FAE2E3;border: 1px solid #999999;"></div>
			'.$this->l('customer account to validate').'</p>
			<p><div style="float:left;margin-right:5px;width:40px;height:15px;background-color:#DFFAD3;border: 1px solid #999999;"></div>
			'.$this->l('customer account already validated').'</p>';
			$nbre_page = ceil($nbre_liste_customer_pro / $this->nbreCustomersByPage());

			if ($nbre_page > 1)
			{
				$output .= '<select name="page" style="width: 100px;" onchange="document.location.href = \''.$url.'&page=\' + this.value">';
				for ($i = 0; $i < $nbre_page; $i++)
					$output .= '<option '.(($page == $i)? 'selected="selected"' : '').' value="'.$i.'">Page '.($i + 1).'</option>';
				$output .= '</select>';
			}
		}
		$output .= '</fieldset>';
		return $output;
	}

	public function checkvatCreateAccount($vat)
	{
		$iso_code = substr($vat, 0, 2);
// 		echo $iso_code;
// 		exit;

		if ($this->structureVatValide($iso_code, $vat))
			return $this->vatValideByVies($iso_code, substr($vat, 2));
		return 2;
	}

	public function structureVatValide($iso_code, $numero_vat)
	{
		$vat = substr($numero_vat, 2);
		$vat_valide = false;
		switch ($iso_code)
		{
			case 'AT':
				if (substr($vat, 0, 1) == 'U' && Tools::strlen($vat) == 9 && is_numeric( substr($vat, 1)))
					$vat_valide = true;
				break;
			case 'BE':
				if (substr($vat, 1, 0) == 0 && Tools::strlen($vat) == 10 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'BG':
				if ((Tools::strlen($vat) == 9 || Tools::strlen($vat) == 10) && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'CY':
				if (Tools::strlen($vat) == 9 && is_numeric( substr($vat, 0, 8)) && !is_numeric( substr($vat, -1)))
					$vat_valide = true;
				break;
			case 'CZ':
				if ((Tools::strlen($vat) == 8 || Tools::strlen($vat) == 9 || Tools::strlen($vat) == 10) && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'DE':
				if (Tools::strlen($vat) == 9 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'DK':
				if (Tools::strlen($vat) == 8 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'EE':
				if (Tools::strlen($vat) == 9 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'GR':
				if (Tools::strlen($vat) == 9 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'EL':
				if (Tools::strlen($vat) == 9 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'ES':
				if (Tools::strlen($vat) == 9
				&& ((is_numeric( substr($vat, 0, 1)) && !is_numeric( substr($vat, -1))) || (!is_numeric( substr($vat, 0, 1))
				&& is_numeric( substr($vat, -1)))) && is_numeric( substr($vat, 1, 7)))
					$vat_valide = true;
				break;
			case 'FI':
				if (Tools::strlen($vat) == 8 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'FR':
				if (Tools::strlen($vat) == 11 && is_numeric( substr($vat, -9)))
					$vat_valide = true;
				break;
			case 'GB':
				if (((Tools::strlen($vat) == 9 || Tools::strlen($vat) == 12) && is_numeric($vat))
				|| ( substr($vat, 0, 2) == 'GD' && is_numeric( substr($vat, 2)) && Tools::strlen($vat) == 5)
				|| ( substr($vat, 0, 2) == 'HA' && is_numeric( substr($vat, 2)) && Tools::strlen($vat) == 5))
					$vat_valide = true;
				break;
			case 'HU':
				if (Tools::strlen($vat) == 8 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'HR':
				if (Tools::strlen($vat) == 11 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'IE':
				if (Tools::strlen($vat) == 8 && is_numeric( substr($vat, 0, 1))
				&& is_numeric( substr($vat, 2, 5)) && !is_numeric( substr($vat, -1)))
					$vat_valide = true;
				break;
			case 'IT':
				if (Tools::strlen($vat) == 11 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'LT':
				if ((Tools::strlen($vat) == 9 || Tools::strlen($vat) == 12) && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'LU':
				if (Tools::strlen($vat) == 8 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'LV':
				if (Tools::strlen($vat) == 11 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'MT':
				if (Tools::strlen($vat) == 8 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'NL':
				if (Tools::strlen($vat) == 12 && is_numeric( substr($vat, 0, 9))
				&& !is_numeric( substr($vat, 9, 1)) && substr($vat, 9, 1) == 'B'
				&& is_numeric( substr($vat, -2)))
					$vat_valide = true;
				break;
			case 'PL':
				if (Tools::strlen($vat) == 10 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'PT':
				if (Tools::strlen($vat) == 9 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'RO':
				if ((Tools::strlen($vat) >= 2 && Tools::strlen($vat) <= 10) && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'SE':
				if (Tools::strlen($vat) == 12 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'SI':
				if (Tools::strlen($vat) == 8 && is_numeric($vat))
					$vat_valide = true;
				break;
			case 'SK':
				if (Tools::strlen($vat) == 10 && is_numeric($vat))
					$vat_valide = true;
				break;
		}
		return $vat_valide;
	}

	/*
	vatValideByVies return 1 : vat is valide for VIES
	vatValideByVies return 2 : vat is invalide for VIES
	vatValideByVies return 3 : problem with VIES, we don't know if the vat is valide or not
	*/
	
	
	public function checkCurlUrl($url){
	    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);  
        
        $data = json_decode($output);
        
        return $data->isValid;
	}
	
	public function vatValideByVies($iso_code = false, $vat = false)
	{
	    $iso_code = (($iso_code == 'GR') ? 'EL' : $iso_code);
	    
		$url = 'https://ec.europa.eu/taxation_customs/vies/rest-api/ms/'. $iso_code .'/vat/'.$vat;
		
// 		echo $url;
// 		exit;

	    $isValid = self::checkCurlUrl($url);

		ini_set('default_socket_timeout', 3);
		
		for ($i = 0; $i < 3; $i++){
			if ($isValid){
				ini_restore('default_socket_timeout');
				return 1;
			}else{
				ini_restore('default_socket_timeout');
			    return 2;
			}
		}

		ini_restore('default_socket_timeout');
		return 3;
	}
	
	/**
	public function vatValideByVies($iso_code = false, $vat = false)
	{
		$url = 'https://ec.europa.eu/taxation_customs/vies/rest-api/ms/'.(($iso_code == 'GR') ? 'EL' : $iso_code).'/vat/'.$vat;

		//$url = 'http://ec.europa.eu/taxation_customs/vies/vatResponse.html?locale=FR&memberStateCode='.(($iso_code == 'GR')?'EL' : $iso_code).'&number='.$vat.'&traderName=';
		ini_set('default_socket_timeout', 3);
		for ($i = 0; $i < 3; $i++)
			if ($line = Tools::file_get_contents($url))
			{
				if (strstr($line, 'TVA valide'))
				{
					ini_restore('default_socket_timeout');
					return 1;
				}
				//if (strstr($line, 'TVA invalide'))
				if (strstr($line, 'TVA non valide'))
				{
					ini_restore('default_socket_timeout');
					return 2;
				}
				if (strstr($line, 'demandes trop nombreuses'))
				{
					ini_restore('default_socket_timeout');
					return 3;
				}
			}
		ini_restore('default_socket_timeout');
		return 3;
	}
    **/
    
	public function tableau($tableau = false, $id = false)
	{
		if (!$tableau || !$id)
			return false;
		$list = array();
		foreach ($tableau as $key => $value)
			$list[$key] = $value[$id];
		return $list;
	}

	public function saveVat($number_vat_valid, $id_customer)
	{
		$vat_number = Tools::getValue('siret');
		$vat_number = $this->nettoyeVat($vat_number);
		$iso_code = substr($vat_number, 0, 2);
		if ($number_vat_valid == 1 && $this->getValidationAuto($iso_code))
			$this->validerClient($id_customer);
	}

	public function validerClient($id_customer = false)
	{
// 		$iso_code = $this->getIsoCodeForCustomer($id_customer);
        $iso_code = substr(Tools::getValue('siret'), 0, 2);
		$id_group = (int)$this->getIdGroupForAnIsoCode($iso_code);

		if (!Db::getInstance()->update('customer', array('id_default_group' => $id_group), '`id_customer` = '.$id_customer, 1))
			return false;

		Db::getInstance()->delete('customer_group', '`id_group`='.$id_group.' AND `id_customer`='.(int)$id_customer);
		if (!Db::getInstance()->insert('customer_group', array('id_group' => $id_group, 'id_customer' => (int)$id_customer)))
			return false;

		$ps_customer_group = (int)Configuration::get('PS_CUSTOMER_GROUP');
		if (Configuration::get('CUSTOMER_GROUP_PRO_ONLY') == 1 && $ps_customer_group != $id_group)
			if (!Db::getInstance()->delete('customer_group', '`id_group`='.$ps_customer_group.' AND `id_customer`='.(int)$id_customer))
				return false;

        $id_country = Db::getInstance()->getValue('SELECT id_country FROM '._DB_PREFIX_.'country WHERE iso_code="'.pSQL($iso_code).'" LIMIT 1');
	
		if(!Tools::getValue('submitCreate')){
			$last_id_address = Db::getInstance()->getValue('SELECT `id_address` FROM `'._DB_PREFIX_.'address` WHERE `id_customer` = '.(int)$id_customer . ' AND active=1 AND deleted = 0 ORDER BY id_address DESC');
			
			$id_country = Db::getInstance()->getValue('SELECT id_country FROM '._DB_PREFIX_.'address WHERE id_address=' . $last_id_address);
	
			Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'address SET active=0, deleted = 1 WHERE `id_customer` = '.(int)$id_customer . ' AND id_address <> ' . $last_id_address);
			Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'address SET vat_number = "' . Tools::getValue('siret') . '" WHERE `id_customer` = '.(int)$id_customer . ' AND id_address =' . $last_id_address);
		}
        

		if(isset($id_country) && ($id_country == 9 || $id_country == 15)){
			Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'customer_group SET id_group=3 WHERE `id_customer` = '.(int)$id_customer);
			Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'customer SET id_default_group=3 WHERE `id_customer` = '.(int)$id_customer);
		}else{
			Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'customer_group SET id_group=5 WHERE `id_customer` = '.(int)$id_customer);
			Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'customer SET id_default_group=5 WHERE `id_customer` = '.(int)$id_customer);
		}
            
        
		return true;
	}

	public function retirerClient($id_customer)
	{
		$iso_code = $this->getIsoCodeForCustomer($id_customer);
		$id_group = (int)$this->getIdGroupForAnIsoCode($iso_code);

		$id_default_group = (int)Configuration::get('PS_CUSTOMER_GROUP');
		if (!Db::getInstance()->update('customer', array('id_default_group' => $id_default_group),
		'`id_customer` = '.(int)$id_customer, 1))
			return false;

		if (!Db::getInstance()->delete('customer_group', '`id_customer` = '.(int)$id_customer.' AND `id_group` = '.$id_group, 1))
			return false;

		$id_group_default = (int)Db::getInstance()->getValue('SELECT `id_group` FROM `'._DB_PREFIX_.'customer_group` WHERE
			`id_group` = '.$id_default_group.' AND `id_customer` = '.(int)$id_customer);
		if (!$id_group_default || $id_default_group != $id_group_default)
			if (!Db::getInstance()->insert('customer_group', array('id_group' => $id_default_group, 'id_customer' => (int)$id_customer)))
				return false;
		return true;
	}

	public function getIsoCodeForCustomer($id_customer)
	{
		if (!$iso_code = Db::getInstance()->getValue('SELECT SUBSTRING(`vat_number`, 1, 2)
		FROM `'._DB_PREFIX_.'address` 
		WHERE `id_customer`='.(int)$id_customer.' 
		AND `active` = 1
		AND `deleted` = 0'))
			return false;
		return $iso_code;
	}

	public function getValidationAuto($iso_code)
	{
		$values = $this->getConfiguration();
		return ($values[$iso_code]['validation_auto'] == 1)? true : false;
	}
}