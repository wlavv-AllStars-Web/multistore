<?php
/**
 * 2021 Worldline Online Payments
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0).
 * It is also available through the world-wide-web at this URL: https://opensource.org/licenses/AFL-3.0
 *
 * @author    PrestaShop partner
 * @copyright 2021 Worldline Online Payments
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *
 */

namespace WorldlineOP\PrestaShop\Builder;

use Context;
use Country;
use OnlinePayments\Sdk\Domain\Address;
use OnlinePayments\Sdk\Domain\AddressPersonal;
use OnlinePayments\Sdk\Domain\AmountOfMoney;
use OnlinePayments\Sdk\Domain\BrowserData;
use OnlinePayments\Sdk\Domain\CompanyInformation;
use OnlinePayments\Sdk\Domain\ContactDetails;
use OnlinePayments\Sdk\Domain\Customer;
use OnlinePayments\Sdk\Domain\CustomerDevice;
use OnlinePayments\Sdk\Domain\Order;
use OnlinePayments\Sdk\Domain\OrderReferences;
use OnlinePayments\Sdk\Domain\PersonalInformation;
use OnlinePayments\Sdk\Domain\PersonalName;
use OnlinePayments\Sdk\Domain\RedirectionData;
use OnlinePayments\Sdk\Domain\RedirectPaymentMethodSpecificInput;
use OnlinePayments\Sdk\Domain\Shipping;
use RandomLib\Factory;
use SecurityLib\Strength;
use Worldlineop;
use WorldlineOP\PrestaShop\Configuration\Entity\PaymentMethodsSettings;
use WorldlineOP\PrestaShop\Configuration\Entity\PaymentSettings;
use WorldlineOP\PrestaShop\Configuration\Entity\Settings;
use WorldlineOP\PrestaShop\Presenter\ShoppingCartPresenter;
use WorldlineOP\PrestaShop\Utils\Decimal;
use WorldlineOP\PrestaShop\Utils\Tools;

/**
 * Class AbstractRequestBuilder
 * @package WorldlineOP\PrestaShop\Builder
 */
abstract class AbstractRequestBuilder implements PaymentRequestBuilderInterface
{
    const METHOD_HOSTED = 'hosted';
    const METHOD_HTP = 'htp';

    const PRODUCT_ID_MAESTRO = 117;
    const PRODUCT_ID_PAYPAL = 840;

    const PHONE_NUMBER_MAX_CHARS = 15;

    const REFERENCE_CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    const CARD_ON_FILE_REQUESTOR_FIRST = 'cardholderInitiated';
    const CARD_ON_FILE_REQUESTOR_SUBSEQUENT = 'cardholderInitiated';
    const CARD_ON_FILE_SEQUENCE_INDICATOR_FIRST = 'first';
    const CARD_ON_FILE_SEQUENCE_INDICATOR_SUBSEQUENT = 'subsequent';

    const THREE_DS_LOW_VALUE = 'low-value';
    const THREE_DS_AMOUNT_EUR = 30;

    const CHALLENGE_INDICATOR_REQUIRED = 'challenge-required';

    /** @var Settings $settings */
    protected $settings;

    /** @var Worldlineop $module */
    protected $module;

    /** @var Context $context */
    protected $context;

    /** @var ShoppingCartPresenter $shoppingCartPresenter */
    protected $shoppingCartPresenter;

    /** @var string $idProduct */
    protected $idProduct;

    /** @var string $tokenValue */
    protected $tokenValue;

    /** @var array|false $ccForm */
    protected $ccForm;

    /**
     * AbstractRequestBuilder constructor.
     * @param Settings    $settings
     * @param Worldlineop $module
     * @param Context     $context
     */
    public function __construct(
        Settings $settings,
        Worldlineop $module,
        Context $context,
        ShoppingCartPresenter $shoppingCartPresenter
    ) {
        $this->settings = $settings;
        $this->module = $module;
        $this->context = $context;
        $this->shoppingCartPresenter = $shoppingCartPresenter;
    }

    /**
     * @param string|false $idProduct
     * @param string|false $tokenValue
     * @param array|false  $ccForm
     */
    public function setData($idProduct = false, $tokenValue = false, $ccForm = false)
    {
        $this->idProduct = $idProduct;
        $this->tokenValue = $tokenValue;
        $this->ccForm = $ccForm;
    }

    /**
     * @return RedirectPaymentMethodSpecificInput|false
     */
    public function buildRedirectPaymentMethodSpecificInput()
    {
        if (false !== $this->idProduct) {
            $product = $this->settings->paymentMethodsSettings->findRedirectPMByProductId((int) $this->idProduct);
            if (false === $product || PaymentMethodsSettings::PAYMENT_METHOD_REDIRECT !== $product->type) {
                return false;
            }
        }

        $redirectPaymentMethodSpecificInput = new RedirectPaymentMethodSpecificInput();
        if (false !== $this->idProduct) {
            $redirectPaymentMethodSpecificInput->setPaymentProductId($this->idProduct);
        }
        $redirectPaymentMethodSpecificInput->setRequiresApproval(
            $this->settings->advancedSettings->paymentSettings->transactionType === PaymentSettings::TRANSACTION_TYPE_AUTH
        );
        $redirectionData = new RedirectionData();

        $redirectionData->setReturnUrl(
            $this->context->link->getModuleLink($this->module->name, 'redirect', ['action' => 'redirectReturnHosted'])
        );
        $redirectPaymentMethodSpecificInput->setRedirectionData($redirectionData);

        return $redirectPaymentMethodSpecificInput;
    }

