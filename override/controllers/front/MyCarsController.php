<?php

class MyCarsControllerCore extends FrontController
{
    public $auth=true;
    public $authRedirection = 'my-account';
    public $php_self = 'my-cars';

    public function initContent()
    {
        parent::initContent();
        
        if(Tools::getValue('delete') == true){
            

            $my_cars = Db::getInstance()->executes("DELETE FROM "._DB_PREFIX_."ASM_ukoo_customer WHERE id = " . Tools::getValue('id'));
            
            $my_cars = Db::getInstance()->executes("Select * FROM "._DB_PREFIX_."ASM_ukoo_customer WHERE email = '" . $this->context->customer->email . "'");
            $this->context->smarty->assign('myCars', $my_cars);
            $this->setTemplate(_PS_THEME_DIR_.'my-cars.tpl');
            
        }elseif(Tools::getValue('getUnsubscribeEmail') == 1){
            
            $this->setTemplate(_PS_THEME_DIR_.'getEmailToUnsubscribe.tpl');
            
        }elseif(Tools::getValue('unsubscribe') == 1){
            
            $my_cars = Db::getInstance()->executes("UPDATE "._DB_PREFIX_."ASM_ukoo_customer SET newsletter=0 WHERE email='" . Tools::getValue('email') . "'");
            $my_cars = Db::getInstance()->executes("Select * FROM "._DB_PREFIX_."ASM_ukoo_customer WHERE email = '" . $this->context->customer->email . "'");
            $this->context->smarty->assign('email', Tools::getValue('email'));
            $this->context->smarty->assign('unsubscribeMessage', 1);
            $this->context->smarty->assign('myCars', $my_cars);
            $this->setTemplate(_PS_THEME_DIR_.'my-cars.tpl');

        }elseif(Tools::getValue('getEmails') == 1){

            $car = Db::getInstance()->executes("Select * FROM "._DB_PREFIX_."ASM_ukoo_customer WHERE id_brand = " . Tools::getValue('id_brand') . " AND id_model=" . Tools::getValue('id_model') . " AND id_type=" . Tools::getValue('id_type') . " AND id_version=" . Tools::getValue('id_version') . ' LIMIT 1');
            $emails = Db::getInstance()->executes("Select email FROM "._DB_PREFIX_."ASM_ukoo_customer WHERE id_brand = " . Tools::getValue('id_brand') . " AND id_model=" . Tools::getValue('id_model') . " AND id_type=" . Tools::getValue('id_type') . " AND id_version=" . Tools::getValue('id_version'));

            $car_string = $car[0]['brand'] . ' | ' . $car[0]['model'] . ' | ' . $car[0]['version'] . ' | ' . $car[0]['type'];
            $id_brand = $car[0]['id_brand'];
            $id_type = $car[0]['id_type'];
            $string = '';
            
            foreach( $emails AS $email) $string .= $email['email'] . ';';
    
            $array = ['id_brand' => $id_brand, 'id_type' => $id_type, 'emails' => $emails, 'car_string' => $car_string];
    
            return $array;
            
        }else{
            $my_cars = Db::getInstance()->executes("Select * FROM "._DB_PREFIX_."ASM_ukoo_customer WHERE email = '" . $this->context->customer->email . "'");
            $this->context->smarty->assign('myCars', $my_cars);
            $this->setTemplate('customer/my-cars');
            
        }
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        $breadcrumb['links'][] = $this->addMyAccountToBreadcrumb();

        $breadcrumb['links'][] = [
            'title' => $this->trans('My cars', [], 'Shop.Theme.Customeraccount'),
            'url' => $this->context->link->getPageLink('my-cars'),
        ];

        return $breadcrumb;
    }
    
}
