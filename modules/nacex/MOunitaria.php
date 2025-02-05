<?php

class MOunitaria
{
    static function select_order($url){
        include_once dirname(__FILE__) . '/VIunitaria.php';
        $id_pedido = isset($_GET['pedido']) ? $_GET['pedido'] : $_GET['id_pedido'];
        $_query=Db::getInstance()->ExecuteS('SELECT * from ' . _DB_PREFIX_ . 'orders WHERE id_order =  ' . $id_pedido );

        $_viunitaria = new VIunitaria();
        $_return = $_viunitaria->table($_query, $url, $id_pedido);
        return $_return;
    }
    static function select_expedition($_id_order){
        $_query=Db::getInstance()->ExecuteS('SELECT * from ' . _DB_PREFIX_ . 'nacex_expediciones WHERE id_envio_order =  ' . $_id_order);
        return $_query;
    }
}