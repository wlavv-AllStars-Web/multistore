<?php
declare(strict_types=1);

namespace PrestaShop\Module\AsGroup\Form\Modifier;

use Configuration;
use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\ProductId;
use PrestaShopBundle\Form\FormBuilderModifier;
use PrestaShopBundle\Form\Admin\Sell\Product\ReferencesType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Db;
use Pack;
use PrestaModule\AdvancedPack\ProductForm\CustomTabType;
use PrestaShop\PrestaShop\Core\ConstraintValidator\Constraints\TypedRegex;
use Symfony\Component\Validator\Constraints\Length;
use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\Reference;
use PrestaShopBundle\Form\Admin\Type\ChoiceCategoriesTreeType;
use PrestaShopBundle\Form\Admin\Type\IconButtonType;
use PrestaShopBundle\Form\Admin\Type\RadioWithChoiceChildrenType;
use PrestaShopBundle\Form\Admin\Type\SwitchType;
use PrestaShopBundle\Form\Admin\Type\YesAndNoChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

    class ProductFormModifier
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var FormBuilderModifier
     */
    private $formBuilderModifier;
    private $moduleInstance;

    /**
     * @param TranslatorInterface $translator
     * @param FormBuilderModifier $formBuilderModifier
     */
    public function __construct(
        TranslatorInterface $translator,
        FormBuilderModifier $formBuilderModifier
        
    ) {
        $this->translator = $translator;
        $this->formBuilderModifier = $formBuilderModifier;
        $this->moduleInstance = \Module::getInstanceByName('asgroup');
    }



    /**
     * @param ProductId|null $productId
     * @param FormBuilderInterface $productFormBuilder
     */
    public function modify(
        ?ProductId $productId,
        FormBuilderInterface $productFormBuilder
    ): void {
        $idProduct = $productId->getValue();

        $sql = 'SELECT youtube_1, youtube_2 , dim_verify, wmdeprecated, not_to_order, nc, difficulty , disallow_stock, ec_approved , housing, universal , real_photos
        FROM
        `' . _DB_PREFIX_ . 'product` 
        WHERE id_product= '.$idProduct;

        $result = Db::getInstance()->getRow($sql);

        // pre($result['difficulty']);

        
        $data['productId'] = $idProduct;
        $data['youtube_1'] = $result['youtube_1'];
        $data['youtube_2'] = $result['youtube_2'];
        $data['dim_verify'] = $result['dim_verify'];
        $data['wmdeprecated'] = $result['wmdeprecated'];
        $data['not_to_order'] = $result['not_to_order'];
        $data['hs_code'] = $result['nc'];
        $data['difficulty'] = $result['difficulty'];
        $data['disallow_stock'] = $result['disallow_stock'];
        $data['ec_approved'] = $result['ec_approved'];
        $data['housing'] = $result['housing'];
        $data['universal'] = $result['universal'];
        $data['real_photos'] = $result['real_photos'];
        
        $this->modifyDescriptionTab($data, $productFormBuilder);
    }

    private function modifyDescriptionTab($data, FormBuilderInterface $productFormBuilder): void
    {
        // $descriptionTabFormBuilder = $productFormBuilder->get('seo');
        // $this->formBuilderModifier->addAfter(
        //     $descriptionTabFormBuilder,
        //     'tags',
        //     'demo_module_custom_field',
        //     TextType::class,
        //     [
        //         // you can remove the label if you dont need it by passing 'label' => false
        //         'label' => $this->translator->trans('Demo custom field', [], 'Modules.WkDemo.Admin'),
        //         // customize label by any html attribute
        //         'label_attr' => [
        //             'title' => 'h2',
        //             'class' => 'text-info',
        //         ],
        //         'attr' => [
        //             'placeholder' => $this->translator->trans('Your example text here', [], 'Modules.WkDemo.Admin'),
        //         ],
        //         // this is just an example, but in real case scenario you could have some data provider class to wrap more complex cases
        //         'data' => $data['seo'] ,
        //         'empty_data' => '',
        //         'form_theme' => '@PrestaShop/Admin/TwigTemplateForm/prestashop_ui_kit_base.html.twig',
        //     ]
        // );

        $descriptionTabFormBuilder = $productFormBuilder->get('description');
        $this->formBuilderModifier->addBefore(
            $descriptionTabFormBuilder,
            'description_short',
            'real_photos',
            SwitchType::class,
            [
                'choices' => [
                    $this->translator->trans('No',[], 'Admin.Catalog.Feature') => 0,
                    $this->translator->trans('Yes',[], 'Admin.Catalog.Feature') => 1,
                ],
                'data' => $data['real_photos'] ,
                'placeholder' => false,
                'expanded' => true,
                'multiple' => false,
                'required' => false,
                'label' => $this->translator->trans('Real Photos',[], 'Admin.Catalog.Feature'),
                'label_help_box' => $this->translator->trans('Real Photos helper.',[], 'Admin.Catalog.Help'),
            ]
        );

        $this->formBuilderModifier->addAfter(
            $descriptionTabFormBuilder,
            'description',
            'youtube_1',
            TextType::class,
            [
                // you can remove the label if you dont need it by passing 'label' => false
                'label' => $this->translator->trans('Youtube Code', [], 'Modules.ASGroup.Admin'),
                // customize label by any html attribute
                'label_attr' => [
                    'title' => 'h2',
                    'class' => 'text-info',
                ],
                'attr' => [
                    'placeholder' => $this->translator->trans('Your youtube code here', [], 'Modules.ASGroup.Admin'),
                    'class' => 'col-md-3',
                ],
                // this is just an example, but in real case scenario you could have some data provider class to wrap more complex cases
                'data' => $data['youtube_1'] ,
                'empty_data' => '',
                'form_theme' => '@PrestaShop/Admin/TwigTemplateForm/prestashop_ui_kit_base.html.twig',
            ]
        );

        $this->formBuilderModifier->addAfter(
            $descriptionTabFormBuilder,
            'youtube_1',
            'youtube_2',
            TextType::class,
            [
                // you can remove the label if you dont need it by passing 'label' => false
                'label' => $this->translator->trans('Youtube Code 2', [], 'Modules.ASGroup.Admin'),
                // customize label by any html attribute
                'label_attr' => [
                    'title' => 'h2',
                    'class' => 'text-info',
                ],
                'attr' => [
                    'placeholder' => $this->translator->trans('Your youtube code here', [], 'Modules.ASGroup.Admin'),
                    'class' => 'col-md-3',
                ],
                // this is just an example, but in real case scenario you could have some data provider class to wrap more complex cases
                'data' => $data['youtube_2'] ,
                'empty_data' => '',
                'form_theme' => '@PrestaShop/Admin/TwigTemplateForm/prestashop_ui_kit_base.html.twig',
            ]
        );

        // hs code

        $this->formBuilderModifier->addAfter(
            $descriptionTabFormBuilder,
            'youtube_2',
            'hs_code',
            TextType::class,
            [
                // you can remove the label if you dont need it by passing 'label' => false
                'label' => $this->translator->trans('HS code', [], 'Modules.ASGroup.Admin'),
                // customize label by any html attribute
                'label_attr' => [
                    'title' => 'h2',
                    'class' => 'text-info',
                ],
                'attr' => [
                    'placeholder' => $this->translator->trans('Product HS code here', [], 'Modules.ASGroup.Admin'),
                    'class' => 'col-md-3',
                ],
                // this is just an example, but in real case scenario you could have some data provider class to wrap more complex cases
                'data' => $data['hs_code'] ,
                'empty_data' => '',
                'form_theme' => '@PrestaShop/Admin/TwigTemplateForm/prestashop_ui_kit_base.html.twig',
            ]
        );

        // difficulty select

        $this->formBuilderModifier->addAfter(
            $descriptionTabFormBuilder,
            'hs_code',
            'difficulty',
            ChoiceType::class, // Use ChoiceType for a select field.
            [
                'label' => $this->translator->trans('Instructions Difficulty', [], 'Modules.ASGroup.Admin'),
                'label_attr' => [
                    'class' => 'text-info',
                ],
                'choices' => [
                    'Default' => 0,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                'placeholder' => null,
                'attr' => [
                    // 'value' => $data['difficulty'] ?? null,
                    // 'data-toggle' => 'select2',
                    // 'data-minimumResultsForSearch' => '6',
                ],
                'required' => false, // Optional: Whether the field is required.
                'data' => $data['difficulty'] ?? 0, // Default value.
            ]

        );


        // end of life

        $this->formBuilderModifier->addAfter(
            $descriptionTabFormBuilder,
            'difficulty',
            'ec_approved',
            SwitchType::class,
            [
                'choices' => [
                    $this->translator->trans('No',[], 'Admin.Catalog.Feature') => 0,
                    $this->translator->trans('Yes',[], 'Admin.Catalog.Feature') => 1,
                ],
                'data' => $data['ec_approved'] ,
                'placeholder' => false,
                'expanded' => true,
                'multiple' => false,
                'required' => false,
                'label' => $this->translator->trans('Ec approved',[], 'Admin.Catalog.Feature'),
                'label_help_box' => $this->translator->trans('Ec approved helper.',[], 'Admin.Catalog.Help'),
            ]
        );

        $this->formBuilderModifier->addAfter(
            $descriptionTabFormBuilder,
            'ec_approved',
            'wmdeprecated',
            SwitchType::class,
            [
                'choices' => [
                    $this->translator->trans('No',[], 'Admin.Catalog.Feature') => 0,
                    $this->translator->trans('Yes',[], 'Admin.Catalog.Feature') => 1,
                ],
                'data' => $data['wmdeprecated'] ,
                'placeholder' => false,
                'expanded' => true,
                'multiple' => false,
                'required' => false,
                'label' => $this->translator->trans('End of life',[], 'Admin.Catalog.Feature'),
                'label_help_box' => $this->translator->trans('End of life helper.',[], 'Admin.Catalog.Help'),
            ]
        );

        // not to oder producr

        $this->formBuilderModifier->addAfter(
            $descriptionTabFormBuilder,
            'wmdeprecated',
            'not_to_order',
            SwitchType::class,
            [
                'choices' => [
                    $this->translator->trans('No',[], 'Admin.Catalog.Feature') => 0,
                    $this->translator->trans('Yes',[], 'Admin.Catalog.Feature') => 1,
                ],
                'data' => $data['not_to_order'] ,
                'placeholder' => false,
                'expanded' => true,
                'multiple' => false,
                'required' => false,
                'label' => $this->translator->trans('Not to order?',[], 'Admin.Catalog.Feature'),
                'label_help_box' => $this->translator->trans('Not to order helper.',[], 'Admin.Catalog.Help'),
            ]
        );

        // disallow stock

        $this->formBuilderModifier->addAfter(
            $descriptionTabFormBuilder,
            'not_to_order',
            'disallow_stock',
            SwitchType::class,
            [
                'choices' => [
                    $this->translator->trans('No',[], 'Admin.Catalog.Feature') => 0,
                    $this->translator->trans('Yes',[], 'Admin.Catalog.Feature') => 1,
                ],
                'data' => $data['disallow_stock'] ,
                'placeholder' => false,
                'expanded' => true,
                'multiple' => false,
                'required' => false,
                'label' => $this->translator->trans('Disallow stock?',[], 'Admin.Catalog.Feature'),
                'label_help_box' => $this->translator->trans('Disallow stock helper.',[], 'Admin.Catalog.Help'),
            ]
        );


        $this->formBuilderModifier->addAfter(
            $descriptionTabFormBuilder,
            'disallow_stock',
            'universal',
            SwitchType::class,
            [
                'choices' => [
                    $this->translator->trans('No',[], 'Admin.Catalog.Feature') => 0,
                    $this->translator->trans('Yes',[], 'Admin.Catalog.Feature') => 1,
                ],
                'data' => $data['universal'] ,
                'placeholder' => false,
                'expanded' => true,
                'multiple' => false,
                'required' => false,
                'label' => $this->translator->trans('Universal?',[], 'Admin.Catalog.Feature'),
                'label_help_box' => $this->translator->trans('Universal?',[], 'Admin.Catalog.Help'),
            ]
        );
   


        // print ean btn
        $detailsTabFormBuilder = $productFormBuilder->get('details');

        $this->formBuilderModifier->addBefore(
            $detailsTabFormBuilder,
            'references',
            'print_ean',
            IconButtonType::class, 
            [
                'label' => $this->translator->trans('', [],'Modules.ASGroup.Admin'),
                'icon' => 'local_printshop',
                'attr' => [
                    'class' => 'btn-secondary print_ean_btn ml-auto',
                    'onclick' => 'generateEan()'
                ],
            ]
        );


        $this->formBuilderModifier->addAfter(
            $detailsTabFormBuilder,
            'references',
            'housing',
            TextType::class,
            [
                // you can remove the label if you dont need it by passing 'label' => false
                'label' => $this->translator->trans('Housing', [], 'Modules.ASGroup.Admin'),
                // customize label by any html attribute
                'label_attr' => [
                    'title' => 'h2',
                    'class' => 'text-info',
                ],
                'attr' => [
                    'placeholder' => $this->translator->trans('Housing', [], 'Modules.ASGroup.Admin'),
                    'class' => 'col-md-3',
                ],
                // this is just an example, but in real case scenario you could have some data provider class to wrap more complex cases
                'data' => $data['housing'] ,
                'empty_data' => '',
                'form_theme' => '@PrestaShop/Admin/TwigTemplateForm/prestashop_ui_kit_base.html.twig',
            ]
        );

        // verified dimensions

        $shippingTabFormBuilder = $productFormBuilder->get('shipping');

        // pre($shippingTabFormBuilder);

        $this->formBuilderModifier->addAfter(
            $shippingTabFormBuilder,
            'dimensions',
            'dim_verify',
            ChoiceType::class,
            [
                'choices' => [
                    $this->translator->trans('Yes',[], 'Admin.Catalog.Feature') => 1,
                    $this->translator->trans('No',[], 'Admin.Catalog.Feature') => 0,
                ],
                'data' => $data['dim_verify'] ,
                'placeholder' => false,
                'expanded' => true,
                'multiple' => false,
                'required' => false,
                'label' => $this->translator->trans('Verified Dimensions',[], 'Admin.Catalog.Feature'),
                'label_tag_name' => 'h3',
                'label_help_box' => $this->translator->trans('Display delivery time for a product is advised for merchants selling in Europe to comply with the local laws.',[], 'Admin.Catalog.Help'),
            ]
        );



        // add new tab for ukooo new
        $context = \Context::getContext();

        $productId = $data['productId'];
        
        $product = new \Product((int)$productId, true, $context->language->id, $context->shop->id);

        $this->formBuilderModifier->addAfter(
            $productFormBuilder,
            'options',
            'compats_car_custom_html',
            CustomTabType::class,
            [
                'label' => $this->moduleInstance->l('Compats Cars'),
                'data' => [
                    'id_product' => $productId,
                    'content' => $this->moduleInstance->getCompatsCars($product),
                ],
            ]
        );
    }
}
