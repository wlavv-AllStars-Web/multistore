<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 *
 * @final
 */
class WorldlineopAdminContainer extends Container
{
    private $parameters = [];

    public function __construct()
    {
        $this->services = $this->privates = [];
        $this->methodMap = [
            'worldlineop.context' => 'getWorldlineop_ContextService',
            'worldlineop.event.presenter' => 'getWorldlineop_Event_PresenterService',
            'worldlineop.getpayment.presenter' => 'getWorldlineop_Getpayment_PresenterService',
            'worldlineop.getrefund.presenter' => 'getWorldlineop_Getrefund_PresenterService',
            'worldlineop.installer' => 'getWorldlineop_InstallerService',
            'worldlineop.logger' => 'getWorldlineop_LoggerService',
            'worldlineop.logger.factory' => 'getWorldlineop_Logger_FactoryService',
            'worldlineop.module' => 'getWorldlineop_ModuleService',
            'worldlineop.processor.transaction' => 'getWorldlineop_Processor_TransactionService',
            'worldlineop.repository.token' => 'getWorldlineop_Repository_TokenService',
            'worldlineop.repository.transaction' => 'getWorldlineop_Repository_TransactionService',
            'worldlineop.sdk.client' => 'getWorldlineop_Sdk_ClientService',
            'worldlineop.sdk.client.factory' => 'getWorldlineop_Sdk_Client_FactoryService',
            'worldlineop.sdk.communicator' => 'getWorldlineop_Sdk_CommunicatorService',
            'worldlineop.sdk.communicator_configuration.factory' => 'getWorldlineop_Sdk_CommunicatorConfiguration_FactoryService',
            'worldlineop.sdk.connection' => 'getWorldlineop_Sdk_ConnectionService',
            'worldlineop.settings' => 'getWorldlineop_SettingsService',
            'worldlineop.settings.account.resolver' => 'getWorldlineop_Settings_Account_ResolverService',
            'worldlineop.settings.account.updater' => 'getWorldlineop_Settings_Account_UpdaterService',
            'worldlineop.settings.account.validation' => 'getWorldlineop_Settings_Account_ValidationService',
            'worldlineop.settings.advanced_settings.resolver' => 'getWorldlineop_Settings_AdvancedSettings_ResolverService',
            'worldlineop.settings.advanced_settings.updater' => 'getWorldlineop_Settings_AdvancedSettings_UpdaterService',
            'worldlineop.settings.advanced_settings.validation' => 'getWorldlineop_Settings_AdvancedSettings_ValidationService',
            'worldlineop.settings.factory' => 'getWorldlineop_Settings_FactoryService',
            'worldlineop.settings.get_products' => 'getWorldlineop_Settings_GetProductsService',
            'worldlineop.settings.loader' => 'getWorldlineop_Settings_LoaderService',
            'worldlineop.settings.payment_methods.resolver' => 'getWorldlineop_Settings_PaymentMethods_ResolverService',
            'worldlineop.settings.payment_methods.updater' => 'getWorldlineop_Settings_PaymentMethods_UpdaterService',
            'worldlineop.settings.payment_methods.validation' => 'getWorldlineop_Settings_PaymentMethods_ValidationService',
            'worldlineop.settings.presenter' => 'getWorldlineop_Settings_PresenterService',
            'worldlineop.settings.serializer' => 'getWorldlineop_Settings_SerializerService',
            'worldlineop.status.manager' => 'getWorldlineop_Status_ManagerService',
            'worldlineop.tab.manager' => 'getWorldlineop_Tab_ManagerService',
            'worldlineop.transaction.presenter' => 'getWorldlineop_Transaction_PresenterService',
        ];

        $this->aliases = [];
    }

    public function compile(): void
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    public function isCompiled(): bool
    {
        return true;
    }

    public function getRemovedIds(): array
    {
        return [
            'Psr\\Container\\ContainerInterface' => true,
            'Symfony\\Component\\DependencyInjection\\ContainerInterface' => true,
        ];
    }

    /**
     * Gets the public 'worldlineop.context' shared service.
     *
     * @return \Context
     */
    protected function getWorldlineop_ContextService()
    {
        return $this->services['worldlineop.context'] = \Context::getContext();
    }

