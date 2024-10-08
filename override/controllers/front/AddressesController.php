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
class AddressesControllerCore extends FrontController
{
    /** @var bool */
    public $auth = true;
    /** @var string */
    public $php_self = 'addresses';
    /** @var string */
    public $authRedirection = 'addresses';
    /** @var bool */
    public $ssl = true;

    /**
     * Initialize addresses controller.
     *
     * @see FrontController::init()
     */
    public function init()
    {
        parent::init();

        if (!Validate::isLoadedObject($this->context->customer)) {
            die(Tools::displayError($this->trans('The customer could not be found.', [], 'Shop.Notifications.Error')));
        }
    }

    /**
     * Assign template vars related to page content.
     *
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        parent::initContent();

        // para All Stars Distributio
        if($this->context->shop->id == 3){
            Tools::redirect('my-account'); 
        }

        // adicionado
        $total = 0;
        $multiple_addresses_formated = array();
        $ordered_fields = array();
        $addresses = $this->context->customer->getAddresses($this->context->language->id);

        foreach ($addresses as $detail) {
            $address = new Address($detail['id_address']);
            $multiple_addresses_formated[$total] = AddressFormat::getFormattedLayoutData($address);
            unset($address);
            ++$total;

            // Retro theme < 1.4.2
            $ordered_fields = AddressFormat::getOrderedAddressFields($detail['id_country'], false, true);
        }

        if ($key = array_search('Country:name', $ordered_fields)) {
            $ordered_fields[$key] = 'country';
        }

        $addresses_style = array(
            'company' => 'address_company',
            'vat_number' => 'address_company',
            'firstname' => 'address_name',
            'lastname' => 'address_name',
            'address1' => 'address_address1',
            'address2' => 'address_address2',
            'city' => 'address_city',
            'country' => 'address_country',
            'phone' => 'address_phone',
            'phone_mobile' => 'address_phone_mobile',
            'alias' => 'address_title',
        );

        $this->context->smarty->assign(array(
            'addresses_style' => $addresses_style,
            'multipleAddresses' => $multiple_addresses_formated,
            'ordered_fields' => $ordered_fields,
            'addresses' => $addresses, // retro compat themes 1.5ibility Theme < 1.4.1
        ));

        $this->setTemplate('customer/addresses');
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        $breadcrumb['links'][] = $this->addMyAccountToBreadcrumb();

        $breadcrumb['links'][] = [
            'title' => $this->trans('Addresses', [], 'Shop.Theme.Global'),
            'url' => $this->context->link->getPageLink('addresses'),
        ];

        return $breadcrumb;
    }
}
