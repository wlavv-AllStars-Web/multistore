<?php

class hash
{
    public static function hash_form($order_id){
        $rand = rand();
        $push_data = array ( 'HASH'=>$rand,'ORDER_ID'=>$order_id);
        if (!isset($_SESSION['rand'])){
            $_SESSION['rand'] = array($push_data);
        }else{
            $valor_id=array_column($_SESSION['rand'], 'ORDER_ID');
            if ( (in_array($order_id,$valor_id))){
                    if(isset($_POST['order_id'])){
                        $order_idpost = $_POST['order_id'];
                    }else{
                        $order_idpost = null;
                    }
                    $clave = array_search($order_idpost, $valor_id);
                    $_SESSION['rand'][$clave]['HASH'] = $rand;
            }else{
                array_push($_SESSION['rand'],$push_data);
            }
        }
        return $rand;
    }
    public function validate_hash (){
        if (isset($_SESSION['rand'])) {
            $valor_id = array_column($_SESSION['rand'], 'ORDER_ID');
            $valor_hash = array_column($_SESSION['rand'], 'HASH');
        }

        if (isset($_POST['order_id']) && in_array($_POST['order_id'], $valor_id) && in_array($_POST['hash'], $valor_hash)) return true;
        else return false;
    }
}