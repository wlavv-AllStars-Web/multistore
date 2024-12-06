<?php
/**
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2013 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

/* Checking compatibility with older PrestaShop and fixing it*/
if (!defined('_MYSQL_ENGINE_'))
	define('_MYSQL_ENGINE_', 'MyISAM');

class DimensionalWeight extends Module
{
	public function __construct()
	{
		$this->name = 'dimensionalweight';
		$this->tab = 'shipping_logistics';
		$this->version = '1.1.4';
		$this->author = 'EMMELOGIS di Massa Roberto';
		$this->module_key = 'ec7168406475a4bfb22f65061d9a44b2';
		$this->ps_versions_compliancy['min'] = '1.6.1';

		parent::__construct ();

		$this->displayName = $this->l('Dimensional Weight');
		$this->description = $this->l('Apply the concept of Dimensional Weight to establish a minimum charge for the cubic space a package occupies.');

		// Check if installed
		if (self::isInstalled($this->name))
		{
			// Warning uninstall
			$this->confirmUninstall = $this->l('Are you sure you want to uninistall this module? All configuration settings will be lost');
		}
	}

	public function install()
	{
		if (!parent::install() || !$this->registerHook('updateCarrier'))
			return false;

		if (!Db::getInstance()->execute('
		CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'dimensionalweight_carrier_rule`(
			`id_carrier_rule` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`id_carrier` INT NOT NULL,
			`factor` INT NOT NULL
		) ENGINE='._MYSQL_ENGINE_.';
		'))
			return false;

		return true;
	}

	public function uninstall()
	{
		Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'dimensionalweight_carrier_rule`');

		return parent::uninstall();
	}

	public function getContent()
	{
		$html = '<h2>'.$this->l('Dimensional Weight configuration').'</h2>';

		$html .= $this->postProcess();
		if (Tools::isSubmit('addCarrierRule') || (Tools::isSubmit('editCarrierRule') && Tools::isSubmit('id_carrier_rule')))
			$html .= $this->setCarrierRuleForm();
		else
			$html .= $this->setConfigurationForm();

		return $html;
	}

	public function hookUpdateCarrier($params)
	{
		Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'dimensionalweight_carrier_rule`
			SET `id_carrier` = "'.(int)$params['carrier']->id.'"
			WHERE `id_carrier` = '.(int)$params['id_carrier']);
	}