    /**
     * Gets the public 'worldlineop.event.presenter' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Presenter\WebhookEventPresenter
     */
    protected function getWorldlineop_Event_PresenterService()
    {
        return $this->services['worldlineop.event.presenter'] = new \WorldlineOP\PrestaShop\Presenter\WebhookEventPresenter(($this->services['worldlineop.getpayment.presenter'] ?? $this->getWorldlineop_Getpayment_PresenterService()), ($this->services['worldlineop.getrefund.presenter'] ?? $this->getWorldlineop_Getrefund_PresenterService()), ($this->services['worldlineop.logger.factory'] ?? $this->getWorldlineop_Logger_FactoryService()));
    }

    /**
     * Gets the public 'worldlineop.getpayment.presenter' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Presenter\GetPaymentPresenter
     */
    protected function getWorldlineop_Getpayment_PresenterService()
    {
        return $this->services['worldlineop.getpayment.presenter'] = new \WorldlineOP\PrestaShop\Presenter\GetPaymentPresenter(($this->services['worldlineop.module'] ?? $this->getWorldlineop_ModuleService()), ($this->services['worldlineop.sdk.client.factory'] ?? $this->getWorldlineop_Sdk_Client_FactoryService()), ($this->services['worldlineop.settings.loader'] ?? $this->getWorldlineop_Settings_LoaderService()), ($this->services['worldlineop.logger.factory'] ?? $this->getWorldlineop_Logger_FactoryService()));
    }

    /**
     * Gets the public 'worldlineop.getrefund.presenter' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Presenter\GetRefundPresenter
     */
    protected function getWorldlineop_Getrefund_PresenterService()
    {
        return $this->services['worldlineop.getrefund.presenter'] = new \WorldlineOP\PrestaShop\Presenter\GetRefundPresenter(($this->services['worldlineop.module'] ?? $this->getWorldlineop_ModuleService()), ($this->services['worldlineop.logger.factory'] ?? $this->getWorldlineop_Logger_FactoryService()));
    }

    /**
     * Gets the public 'worldlineop.installer' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Installer\Installer
     */
    protected function getWorldlineop_InstallerService()
    {
        return $this->services['worldlineop.installer'] = new \WorldlineOP\PrestaShop\Installer\Installer(($this->services['worldlineop.module'] ?? $this->getWorldlineop_ModuleService()), ($this->services['worldlineop.tab.manager'] ?? ($this->services['worldlineop.tab.manager'] = new \WorldlineOP\PrestaShop\Utils\TabManager())), ($this->services['worldlineop.status.manager'] ?? ($this->services['worldlineop.status.manager'] = new \WorldlineOP\PrestaShop\Utils\OrderStatusManager())), ($this->services['worldlineop.settings.account.updater'] ?? $this->getWorldlineop_Settings_Account_UpdaterService()), ($this->services['worldlineop.settings.advanced_settings.updater'] ?? $this->getWorldlineop_Settings_AdvancedSettings_UpdaterService()), ($this->services['worldlineop.settings.payment_methods.updater'] ?? $this->getWorldlineop_Settings_PaymentMethods_UpdaterService()), '8.1.6', ($this->services['worldlineop.logger.factory'] ?? $this->getWorldlineop_Logger_FactoryService()));
    }

    /**
     * Gets the public 'worldlineop.logger' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Logger\LoggerFactory
     */
    protected function getWorldlineop_LoggerService()
    {
        return $this->services['worldlineop.logger'] = ($this->services['worldlineop.logger.factory'] ?? $this->getWorldlineop_Logger_FactoryService())->getLogger(($this->services['worldlineop.settings.factory'] ?? $this->getWorldlineop_Settings_FactoryService())->deserialize(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer()));
    }

    /**
     * Gets the public 'worldlineop.logger.factory' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Logger\LoggerFactory
     */
    protected function getWorldlineop_Logger_FactoryService()
    {
        return $this->services['worldlineop.logger.factory'] = new \WorldlineOP\PrestaShop\Logger\LoggerFactory(($this->services['worldlineop.settings.factory'] ?? $this->getWorldlineop_Settings_FactoryService())->deserialize(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer()));
    }

    /**
     * Gets the public 'worldlineop.module' shared service.
     *
     * @return \Worldlineop
     */
    protected function getWorldlineop_ModuleService()
    {
        return $this->services['worldlineop.module'] = \Module::getInstanceByName('worldlineop');
    }

    /**
     * Gets the public 'worldlineop.processor.transaction' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Processor\TransactionResponseProcessor
     */
    protected function getWorldlineop_Processor_TransactionService()
    {
        return $this->services['worldlineop.processor.transaction'] = new \WorldlineOP\PrestaShop\Processor\TransactionResponseProcessor(($this->services['worldlineop.module'] ?? $this->getWorldlineop_ModuleService()), ($this->services['worldlineop.logger.factory'] ?? $this->getWorldlineop_Logger_FactoryService()));
    }

