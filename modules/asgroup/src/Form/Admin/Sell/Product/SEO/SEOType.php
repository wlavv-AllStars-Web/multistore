<?php

declare(strict_types=1);

namespace PrestaShop\Module\AsGroup\Form\Admin\Sell\Product\SEO;

use PrestaShop\PrestaShop\Adapter\LegacyContext;
use PrestaShop\PrestaShop\Core\ConfigurationInterface;
use PrestaShop\PrestaShop\Core\ConstraintValidator\Constraints\TypedRegex;
use PrestaShop\PrestaShop\Core\ConstraintValidator\TypedRegexValidator;
use PrestaShop\PrestaShop\Core\Domain\Product\ProductSettings;
use PrestaShopBundle\Form\Admin\Sell\Product\SEO\RedirectOptionType;
use PrestaShopBundle\Form\Admin\Sell\Product\SEO\SerpType;
use PrestaShopBundle\Form\Admin\Type\TextWithLengthCounterType;
use PrestaShopBundle\Form\Admin\Type\TranslatableType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Contracts\Translation\TranslatorInterface;

use PrestaShopBundle\Form\Admin\Sell\Product\SEO\SEOType as BaseSEOType;  // Import the base SEOType class


class SEOType extends BaseSEOType
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var bool
     */
    private $friendlyUrlEnabled;

    /**
     * @var bool
     */
    private $forceFriendlyUrl;

    /**
     * @var LegacyContext
     */
    private $legacyContext;

    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    /**
     * @param TranslatorInterface $translator
     * @param array $locales
     * @param RouterInterface $router
     * @param bool $friendlyUrlEnabled
     * @param bool $forceFriendlyUrl
     * @param LegacyContext $legacyContext
     */
    public function __construct(
        TranslatorInterface $translator,
        RouterInterface $router,
        bool $friendlyUrlEnabled,
        bool $forceFriendlyUrl,
        LegacyContext $legacyContext,
        ConfigurationInterface $configuration
    ) {
        $locales = $legacyContext->getLanguages();
        parent::__construct($translator, $locales);

        $this->router = $router;
        $this->friendlyUrlEnabled = $friendlyUrlEnabled;
        $this->forceFriendlyUrl = $forceFriendlyUrl;
        $this->legacyContext = $legacyContext;
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Automatic update is only enabled when product is offline and the configuration is enabled
        $automaticUrlUpdate = false;
        if (!$options['active'] && (bool) $this->configuration->get('PS_FORCE_FRIENDLY_PRODUCT')) {
            $automaticUrlUpdate = true;
        }

        echo 'paulo';
        exit;

              // Custom logic for building your form
        parent::buildForm($builder, $options);  // Call the parent class buildForm
    }


}
