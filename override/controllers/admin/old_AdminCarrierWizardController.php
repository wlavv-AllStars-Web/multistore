<?php
class AdminCarrierWizardController extends AdminCarrierWizardControllerCore
{
    /*
    * module: totshippingpreview
    * date: 2024-12-06 09:17:54
    * version: 1.3.0
    */
    public function setMedia()
    {
        parent::setMedia();
        $this->addJqueryPlugin('smartWizard');
        $this->addJqueryPlugin('typewatch');
        if (version_compare(_PS_VERSION_, '1.6', '>')) {
            $this->addJs(_PS_JS_DIR_.'admin/carrier_wizard.js');
        } else {
            $this->addJs(_PS_JS_DIR_.'admin_carrier_wizard.js');
        }
    }
}
