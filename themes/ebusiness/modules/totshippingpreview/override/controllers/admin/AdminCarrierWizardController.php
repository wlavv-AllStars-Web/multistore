<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to a commercial license from 202 ecommerce
 * Use, copy, modification or distribution of this source file without written
 * license agreement from 202 ecommerce is strictly forbidden.
 *
 * @author    202 ecommerce <contact@202-ecommerce.com>
 * @copyright Copyright (c) 202 ecommerce 2014
 * @license   Commercial license
 *
 * Support <support@202-ecommerce.com>
 */

class AdminCarrierWizardController extends AdminCarrierWizardControllerCore
{
    public function renderStepOne($carrier)
    {
        require_once(_PS_MODULE_DIR_.'/totshippingpreview/totshippingpreview.php');

        $totshippingpreview = new TotShippingPreview();
        
        $this->fields_form = array(
            'form' => array(
                'id_form' => 'step_carrier_general',
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Carrier name'),
                        'name' => 'name',
                        'required' => true,
                        'hint' => array(
                            sprintf($this->l('Allowed characters: letters, spaces and "%s".'), '().-'),
                            $this->l('The carrier\'s name will be displayed during checkout.'),
                            $this->l('For in-store pickup, enter 0 to replace the carrier name with your shop name.')
                        )
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Transit time'),
                        'name' => 'delay',
                        'lang' => true,
                        'required' => true,
                        'maxlength' => 128,
                        'hint' => $this->l('The estimated delivery time will be displayed during checkout.')
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Speed grade'),
                        'name' => 'grade',
                        'required' => false,
                        'size' => 1,
                        'hint' => $this->l('Enter "0" for a longest shipping delay, or "9" for the shortest shipping delay.')
                    ),
                    array(
                        'type' => 'logo',
                        'label' => $this->l('Logo'),
                        'name' => 'logo'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Tracking URL'),
                        'name' => 'url',
                        'hint' => $this->l('Delivery tracking URL: Type \'@\' where the tracking number should appear. It will be automatically replaced by the tracking number.'),
                        'desc' => $this->l('For example: \'http://exampl.com/track.php?num=@\' with \'@\' where the tracking number should appear.')
                    ),
                    array(
                        'type' => 'text',
                        'label' => $totshippingpreview->getOverrideText('min_label'),
                        'name' => 'mindays',
                        'hint' => $totshippingpreview->getOverrideText('min_hint'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $totshippingpreview->getOverrideText('max_label'),
                        'name' => 'maxdays',
                        'hint' => $totshippingpreview->getOverrideText('max_hint'),
                        'desc' => $totshippingpreview->getOverrideText('max_desc'),
                    ),
                )),
        );
        $tpl_vars = array('max_image_size' => (int)Configuration::get('PS_PRODUCT_PICTURE_MAX_SIZE') / 1024 / 1024);
        $fields_value = $this->getStepOneFieldsValues($carrier);
        return $this->renderGenericForm(array('form' => $this->fields_form), $fields_value, $tpl_vars);
    }

    public function getStepOneFieldsValues($carrier)
    {
        if (!is_null($carrier->id_reference)) {
            $sql = new DbQuery();
            $sql->select('*');
            $sql->from('totshippingpreview_carrier', 't');
            $sql->where('t.id_totshippingpreview_carrier = ' . $carrier->id_reference);
            $shipping_carrier = Db::getInstance()->getRow($sql);

            return array(
                'id_carrier' => $this->getFieldValue($carrier, 'id_carrier'),
                'name' => $this->getFieldValue($carrier, 'name'),
                'delay' => $this->getFieldValue($carrier, 'delay'),
                'grade' => $this->getFieldValue($carrier, 'grade'),
                'url' => $this->getFieldValue($carrier, 'url'),
                'mindays' => $shipping_carrier['mindays'],
                'maxdays' => $shipping_carrier['maxdays'],
            );
        }
    }

    public function setMedia($isNewTheme = false): void
    {
        parent::setMedia($isNewTheme);
        $this->addJqueryPlugin('smartWizard');
        $this->addJqueryPlugin('typewatch');
        $this->addJs(_PS_JS_DIR_ . 'admin/carrier_wizard.js');
    }
    

    public function getValidationRules()
    {
        $definition = parent::getValidationRules();

        $definition['fields']['mindays'] =  array('type' => Carrier::TYPE_INT, 'validate' => 'isUnsignedInt');
        $definition['fields']['maxdays'] =  array('type' => Carrier::TYPE_INT, 'validate' => 'isUnsignedInt');

        return $definition;
    }

    protected function _childValidation()
    {
        require_once(_PS_MODULE_DIR_.'/totshippingpreview/totshippingpreview.php');

        $mindays = (Tools::getValue('mindays')!=''?(int)Tools::getValue('mindays'):null);
        $maxdays = (Tools::getValue('maxdays')!=''?(int)Tools::getValue('maxdays'):null);
        
        if ((is_int($mindays) && is_int($maxdays)) && ($mindays > $maxdays)) {
            $totshippingpreview = new TotShippingPreview();
            
            $this->errors['maxdays'] = $totshippingpreview->getOverrideText('error');
        }
    }
}
