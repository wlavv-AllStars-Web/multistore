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
use PrestaShop\PrestaShop\Core\ConstraintValidator\Constraints\TypedRegex;
use Symfony\Component\Validator\Constraints\Length;
use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\Reference;
use PrestaShopBundle\Form\Admin\Type\IconButtonType;

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
    }



    /**
     * @param ProductId|null $productId
     * @param FormBuilderInterface $productFormBuilder
     */
    public function modify(
        ?ProductId $productId,
        FormBuilderInterface $productFormBuilder
    ): void {
        $idWkProduct = $productId->getValue();

        $sql = 'SELECT youtube_code
        FROM
        `' . _DB_PREFIX_ . 'product` 
        WHERE id_product= '.$idWkProduct;

        $result = Db::getInstance()->getValue($sql);

        // $data['youtube_code'] = Configuration::get('youtube_code' . $idWkProduct);
        $data['youtube_code'] = $result;
        
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
        $this->formBuilderModifier->addAfter(
            $descriptionTabFormBuilder,
            'description',
            'youtube_code',
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
                ],
                // this is just an example, but in real case scenario you could have some data provider class to wrap more complex cases
                'data' => $data['youtube_code'] ,
                'empty_data' => '',
                'form_theme' => '@PrestaShop/Admin/TwigTemplateForm/prestashop_ui_kit_base.html.twig',
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
                    'class' => 'btn-primary print_ean_btn ml-auto',
                    'onclick' => 'generateEan()'
                ],
            ]
        );


// custom ean input on tab details


        // tab combinations ean

        // $combinationsTabFormBuilder = $productFormBuilder->get('combinations');

        // $this->formBuilderModifier->addAfter(
        //     $combinationsTabFormBuilder,
        //     'name',  // You can also add it after any other existing field
        //     'ean13',   // New field name
        //     TextType::class,
        //     [
        //         'label' => $this->translator->trans('Custom EAN-13',[], 'Modules.ASGroup.Admin'),
        //         'label_attr' => [
        //             'title' => 'h2',
        //             'class' => 'text-info',
        //         ],
        //         'attr' => [
        //             'placeholder' => $this->translator->trans('Enter EAN-13 code', [], 'Modules.ASGroup.Admin'),
        //         ],
        //         'constraints' => [
        //             new TypedRegex(TypedRegex::TYPE_EAN_13),
        //             new Length(['max' => 13]),
        //         ],
        //         'data' => $data['ean13'] ?? '',
        //         'empty_data' => '',
        //         'form_theme' => '@PrestaShop/Admin/TwigTemplateForm/prestashop_ui_kit_base.html.twig',
        //     ]
        // );
    }
}
