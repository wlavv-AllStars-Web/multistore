<?php

class CatalogControllerCore extends FrontController{
    public $auth = true;
    public $authRedirection = 'my-account';
    public $php_self = 'catalog';

    public function initContent(){
        
        $temp_manufacturers = Manufacturer::getManufacturers(false, $this->context->language->id, true, false, false, false);

        $manufacturers = self::setUpdated($temp_manufacturers);

        $this->context->smarty->assign(
            
            array(
                'manufacturers' => $manufacturers
            )
            
        );
        
        parent::initContent();
        $this->setTemplate('catalog/custom-catalog.tpl');
    }
    

    public function setUpdated($manufacturers){
        
        $today = date('Y-m-d');

        foreach ($manufacturers As $manufacturer){

            $dates = [$manufacturer['xlsx_update'], $manufacturer['pictures_update'], $manufacturer['logos_update'], $manufacturer['facebook_update'], $manufacturer['site_update']];

            $mostRecent = $manufacturer['csv_update'];
            foreach($dates as $date){
                if ($date > $mostRecent) $mostRecent = $date;
            }

            $csv = date('Y-m-d', strtotime($manufacturer['csv_update'] . ' + 50 days'));
            $xlsx = date('Y-m-d', strtotime($manufacturer['xlsx_update'] . ' + 50 days'));
            $pictures = date('Y-m-d', strtotime($manufacturer['pictures_update'] . ' + 50 days'));
            $logos = date('Y-m-d', strtotime($manufacturer['logos_update'] . ' + 50 days'));
            $facebook = date('Y-m-d', strtotime($manufacturer['facebook_update'] . ' + 50 days'));
            $site = date('Y-m-d', strtotime($manufacturer['site_update'] . ' + 50 days'));
            $info = date('Y-m-d', strtotime($mostRecent . ' + 50 days'));
            $mostRecentTesteDate = date('Y-m-d', strtotime($mostRecent . ' + 50 days'));
            
            $csv_status =      $manufacturer['csv'];
            $xlsx_status =     $manufacturer['xlsx'];
            $pictures_status = $manufacturer['pictures'];
            $logos_status =    $manufacturer['logos'];
            $facebook_status = $manufacturer['facebook'];
            $site_status =     $manufacturer['site'];

            if($manufacturer['csv'] < 2)      $csv_status =      ($csv < $today) ? 0 : 1;     
            if($manufacturer['xlsx'] < 2)     $xlsx_status =     ($xlsx < $today) ? 0 : 1;      
            if($manufacturer['pictures'] < 2) $pictures_status = ($pictures < $today) ? 0 : 1;
            if($manufacturer['logos'] < 2)    $logos_status =    ($logos < $today) ? 0 : 1;      
            if($manufacturer['facebook'] < 2) $facebook_status = ($facebook < $today) ? 0 : 1;      
            if($manufacturer['site'] < 2)     $site_status =     ($site < $today) ? 0 : 1;      

            $info_status =     ($mostRecentTesteDate < $today) ? 0 : 1;      
            $sql = 'UPDATE '._DB_PREFIX_.'manufacturer SET csv=' . $csv_status . ', xlsx=' . $xlsx_status . ', pictures=' . $pictures_status . ', logos=' . $logos_status . ', info=' . $info_status . ', info_updated="' . $mostRecent . '", facebook="' . $facebook_status . '", site="' . $site_status . '" WHERE id_manufacturer=' . $manufacturer['id_manufacturer'];
            // echo $sql;
            // exit;
            Db::getInstance()->execute($sql);
        }
        
        return Manufacturer::getManufacturers(false, $this->context->language->id, true, false, false, false);

    }

}