    /**
     * Gets the public 'worldlineop.repository.token' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Repository\TokenRepository
     */
    protected function getWorldlineop_Repository_TokenService()
    {
        return $this->services['worldlineop.repository.token'] = new \WorldlineOP\PrestaShop\Repository\TokenRepository();
    }

    /**
     * Gets the public 'worldlineop.repository.transaction' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Repository\TransactionRepository
     */
    protected function getWorldlineop_Repository_TransactionService()
    {
        return $this->services['worldlineop.repository.transaction'] = new \WorldlineOP\PrestaShop\Repository\TransactionRepository();
    }

    /**
     * Gets the public 'worldlineop.sdk.client' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Sdk\ClientFactory
     */
    protected function getWorldlineop_Sdk_ClientService()
    {
        return $this->services['worldlineop.sdk.client'] = ($this->services['worldlineop.sdk.client.factory'] ?? $this->getWorldlineop_Sdk_Client_FactoryService())->getMerchant(($this->services['worldlineop.sdk.communicator'] ?? $this->getWorldlineop_Sdk_CommunicatorService()), ($this->services['worldlineop.settings.factory'] ?? $this->getWorldlineop_Settings_FactoryService())->deserialize(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer()));
    }

    /**
     * Gets the public 'worldlineop.sdk.client.factory' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Sdk\ClientFactory
     */
    protected function getWorldlineop_Sdk_Client_FactoryService()
    {
        return $this->services['worldlineop.sdk.client.factory'] = new \WorldlineOP\PrestaShop\Sdk\ClientFactory(($this->services['worldlineop.sdk.communicator'] ?? $this->getWorldlineop_Sdk_CommunicatorService()), ($this->services['worldlineop.settings.factory'] ?? $this->getWorldlineop_Settings_FactoryService())->deserialize(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer()));
    }

    /**
     * Gets the public 'worldlineop.sdk.communicator' shared service.
     *
     * @return \OnlinePayments\Sdk\Communicator
     */
    protected function getWorldlineop_Sdk_CommunicatorService()
    {
        return $this->services['worldlineop.sdk.communicator'] = new \OnlinePayments\Sdk\Communicator(($this->services['worldlineop.sdk.connection'] ?? ($this->services['worldlineop.sdk.connection'] = new \OnlinePayments\Sdk\DefaultConnection())), ($this->services['worldlineop.sdk.communicator_configuration.factory'] ?? $this->getWorldlineop_Sdk_CommunicatorConfiguration_FactoryService())->getInstance());
    }

    /**
     * Gets the public 'worldlineop.sdk.communicator_configuration.factory' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Sdk\CommunicatorConfigurationFactory
     */
    protected function getWorldlineop_Sdk_CommunicatorConfiguration_FactoryService()
    {
        return $this->services['worldlineop.sdk.communicator_configuration.factory'] = new \WorldlineOP\PrestaShop\Sdk\CommunicatorConfigurationFactory(($this->services['worldlineop.settings.factory'] ?? $this->getWorldlineop_Settings_FactoryService())->deserialize(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer()), ($this->services['worldlineop.module'] ?? $this->getWorldlineop_ModuleService()));
    }

    /**
     * Gets the public 'worldlineop.sdk.connection' shared service.
     *
     * @return \OnlinePayments\Sdk\DefaultConnection
     */
    protected function getWorldlineop_Sdk_ConnectionService()
    {
        return $this->services['worldlineop.sdk.connection'] = new \OnlinePayments\Sdk\DefaultConnection();
    }

    /**
     * Gets the public 'worldlineop.settings' service.
     *
     * @return \WorldlineOP\PrestaShop\Configuration\Loader\SettingsLoader
     */
    protected function getWorldlineop_SettingsService()
    {
        return ($this->services['worldlineop.settings.factory'] ?? $this->getWorldlineop_Settings_FactoryService())->deserialize(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer());
    }

    /**
     * Gets the public 'worldlineop.settings.account.resolver' shared service.
     *
     * @return \WorldlineOP\PrestaShop\OptionsResolver\AccountSettingsResolver
     */
    protected function getWorldlineop_Settings_Account_ResolverService()
    {
        return $this->services['worldlineop.settings.account.resolver'] = new \WorldlineOP\PrestaShop\OptionsResolver\AccountSettingsResolver();
    }

