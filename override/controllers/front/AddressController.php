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
class AddressControllerCore extends FrontController
{
    /** @var bool */
    public $auth = true;
    /** @var bool */
    public $guestAllowed = true;
    /** @var string */
    public $php_self = 'address';
    /** @var string */
    public $authRedirection = 'addresses';
    /** @var bool */
    public $ssl = true;

    protected $address_form;
    protected $should_redirect = false;

    /**
     * Initialize address controller.
     *
     * @see FrontController::init()
     */
    public function init()
    {
        parent::init();

        // para All Stars Distribution
        if($this->context->shop->id == 3){
            Tools::redirect('my-account'); 
        }

        $this->address_form = $this->makeAddressForm();

        $customerId = $this->context->customer->id;

        $sql = 'SELECT siret FROM ps_customer WHERE id_customer ='.$customerId;
        $hasSiret = DB::getInstance()->getValue($sql);

        if($hasSiret){
            $this->address_form->fillWith(['vat_number' => $hasSiret]);
        }

        $this->context->smarty->assign('address_form', $this->address_form->getProxy());
    }

    /**
     * Start forms process.
     *
     * @see FrontController::postProcess()
     */
    public function postProcess()
    {
        if(Tools::getValue('iso_codeAddress')){
            $iso_code_address = Tools::getValue('iso_codeAddress');

            $sql = 'SELECT id_country, call_prefix FROM ps_country WHERE iso_code = "'. pSQL($iso_code_address) .'"';

            $result  = Db::getInstance()->getRow($sql);
            

            header('Content-Type: application/json');
            echo json_encode([
                'country_id' => $result['id_country'],
                'call_prefix' => $result['call_prefix'],
            ]);
            exit;
        }

        $this->context->smarty->assign('editing', false);
        $id_address = (int) Tools::getValue('id_address');
        // Initialize address if an id exists
        if ($id_address) {
            $this->address_form->loadAddressById($id_address);
        }

        // Fill the form with data
        $this->address_form->fillWith(Tools::getAllValues());

        // Submit the address, don't care if it's an edit or add
        if (Tools::isSubmit('submitAddress')) {

            
            $customerId = $this->context->customer->id;

            $sql = 'SELECT siret FROM ps_customer WHERE id_customer ='.$customerId;
            $hasSiret = DB::getInstance()->getValue($sql);

            $sqlCountry = 'SELECT iso_code FROM ps_country WHERE id_country='.Tools::getValue('id_country');
            $vatCountryIsoCode = DB::getInstance()->getValue($sqlCountry);

            $vatCountry = substr($hasSiret,0,2);

            $sqlCountryVat = 'SELECT id_country FROM ps_country WHERE iso_code="'.$vatCountry.'"';
            $CountryVatId = DB::getInstance()->getValue($sqlCountryVat);


            if($hasSiret && $hasSiret != Tools::getValue('vat_number')){
                $this->errors[] = $this->trans('Cannot change vat number.', [], 'Shop.Notifications.Error');
                $this->address_form->fillWith(['vat_number' => $hasSiret]);
                return;
            }elseif(Tools::getValue('vat_number') && $vatCountryIsoCode != $vatCountry){
                $this->errors[] = $this->trans('Cannot change country.', [], 'Shop.Notifications.Error');
                $this->address_form->fillWith(['id_country' => $CountryVatId]);
            }else{

                if (!$this->address_form->submit()) {
                    $this->errors[] = $this->trans('Please fix the error below.', [], 'Shop.Notifications.Error');
                } else {

                
                    if ($id_address) {
                        $this->success[] = $this->trans('Address successfully updated.', [], 'Shop.Notifications.Success');
                    } else {
                        $this->success[] = $this->trans('Address successfully added.', [], 'Shop.Notifications.Success');
                    }

                $this->should_redirect = true;

                }
            }
        }

        // There is no id_adress, no need to continue
        if (!$id_address) {
            return;
        }

        if (Tools::getValue('delete')) {
            if (
                Validate::isLoadedObject($this->context->cart)
                && ($this->context->cart->id_address_invoice == $id_address
                || $this->context->cart->id_address_delivery == $id_address)
            ) {
                $this->errors[] = $this->trans(
                    'Could not delete the address since it is used in the shopping cart.',
                    [],
                    'Shop.Notifications.Error'
                );

                return;
            }

            $ok = $this->makeAddressPersister()->delete(
                new Address($id_address, $this->context->language->id),
                Tools::getValue('token')
            );
            if ($ok) {
                $this->success[] = $this->trans('Address successfully deleted.', [], 'Shop.Notifications.Success');
                $this->should_redirect = true;
            } else {
                $this->errors[] = $this->trans('Could not delete address.', [], 'Shop.Notifications.Error');
            }
        } else {
            $this->context->smarty->assign('editing', true);
        }
    }

    /**
     * Assign template vars related to page content.
     *
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        if (!$this->ajax && $this->should_redirect) {
            if (($back = Tools::getValue('back')) && Tools::urlBelongsToShop($back)) {
                $mod = Tools::getValue('mod');
                $this->redirectWithNotifications('index.php?controller=' . $back . ($mod ? '&back=' . $mod : ''));
            } else {
                $this->redirectWithNotifications('index.php?controller=addresses');
            }
        }

        parent::initContent();
        $this->setTemplate(
            'customer/address',
            [
                'entity' => 'address',
                'id' => (int) Tools::getValue('id_address'),
            ]
        );
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        $breadcrumb['links'][] = $this->addMyAccountToBreadcrumb();

        $breadcrumb['links'][] = [
            'title' => $this->trans('Addresses', [], 'Shop.Theme.Global'),
            'url' => $this->context->link->getPageLink('addresses'),
        ];

        $id_address = Tools::getValue('id_address');
        $title = $id_address
            ? $this->trans('Update your address', [], 'Shop.Theme.Customeraccount')
            : $this->trans('New address', [], 'Shop.Theme.Customeraccount');

        $breadcrumb['links'][] = [
            'title' => $title,
            'url' => '#',
        ];

        return $breadcrumb;
    }

    public function displayAjaxAddressForm()
    {
        $addressForm = $this->makeAddressForm();



        if (Tools::getIsset('id_address') && ($id_address = (int) Tools::getValue('id_address'))) {
            $addressForm->loadAddressById($id_address);
        }

        if (Tools::getIsset('id_country')) {
            $addressForm->fillWith(['id_country' => Tools::getValue('id_country')]);
        }


        ob_end_clean();
        header('Content-Type: application/json');
        $this->ajaxRender(json_encode([
            'address_form' => $this->render(
                'customer/_partials/address-form',
                $addressForm->getTemplateVariables()
            ),
        ]));
    }
}
