<?php

class MyCarsControllerCore extends FrontController
{
    public $auth=true;
    public $authRedirection = 'my-account';
    public $php_self = 'my-cars';

    public function initContent()
    {
        parent::initContent();

        
        if(Tools::getValue('deleteCarGarage')){

            $id_compat = Tools::getValue('id_compat');
            $id_customer = Tools::getValue('id_customer');
            $iso_code = Tools::getValue('iso_code');
            $key = 'UMb85YcQcDKQK021JKLAMM5yJ9pCgt';
            $shop_id = $this->context->shop->id; 

            $url = 'https://webtools.all-stars-motorsport.com/api/remove/car/'.$id_customer.'/'.$id_compat.'/'.$shop_id.'/'.$key;
            // pre($url);
    
            // Initialize cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
    
            // Execute cURL request
            $json = curl_exec($ch);
            curl_close($ch);
    
            // Decode the response into an associative array
            $my_cars = json_decode($json, true);
    
            pre($my_cars);
    
            $this->context->smarty->assign('myCars', $my_cars);
            $this->setTemplate('customer/my-cars');
            
        // }elseif(Tools::getValue('getUnsubscribeEmail') == 1){
            
        //     $this->setTemplate(_PS_THEME_DIR_.'getEmailToUnsubscribe.tpl');
            
        // }elseif(Tools::getValue('unsubscribe') == 1){
            
        //     $my_cars = Db::getInstance()->executes("UPDATE "._DB_PREFIX_."asm_ukoo_customer SET newsletter=0 WHERE email='" . Tools::getValue('email') . "'");
        //     $my_cars = Db::getInstance()->executes("SELECT * FROM "._DB_PREFIX_."asm_ukoo_customer WHERE email = '" . $this->context->customer->email . "'");
        //     $this->context->smarty->assign('email', Tools::getValue('email'));
        //     $this->context->smarty->assign('unsubscribeMessage', 1);
        //     $this->context->smarty->assign('myCars', $my_cars);
        //     $this->setTemplate(_PS_THEME_DIR_.'my-cars.tpl');

        // }elseif(Tools::getValue('getEmails') == 1){

        //     $car = Db::getInstance()->executes("SELECT * FROM "._DB_PREFIX_."asm_ukoo_customer WHERE id_brand = " . Tools::getValue('id_brand') . " AND id_model=" . Tools::getValue('id_model') . " AND id_type=" . Tools::getValue('id_type') . " AND id_version=" . Tools::getValue('id_version') . ' LIMIT 1');
        //     $emails = Db::getInstance()->executes("SELECT email FROM "._DB_PREFIX_."asm_ukoo_customer WHERE id_brand = " . Tools::getValue('id_brand') . " AND id_model=" . Tools::getValue('id_model') . " AND id_type=" . Tools::getValue('id_type') . " AND id_version=" . Tools::getValue('id_version'));

        //     $car_string = $car[0]['brand'] . ' | ' . $car[0]['model'] . ' | ' . $car[0]['version'] . ' | ' . $car[0]['type'];
        //     $id_brand = $car[0]['id_brand'];
        //     $id_type = $car[0]['id_type'];
        //     $string = '';
            
        //     foreach( $emails AS $email) $string .= $email['email'] . ';';
    
        //     $array = ['id_brand' => $id_brand, 'id_type' => $id_type, 'emails' => $emails, 'car_string' => $car_string];
    
        //     return $array;
            
        }else{
                    // https://webtools.all-stars-motorsport.com/api/add/car/{id_customer}/{id_compat}/{iso_code}/{store}/{token}
        // pre(Tools::getAllValues());

        $id_compat = Tools::getValue('id_compat');
        $id_customer = $this->context->customer->id;
        $iso_code = Tools::getValue('iso_code');
        $key = 'UMb85YcQcDKQK021JKLAMM5yJ9pCgt';
        $shop_id = $this->context->shop->id; 

        $url = 'https://webtools.all-stars-motorsport.com/api/get/cars/'.$id_customer.'/'.$shop_id.'/'.$key;
        // pre($url);

        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);

        // Execute cURL request
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode the response into an associative array
        $my_cars = json_decode($json, true);

        // pre($my_cars);

        $this->context->smarty->assign('myCars', $my_cars);
        $this->setTemplate('customer/my-cars');
            
        }
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        $breadcrumb['links'][] = [
            'title' => $this->trans('My Cars', [], 'Shop.Theme.MyCars'),
            'url' => $this->context->link->getPageLink('my-cars'),
        ];

        return $breadcrumb;
    }
    
}