    /**
     * Gets the public 'worldlineop.settings.account.updater' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Configuration\Updater\AccountSettingsUpdater
     */
    protected function getWorldlineop_Settings_Account_UpdaterService()
    {
        return $this->services['worldlineop.settings.account.updater'] = new \WorldlineOP\PrestaShop\Configuration\Updater\AccountSettingsUpdater(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer(), ($this->services['worldlineop.settings.account.resolver'] ?? ($this->services['worldlineop.settings.account.resolver'] = new \WorldlineOP\PrestaShop\OptionsResolver\AccountSettingsResolver())), ($this->services['worldlineop.settings.factory'] ?? $this->getWorldlineop_Settings_FactoryService())->deserialize(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer()), ($this->services['worldlineop.settings.account.validation'] ?? $this->getWorldlineop_Settings_Account_ValidationService()), ($this->services['worldlineop.module'] ?? $this->getWorldlineop_ModuleService()));
    }

    /**
     * Gets the public 'worldlineop.settings.account.validation' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Configuration\Validation\AccountValidationData
     */
    protected function getWorldlineop_Settings_Account_ValidationService()
    {
        return $this->services['worldlineop.settings.account.validation'] = new \WorldlineOP\PrestaShop\Configuration\Validation\AccountValidationData(($this->services['worldlineop.module'] ?? $this->getWorldlineop_ModuleService()));
    }

    /**
     * Gets the public 'worldlineop.settings.advanced_settings.resolver' shared service.
     *
     * @return \WorldlineOP\PrestaShop\OptionsResolver\AdvancedSettingsResolver
     */
    protected function getWorldlineop_Settings_AdvancedSettings_ResolverService()
    {
        return $this->services['worldlineop.settings.advanced_settings.resolver'] = new \WorldlineOP\PrestaShop\OptionsResolver\AdvancedSettingsResolver();
    }

    /**
     * Gets the public 'worldlineop.settings.advanced_settings.updater' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Configuration\Updater\AdvancedSettingsUpdater
     */
    protected function getWorldlineop_Settings_AdvancedSettings_UpdaterService()
    {
        return $this->services['worldlineop.settings.advanced_settings.updater'] = new \WorldlineOP\PrestaShop\Configuration\Updater\AdvancedSettingsUpdater(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer(), ($this->services['worldlineop.settings.advanced_settings.resolver'] ?? ($this->services['worldlineop.settings.advanced_settings.resolver'] = new \WorldlineOP\PrestaShop\OptionsResolver\AdvancedSettingsResolver())), ($this->services['worldlineop.settings.factory'] ?? $this->getWorldlineop_Settings_FactoryService())->deserialize(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer()), ($this->services['worldlineop.settings.advanced_settings.validation'] ?? $this->getWorldlineop_Settings_AdvancedSettings_ValidationService()), ($this->services['worldlineop.module'] ?? $this->getWorldlineop_ModuleService()));
    }

    /**
     * Gets the public 'worldlineop.settings.advanced_settings.validation' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Configuration\Validation\AdvancedSettingsValidationData
     */
    protected function getWorldlineop_Settings_AdvancedSettings_ValidationService()
    {
        return $this->services['worldlineop.settings.advanced_settings.validation'] = new \WorldlineOP\PrestaShop\Configuration\Validation\AdvancedSettingsValidationData(($this->services['worldlineop.module'] ?? $this->getWorldlineop_ModuleService()));
    }

    /**
     * Gets the public 'worldlineop.settings.factory' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Configuration\Loader\SettingsLoader
     */
    protected function getWorldlineop_Settings_FactoryService()
    {
        return $this->services['worldlineop.settings.factory'] = new \WorldlineOP\PrestaShop\Configuration\Loader\SettingsLoader(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer());
    }

    /**
     * Gets the public 'worldlineop.settings.get_products' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Configuration\Product\GetProductsRequest
     */
    protected function getWorldlineop_Settings_GetProductsService()
    {
        return $this->services['worldlineop.settings.get_products'] = new \WorldlineOP\PrestaShop\Configuration\Product\GetProductsRequest(($this->services['worldlineop.sdk.client'] ?? $this->getWorldlineop_Sdk_ClientService()), ($this->services['worldlineop.settings.factory'] ?? $this->getWorldlineop_Settings_FactoryService())->deserialize(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer()), ($this->services['worldlineop.logger.factory'] ?? $this->getWorldlineop_Logger_FactoryService()));
    }

    /**
     * Gets the public 'worldlineop.settings.loader' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Configuration\Loader\SettingsLoader
     */
    protected function getWorldlineop_Settings_LoaderService()
    {
        return $this->services['worldlineop.settings.loader'] = new \WorldlineOP\PrestaShop\Configuration\Loader\SettingsLoader(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer());
    }

