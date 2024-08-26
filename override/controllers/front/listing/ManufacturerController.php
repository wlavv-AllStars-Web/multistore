<?php

class ManufacturerController extends ManufacturerControllerCore
{

    public function init()
    {
        if ($id_manufacturer = Tools::getValue('id_manufacturer')) {
            if($this->context->customer->isLogged()){
                $this->manufacturer = new Manufacturer((int) $id_manufacturer, $this->context->language->id);
    
                if (!Validate::isLoadedObject($this->manufacturer) || !$this->manufacturer->active || !$this->manufacturer->isAssociatedToShop()) {
                    $this->redirect_after = '404';
                    $this->redirect();
                } else {
                    $this->canonicalRedirection();
                }
            }else{
                Tools::redirect('index.php?controller=authentication?back=my-account');
            }

        }

        parent::init();
    }


    public function getTemplateVarManufacturers()
    {
        $manufacturers = Manufacturer::getManufacturers(true, $this->context->language->id);
        $manufacturers_for_display = [];

        foreach ($manufacturers as $manufacturer) {
            $manufacturers_for_display[$manufacturer['id_manufacturer']] = $manufacturer;
            $manufacturers_for_display[$manufacturer['id_manufacturer']]['text'] = $manufacturer['short_description'];
            $manufacturers_for_display[$manufacturer['id_manufacturer']]['image'] = $this->context->link->getManufacturerImageLink($manufacturer['id_manufacturer'], 'small_default');
            $manufacturers_for_display[$manufacturer['id_manufacturer']]['image_m'] = $this->context->link->getManufacturerImageLink($manufacturer['id_manufacturer'], 'medium_default');
            $manufacturers_for_display[$manufacturer['id_manufacturer']]['image_h'] = $this->context->link->getManufacturerImageLink($manufacturer['id_manufacturer'], 'home_default');
            $manufacturers_for_display[$manufacturer['id_manufacturer']]['url'] = $this->context->link->getManufacturerLink($manufacturer['id_manufacturer']);
            $manufacturers_for_display[$manufacturer['id_manufacturer']]['nb_products'] = $manufacturer['nb_products'] > 1 ? ($this->trans('%number% products', ['%number%' => $manufacturer['nb_products']], 'Shop.Theme.Catalog')) : $this->trans('%number% product', ['%number%' => $manufacturer['nb_products']], 'Shop.Theme.Catalog');
        }


        return $manufacturers_for_display;
    }
}