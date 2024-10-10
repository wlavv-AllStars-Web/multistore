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
                'label' => $this->translator->trans('Youtube Code', [], 'Modules.WkDemo.Admin'),
                // customize label by any html attribute
                'label_attr' => [
                    'title' => 'h2',
                    'class' => 'text-info',
                ],
                'attr' => [
                    'placeholder' => $this->translator->trans('Your youtube code here', [], 'Modules.WkDemo.Admin'),
                ],
                // this is just an example, but in real case scenario you could have some data provider class to wrap more complex cases
                'data' => $data['youtube_code'] ,
                'empty_data' => '',
                'form_theme' => '@PrestaShop/Admin/TwigTemplateForm/prestashop_ui_kit_base.html.twig',
            ]
        );
        // $pricingTabFormBuilder = $productFormBuilder->get('pricing');
        // $this->formBuilderModifier->addAfter(
        //     $pricingTabFormBuilder,
        //     'wholesale_price',
        //     'demo_module_pricing_field',
        //     TextType::class,
        //     [
        //         // you can remove the label if you dont need it by passing 'label' => false
        //         'label' => $this->translator->trans('Extra price for demo', [], 'Modules.WkDemo.Admin'),
        //         // customize label by any html attribute
        //         'label_attr' => [
        //             'title' => 'h2',
        //             'class' => 'text-info',
        //         ],
        //         'attr' => [
        //             'placeholder' => $this->translator->trans('0', [], 'Modules.WkDemo.Admin'),
        //         ],
        //         // this is just an example, but in real case scenario you could have some data provider class to wrap more complex cases
        //         'data' => $data['price'],
        //         'empty_data' => '',
        //         'form_theme' => '@PrestaShop/Admin/TwigTemplateForm/prestashop_ui_kit_base.html.twig',
        //     ]
        // );
    }
}