    /**
     * Gets the public 'worldlineop.settings.payment_methods.resolver' shared service.
     *
     * @return \WorldlineOP\PrestaShop\OptionsResolver\PaymentMethodsSettingsResolver
     */
    protected function getWorldlineop_Settings_PaymentMethods_ResolverService()
    {
        return $this->services['worldlineop.settings.payment_methods.resolver'] = new \WorldlineOP\PrestaShop\OptionsResolver\PaymentMethodsSettingsResolver();
    }

    /**
     * Gets the public 'worldlineop.settings.payment_methods.updater' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Configuration\Updater\PaymentMethodsSettingsUpdater
     */
    protected function getWorldlineop_Settings_PaymentMethods_UpdaterService()
    {
        return $this->services['worldlineop.settings.payment_methods.updater'] = new \WorldlineOP\PrestaShop\Configuration\Updater\PaymentMethodsSettingsUpdater(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer(), ($this->services['worldlineop.settings.payment_methods.resolver'] ?? ($this->services['worldlineop.settings.payment_methods.resolver'] = new \WorldlineOP\PrestaShop\OptionsResolver\PaymentMethodsSettingsResolver())), ($this->services['worldlineop.settings.factory'] ?? $this->getWorldlineop_Settings_FactoryService())->deserialize(($this->services['worldlineop.settings.serializer'] ?? ($this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer()))->getSerializer()), ($this->services['worldlineop.settings.payment_methods.validation'] ?? $this->getWorldlineop_Settings_PaymentMethods_ValidationService()), ($this->services['worldlineop.module'] ?? $this->getWorldlineop_ModuleService()));
    }

    /**
     * Gets the public 'worldlineop.settings.payment_methods.validation' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Configuration\Validation\PaymentMethodsValidationData
     */
    protected function getWorldlineop_Settings_PaymentMethods_ValidationService()
    {
        return $this->services['worldlineop.settings.payment_methods.validation'] = new \WorldlineOP\PrestaShop\Configuration\Validation\PaymentMethodsValidationData(($this->services['worldlineop.module'] ?? $this->getWorldlineop_ModuleService()));
    }

    /**
     * Gets the public 'worldlineop.settings.presenter' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Presenter\ModuleConfigurationPresenter
     */
    protected function getWorldlineop_Settings_PresenterService()
    {
        return $this->services['worldlineop.settings.presenter'] = new \WorldlineOP\PrestaShop\Presenter\ModuleConfigurationPresenter(($this->services['worldlineop.module'] ?? $this->getWorldlineop_ModuleService()), ($this->services['worldlineop.settings.loader'] ?? $this->getWorldlineop_Settings_LoaderService()));
    }

    /**
     * Gets the public 'worldlineop.settings.serializer' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Serializer\SettingsSerializer
     */
    protected function getWorldlineop_Settings_SerializerService()
    {
        return $this->services['worldlineop.settings.serializer'] = new \WorldlineOP\PrestaShop\Serializer\SettingsSerializer();
    }

    /**
     * Gets the public 'worldlineop.status.manager' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Utils\OrderStatusManager
     */
    protected function getWorldlineop_Status_ManagerService()
    {
        return $this->services['worldlineop.status.manager'] = new \WorldlineOP\PrestaShop\Utils\OrderStatusManager();
    }

    /**
     * Gets the public 'worldlineop.tab.manager' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Utils\TabManager
     */
    protected function getWorldlineop_Tab_ManagerService()
    {
        return $this->services['worldlineop.tab.manager'] = new \WorldlineOP\PrestaShop\Utils\TabManager();
    }

    /**
     * Gets the public 'worldlineop.transaction.presenter' shared service.
     *
     * @return \WorldlineOP\PrestaShop\Presenter\TransactionPresenter
     */
    protected function getWorldlineop_Transaction_PresenterService()
    {
        return $this->services['worldlineop.transaction.presenter'] = new \WorldlineOP\PrestaShop\Presenter\TransactionPresenter(($this->services['worldlineop.module'] ?? $this->getWorldlineop_ModuleService()), ($this->services['worldlineop.repository.transaction'] ?? ($this->services['worldlineop.repository.transaction'] = new \WorldlineOP\PrestaShop\Repository\TransactionRepository())), ($this->services['worldlineop.sdk.client'] ?? $this->getWorldlineop_Sdk_ClientService()));
    }
}
