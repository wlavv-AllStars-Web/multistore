<?php
/*
* 2007-2016 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2016 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class Carrier extends CarrierCore
{
    public function add($autodate = true, $null_values = false)
    {
        if ($this->position <= 0) {
            $this->position = Carrier::getHigherPosition() + 1;
        }

        if (!parent::add($autodate, $null_values) || !Validate::isLoadedObject($this)) {
            return false;
        }
        if (!$count = Db::getInstance()->getValue('SELECT count(`id_carrier`) FROM `'._DB_PREFIX_.$this->def['table'].'` WHERE `deleted` = 0')) {
            return false;
        }
        if ($count == 1) {
            Configuration::updateValue('PS_CARRIER_DEFAULT', (int)$this->id);
        }

        // Register reference
        Db::getInstance()->execute('UPDATE `'._DB_PREFIX_.$this->def['table'].'` SET `id_reference` = '.$this->id.' WHERE `id_carrier` = '.$this->id);

        $data = array(
            'id_totshippingpreview_carrier' => $this->id,
            'mindays' => Tools::getValue('mindays')!='' ? (int) Tools::getValue('mindays'): null,
            'maxdays' => Tools::getValue('maxdays')!='' ? (int) Tools::getValue('maxdays'): null,
        );
        DB::getInstance()->insert('totshippingpreview_carrier', $data);

        return true;
    }

}
