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


class SEOType extends TranslatorAwareType
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


        $builder
            ->add('serp', SerpType::class)
            ->add('meta_title', TranslatableType::class, [
                'label' => $this->trans('Meta title', 'Admin.Catalog.Feature'),
                'label_help_box' => $this->trans('Public title for the product page, and for search engines. Leave blank to use the product name. The number of remaining characters is displayed to the right of the field.', 'Admin.Catalog.Help'),
                'required' => false,
                'type' => TextWithLengthCounterType::class,
                'help' => $this->trans(
                    'Public title for the product page, and for search engines. Leave blank to use the product name. The number of remaining characters is displayed to the right of the field.',
                    'Admin.Catalog.Help'
                ),
                'options' => [
                    'input' => 'text',
                    'input_attr' => [
                        'class' => 'serp-watched-title',
                    ],
                    'max_length' => 128,
                    'position' => 'after',
                    'constraints' => [
                        new Length([
                            'max' => 128,
                            'maxMessage' => $this->trans(
                                'This field cannot be longer than %limit% characters.',
                                'Admin.Notifications.Error',
                                ['%limit%' => 128]
                            ),
                        ]),
                    ],
                ],
                'modify_all_shops' => true,
            ])
            ->add('meta_description', TranslatableType::class, [
                'label' => $this->trans('Meta description', 'Admin.Catalog.Feature'),
                'label_help_box' => $this->trans('This description will appear in search engines. You need a single sentence, shorter than 160 characters (including spaces)', 'Admin.Catalog.Help'),
                'required' => false,
                'type' => TextWithLengthCounterType::class,
                'help' => $this->trans(
                    'This description will appear in search engines. It should be a single sentence, shorter than 160 characters (including spaces).',
                    'Admin.Catalog.Help'
                ),
                'options' => [
                    'input' => 'textarea',
                    'input_attr' => [
                        'class' => 'serp-watched-description',
                    ],
                    'max_length' => ProductSettings::MAX_META_DESCRIPTION_LENGTH,
                    'position' => 'after',
                    'constraints' => [
                        new Length([
                            'max' => ProductSettings::MAX_META_DESCRIPTION_LENGTH,
                            'maxMessage' => $this->trans(
                                'This field cannot be longer than %limit% characters.',
                                'Admin.Notifications.Error',
                                ['%limit%' => ProductSettings::MAX_META_DESCRIPTION_LENGTH]
                            ),
                        ]),
                    ],
                ],
                'modify_all_shops' => true,
            ])
            ->add('link_rewrite', TranslatableType::class, [
                'label' => $this->trans('Friendly URL', 'Admin.Catalog.Feature'),
                'label_help_box' => $this->trans('This is the human-readable URL, as generated from the product\'s name. You can change it if you want.', 'Admin.Catalog.Help'),
                'required' => false,
                'type' => TextType::class,
                'help' => $this->trans(
                    'This is the human-readable URL, as generated from the product\'s name. You can change it if you want.',
                    'Admin.Catalog.Help'
                ),
                'alert_message' => $this->getFriendlyAlterMessages(),
                'options' => [
                    'constraints' => [
                        new TypedRegex(TypedRegex::TYPE_LINK_REWRITE),
                        new Length(['max' => ProductSettings::MAX_LINK_REWRITE_LENGTH]),
                    ],
                    'attr' => [
                        'class' => 'serp-watched-url',
                        'data-automatic-update' => (int) $automaticUrlUpdate,
                    ],
                ],
                'modify_all_shops' => true,
            ])
            ->add('redirect_option', RedirectOptionType::class, [
                'product_id' => $options['product_id'],
            ])
            ->add('tags', TranslatableType::class, [
                'required' => false,
                'label' => $this->trans('Tags', 'Admin.Catalog.Feature'),
                'label_tag_name' => 'h3',
                'label_subtitle' => $this->trans('Enter the keywords that customers might search for when looking for this product.', 'Admin.Catalog.Feature'),
                'help' => sprintf(
                    '%s %s',
                    $this->trans('Separate each tag with a comma or press the Enter key.', 'Admin.Catalog.Help'),
                    $this->trans('Invalid characters: %s', 'Admin.Notifications.Info', [TypedRegexValidator::GENERIC_NAME_CHARS])
                ),
                'external_link' => [
                    'href' => $this->legacyContext->getAdminLink('AdminTags', true),
                    'text' => $this->trans('[1]Manage all tags[/1]', 'Admin.Catalog.Feature'),
                ],
                'options' => [
                    'constraints' => [
                        new TypedRegex(TypedRegex::TYPE_GENERIC_NAME),
                    ],
                    'attr' => [
                        'class' => 'js-taggable-field',
                    ],
                    'required' => false,
                ],
            ])
        ;
    }

    /**
     * @return string[]
     */
    private function getFriendlyAlterMessages(): array
    {
        $alertMessages = [];
        $friendlyUrl = $this->router->generate('admin_metas_index') . '#meta_settings_set_up_urls_form';
        $productPreferencesUrl = $this->router->generate('admin_product_preferences') . '#configuration_fieldset_products';

        if (!$this->friendlyUrlEnabled) {
            $alertMessages[] = sprintf(
                '<strong>%s</strong> %s',
                $this->trans('Friendly URLs are currently disabled.', 'Admin.Catalog.Notification'),
                $this->trans('To enable it, go to [1]SEO and URLs[/1]', 'Admin.Catalog.Notification', [
                    '[1]' => '<a target="_blank" href="' . $friendlyUrl . '">',
                    '[/1]' => '</a>',
                ])
            );
        }
        if ($this->forceFriendlyUrl) {
            $alertMessages[] = sprintf(
                '<strong>%s</strong> %s',
                $this->trans('The "Force update of friendly URL" option is currently enabled.', 'Admin.Catalog.Notification'),
                $this->trans('To disable it, go to [1]Product Settings[/1]', 'Admin.Catalog.Notification', [
                    '[1]' => '<a target="_blank" href="' . $productPreferencesUrl . '">',
                    '[/1]' => '</a>',
                ])
            );
        }

        return $alertMessages;
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver
            ->setDefaults([
                'label' => $this->trans('SEO', 'Admin.Catalog.Feature'),
                'label_tab' => $this->trans('Search engine optimization', 'Admin.Catalog.Feature'),
                'label_tag_name' => 'h3',
                'label_subtitle' => $this->trans('Improve your ranking and how your product page will appear in search engines results.', 'Admin.Catalog.Feature'),
                'required' => false,
                'form_theme' => '@PrestaShop/Admin/Sell/Catalog/Product/FormTheme/product_seo.html.twig',
                'active' => false,
            ])
            ->setRequired([
                'product_id',
            ])
            ->setAllowedTypes('product_id', 'int')
            ->setAllowedTypes('active', ['bool'])
        ;
    }
}