	private function postProcess()
	{
		$errors = array();

		if (Tools::isSubmit('submitCarrierRule'))
		{
			if (!Validate::isUnsignedInt(Tools::getValue('factor')))
				$errors[] = $this->l('factor is invalid');
			if (($carrier = new Carrier((int)Tools::getValue('id_carrier'))) && !Validate::isLoadedObject($carrier))
				$errors[] = $this->l('Carrier is invalid');
			if ($this->isAlreadyDefinedForCarrier((int)$carrier->id, (int)Tools::getValue('id_carrier_rule', 0)))
				$errors[] = $this->l('You cannot use this carrier, a rule has already been saved.');

			if (!count($errors))
			{
				if (Tools::isSubmit('addCarrierRule'))
				{
					if (Db::getInstance()->execute('
					INSERT INTO `'._DB_PREFIX_.'dimensionalweight_carrier_rule`(`id_carrier`, `factor`) 
					VALUES ('.(int)$carrier->id.', '.(int)Tools::getValue('factor').')
					'))
						Tools::redirectAdmin(AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&confirmAddCarrierRule');
					else
						$html = $this->displayError($this->l('An error occurred on adding of carrier rule.'));
				}
				else
				{
					if (Db::getInstance()->execute('
					UPDATE `'._DB_PREFIX_.'dimensionalweight_carrier_rule`  
					SET `id_carrier` = '.(int)$carrier->id.', `factor` = '.(int)Tools::getValue('factor').'
					WHERE `id_carrier_rule` = '.(int)Tools::getValue('id_carrier_rule')
					))
						Tools::redirectAdmin(AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&confirmEditCarrierRule');
					else
						$html = $this->displayError($this->l('An error occurred on updating of carrier rule.'));
				}

			}
			else
				$html = $this->displayError(implode('<br />', $errors));
		}

		if (Tools::isSubmit('deleteCarrierRule') && Tools::isSubmit('id_carrier_rule') && (int)Tools::getValue('id_carrier_rule') && $this->isCarrierRuleExists((int)Tools::getValue('id_carrier_rule')))
		{
			$this->deleteByIdCarrierRule((int)Tools::getValue('id_carrier_rule'));
			$html = $this->displayConfirmation($this->l('Carrier rule deleted successfully'));
		}

		if (Tools::isSubmit('confirmAddCarrierRule'))
			$html = $this->displayConfirmation($this->l('Carrier rule added successfully'));

		if (Tools::isSubmit('confirmEditCarrierRule'))
			$html = $this->displayConfirmation($this->l('Carrier rule updated successfully'));

		return $html;
	}

	private function setConfigurationForm()
	{
		$html = '
		<fieldset>
		<legend><img src="'._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/logo.gif" alt="" /> '.$this->l('Description').'</legend>';

		$html .= $this->l('This module allows you to apply the concept of Dimensional Weight.').'</b><br /><br />
		'.$this->l('Dimensional weight, used in shipping and freight, is a billing technique which takes into account the length, width, and height of a package.').'<br />
		'.$this->l('Dimensional weight is a calculation of a theoretical weight of a package. This theoretical weight is the weight of the package at a minimum density chosen by the freight carrier. If the package is below this minimum density, then the actual weight is irrelevant as the freight carrier will charge for the volume of the package as if it were of the chosen density (what the package would weigh at the minimum density).').'<br /><br />
		'.$this->l('Freight carriers utilize the greater of the actual weight or dimensional weight to calculate shipping charges. Dimensional Weight is calculated as (Length x Width x Height) / (Dimensional factor).').'<br /><br />
		'.$this->l('Dimensional factor will be available from your freight carrier. Some common factor are listed below.').'<br /><br />

		<table width="50%" class="table" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th width="50%"><b>'.$this->l('Metric System:').'</th>
					<th width="50%"><b>'.$this->l('Imperial System:').'</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th width="50%">
													3333 cm3/kg = 300 Kg/m3<br />
													4000 cm3/kg = 250 Kg/m3<br />
													5000 cm3/kg = 200 kg/m3<br />
													6000 cm3/kg = 166.667 kg/m3<br /></th>
					<th width="50%" >
													166 in3/lb = 10.4 lb/ft3<br />
													194 in3/lb = 8.9 lb/ft3<br />
													216 in3/lb = 8.0 lb/ft3<br />
													225 in3/lb = 7.7 lb/ft3<br />
													250 in3/lb = 6.9 lb/ft3</th>
				</tr>
			</tbody>
		</table>
		</fieldset>
		<br />';

		$html .= '
		<fieldset>
			<legend><img src="'._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/views/img/carrier.png" alt="" /> '.$this->l('Carrier configuration').'</legend>
			
			<p><a href="'.AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&addCarrierRule"><img src="'._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/views/img/carrier_add.png" alt="" /> '.$this->l('Add a new carrier rule').'</a></p>
			
			<h3>'.$this->l('List of carrier rules').'</h3>';

		$carrier_rules = $this->getCarrierRulesWithCarrierName();
		if (count($carrier_rules))
		{
			$html .= '<table width="50%" class="table" cellspacing="0" cellpadding="0">
			<thead>
			<tr>
				<th width="40%"><b>'.$this->l('Name of carrier').'</b></th>
				<th width="30%" class="center"><b>'.$this->l('Factor').'</b></th>
				<th width="10%" class="center"><b>'.$this->l('Actions').'</b></th>
			</tr>
			</thead>
			<tbody>
			';

			foreach ($carrier_rules as $rule)
			{
				$html .= '
				<tr>
					<td width="30%">'.(!preg_match('/^0$/Ui', $rule['name']) ? htmlentities($rule['name'], ENT_QUOTES, 'UTF-8') : Configuration::get('PS_SHOP_NAME')).'</td>
					<td width="40%" class="center"><b>'.'</b> '.$rule['factor'].'</td>
					<td width="10%" class="center">
						<a href="'.AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editCarrierRule&id_carrier_rule='.(int)$rule['id_carrier_rule'].'" title="'.$this->l('Edit').'"><img src="'._PS_ADMIN_IMG_.'edit.gif" alt="" /></a> 
						<a href="'.AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&deleteCarrierRule&id_carrier_rule='.(int)$rule['id_carrier_rule'].'" title="'.$this->l('Delete').'"><img src="'._PS_ADMIN_IMG_.'delete.gif" alt="" /></a>
					</td>
				</tr>';
			}

			$html .= '
			</tbody>
			</table>';
		}
		else
			$html .= '<p class="center">'.$this->l('No carrier rule').'</p>';

		$html .= '
		</fieldset>';

		return $html;
	}

	private function setCarrierRuleForm()
	{
		$carriers = Carrier::getCarriers($this->context->language->id, true, false, false, null, Carrier::ALL_CARRIERS);
		if (Tools::isSubmit('editCarrierRule') && $this->isCarrierRuleExists(Tools::getValue('id_carrier_rule')))
			$carrier_rule = $this->getCarrierRule(Tools::getValue('id_carrier_rule'));

		$html = '
		<form method="post" action="'.$_SERVER['REQUEST_URI'].'">
		';

		if (isset($carrier_rule) && $carrier_rule['id_carrier_rule'])
			$html .= '<input type="hidden" name="id_carrier_rule" value="'.(int)$carrier_rule['id_carrier_rule'].'" />';
		$html .= '
		<fieldset>
		';

		if (Tools::isSubmit('addCarrierRule'))
			$html .= '<legend><img src="'._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/views/img/carrier_add.png" alt="" /> '.$this->l('New carrier rule').'</legend>';
		elseif (Tools::isSubmit('editCarrierRule'))
			$html .= '<legend><img src="'._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/views/img/carrier_add.png" alt="" /> '.$this->l('Edit carrier rule').'</legend>';

		$html .= '
			<label for="id_carrier">'.$this->l('Carrier:').'</label>
			<div class="margin-form">
				<select name="id_carrier" id="id_carrier">
					<option>'.$this->l('Choose').'</option>';
		foreach ($carriers as $carrier)
			$html .= '<option value="'.$carrier['id_carrier'].'" '.((Tools::isSubmit('id_carrier') && Tools::getValue('id_carrier') == $carrier['id_carrier']) ? 'selected="selected"' : ((isset($carrier_rule) && $carrier_rule['id_carrier'] == $carrier['id_carrier']) ? 'selected="selected"' : '')).'>'.htmlentities($carrier['name'], ENT_QUOTES, 'UTF-8').'</option>';

		$html .= '
				</select>
			</div>
			
			<label>'.$this->l('Factor:').'</label>
			<div class="margin-form">
				<input type="text" name="factor" value="'.htmlentities(Tools::getValue('factor', ((isset($carrier_rule) && $carrier_rule['factor']) ? $carrier_rule['factor'] : 0)), ENT_QUOTES, 'UTF-8').'" size="5" />
			</div>
			
			<p class="center"><input type="submit" class="button" name="submitCarrierRule" value="'.$this->l('Save').'" /></p>
			<p class="center"><a href="'.AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'">'.$this->l('Cancel').'</a></p>
		';

		$html .= '
		</fieldset>
		</form>
		';

		return $html;
	}

	private function getCarrierRulesWithCarrierName()
	{
		return Db::getInstance()->executeS('
		SELECT * 
		FROM `'._DB_PREFIX_.'dimensionalweight_carrier_rule` dcr 
		LEFT JOIN `'._DB_PREFIX_.'carrier` c ON (c.`id_carrier` = dcr.`id_carrier`)
		');
	}

	private function getCarrierRule($id_carrier_rule)
	{
		if (!(int)$id_carrier_rule)
			return false;
		return Db::getInstance()->getRow('
		SELECT * 
		FROM `'._DB_PREFIX_.'dimensionalweight_carrier_rule` 
		WHERE `id_carrier_rule` = '.(int)$id_carrier_rule
		);
	}

	private function isCarrierRuleExists($id_carrier_rule)
	{
		if (!(int)$id_carrier_rule)
			return false;
		return (bool)Db::getInstance()->getValue('
		SELECT COUNT(*) 
		FROM `'._DB_PREFIX_.'dimensionalweight_carrier_rule` 
		WHERE `id_carrier_rule` = '.(int)$id_carrier_rule
		);
	}

	private function deleteByIdCarrierRule($id_carrier_rule)
	{
		if (!(int)$id_carrier_rule)
			return false;
		return Db::getInstance()->execute('
		DELETE FROM `'._DB_PREFIX_.'dimensionalweight_carrier_rule` 
		WHERE `id_carrier_rule` = '.(int)$id_carrier_rule
		);
	}

	private function isAlreadyDefinedForCarrier($id_carrier, $id_carrier_rule = 0)
	{
		if (!(int)$id_carrier)
			return false;
		return (bool)Db::getInstance()->getValue('
		SELECT COUNT(*) 
		FROM `'._DB_PREFIX_.'dimensionalweight_carrier_rule` 
		WHERE `id_carrier` = '.(int)$id_carrier.'
		'.((int)$id_carrier_rule != 0 ? '&& `id_carrier_rule` != '.(int)$id_carrier_rule : ''));
	}

	public function getCarrierRuleWithIdCarrier($id_carrier)
	{
		if (!(int)$id_carrier)
			return false;
		return Db::getInstance()->getRow('
		SELECT * 
		FROM `'._DB_PREFIX_.'dimensionalweight_carrier_rule` 
		WHERE `id_carrier` = '.(int)$id_carrier
		);
	}
}