    /**
     * @return Order
     * @throws \Exception
     */
    public function buildOrder()
    {
        $order = new Order();
        $amount = new AmountOfMoney();
        $amount->setAmount((int) Decimal::multiply((string) $this->context->cart->getOrderTotal(), '100')->getIntegerPart());
        $amount->setCurrencyCode(Tools::getIsoCurrencyCodeById($this->context->cart->id_currency));
        $order->setAmountOfMoney($amount);
        $order->setCustomer($this->buildCustomer());
        $order->setShipping($this->buildShipping());
        $factory = new Factory();
        $generator = $factory->getGenerator(new Strength(Strength::LOW));
        $orderReferences = new OrderReferences();
        $orderReferences->setMerchantReference(
            $this->context->cart->id.'-'.$generator->generateString(7, self::REFERENCE_CHARS)
        );
        $order->setReferences($orderReferences);

        return $order;
    }

    /**
     * @return Customer
     */
    private function buildCustomer()
    {
        $customer = new Customer();
        $device = new CustomerDevice();
        $device->setAcceptHeader($_SERVER['HTTP_ACCEPT']);
        $device->setUserAgent($_SERVER['HTTP_USER_AGENT']);
        $customerConnections = $this->context->customer->getLastConnections();
        if (!empty($customerConnections)) {
            $connection = $customerConnections[0];
            $device->setIpAddress($connection['ipaddress']);
        }
        if (false !== $this->ccForm) {
            $browserData = new BrowserData();
            $browserData->setColorDepth((int) $this->ccForm['colorDepth']);
            $browserData->setJavaEnabled(boolval($this->ccForm['javaEnabled']));
            $browserData->setScreenHeight($this->ccForm['screenHeight']);
            $browserData->setScreenWidth($this->ccForm['screenWidth']);
            $device->setLocale($this->ccForm['locale']);
            $device->setTimezoneOffsetUtcMinutes($this->ccForm['timezoneOffsetUtcMinutes']);
            $device->setBrowserData($browserData);
        }
        $customer->setDevice($device);
        $customerAddress = new \Address((int) $this->context->cart->id_address_invoice);
        $contactDetails = new ContactDetails();
        $contactDetails->setEmailAddress($this->context->customer->email);
        $contactDetails->setPhoneNumber(substr(preg_replace('/[^0-9+]/', '', $customerAddress->phone), 0, self::PHONE_NUMBER_MAX_CHARS));
        $contactDetails->setMobilePhoneNumber(substr(preg_replace('/[^0-9+]/', '', $customerAddress->phone_mobile), 0, self::PHONE_NUMBER_MAX_CHARS));
        $customer->setContactDetails($contactDetails);
        $billingAddress = new Address();
        $billingAddress->setCountryCode(Country::getIsoById($customerAddress->id_country));
        $billingAddress->setCity($customerAddress->city);
        $billingAddress->setStreet($customerAddress->address1);
        $billingAddress->setAdditionalInfo($customerAddress->address2);
        $billingAddress->setZip($customerAddress->postcode);
        if ($customerAddress->id_state) {
            $billingAddress->setState(\State::getNameById($customerAddress->id_state));
        }
        $customer->setBillingAddress($billingAddress);
        if ($customerAddress->company) {
            $companyInformation = new CompanyInformation();
            $companyInformation->setName($customerAddress->company);
            $customer->setCompanyInformation($companyInformation);
        }
        $personalInformation = new PersonalInformation();
        $personalName = new PersonalName();
        $personalName->setFirstName($this->context->customer->firstname);
        $personalName->setSurname($this->context->customer->lastname);
        $personalInformation->setName($personalName);
        $customer->setPersonalInformation($personalInformation);

        return $customer;
    }

    /**
     * @return Shipping
     */
    public function buildShipping()
    {
        $shipping = new Shipping();
        $customerAddress = new \Address((int) $this->context->cart->id_address_delivery);
        $shippingAddress = new AddressPersonal();
        $shippingAddress->setCountryCode(Country::getIsoById($customerAddress->id_country));
        $shippingAddress->setCity($customerAddress->city);
        $shippingAddress->setStreet($customerAddress->address1);
        $shippingAddress->setAdditionalInfo($customerAddress->address2);
        $shippingAddress->setZip($customerAddress->postcode);
        if ($customerAddress->id_state) {
            $shippingAddress->setState(\State::getNameById($customerAddress->id_state));
        }
        $personalName = new PersonalName();
        $personalName->setFirstName($customerAddress->firstname);
        $personalName->setSurname($customerAddress->lastname);
        $shippingAddress->setName($personalName);
        $shipping->setAddress($shippingAddress);
        $shipping->setEmailAddress($this->context->customer->email);
        $shipping->setAddressIndicator($this->context->cart->id_address_delivery === $this->context->cart->id_address_invoice ? 'same-as-billing' : 'different-than-billing');

        return $shipping;
    }
}
