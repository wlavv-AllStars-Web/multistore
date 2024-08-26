<?php
class WmModuleHomepageMain extends ObjectModel
{
    public static function getProducts($id_shop){
        return Db::getInstance()->executeS('SELECT * FROM '._DB_PREFIX_.'product AS p LEFT JOIN '._DB_PREFIX_.'product_shop AS ps ON p.id_product = ps.id_product WHERE id_product='.$id_shop.'');
    }

}
