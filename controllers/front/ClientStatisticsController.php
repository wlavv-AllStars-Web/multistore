<?php

class ClientStatisticsControllerCore extends FrontController{

    public $auth = true;

    public $php_self = 'clientStatistics';

    public function initContent(){
        
        parent::initContent();
        
        $idCustomer = $this->context->customer->id;

        $date = date_create($this->context->customer->date_add);
        $clientSince = date_format($date, "Y-m-d");

        $numberOfOrders = self::getNumberOfOrders($idCustomer);
        $totalOfOrders = self::getTotalOfOrders($idCustomer);
        
        $average = $totalOfOrders / $numberOfOrders;

        $this->context->smarty->assign(array(
            'customer' => $this->context->customer,
            'company_name' => $this->context->customer->company,
            'defaultLanguage' => self::getDefaultLanguage(),
            'counters' => self::getCounters($idCustomer),
            'lastOrder' => self::lastOrder($idCustomer),
            'clientSince' => $clientSince,
            'numberAddresses' => self::getNumberAddresses($idCustomer),
            'numberOfOrders' => $numberOfOrders,
            'totalOfOrders' => $totalOfOrders,
            'average' => number_format($average, 2, ',', ''),
            'lastViewedProducts' => self::getLastViewedProducts(),
            'mostBoughtProducts' => self::getMostBoughtProducts($idCustomer),
            'orderByDateAndStatus' => self::getOrderByDateAndStatus($idCustomer),
            'bestSellers' => self::bestSellers(),
            'top' => self::getTop100()
        ));
        
        $this->setTemplate('customer/my-account');
    }


    public function getDefaultLanguage()
    {
        $defaultLanguageId = $this->context->customer->id_lang;
        
        switch($defaultLanguageId){
            case 1 : return 'English';
            case 2 : return 'Español';
            case 3 : return 'Français';
            case 4 : return 'Português';
            case 5 : return 'Română';
            default : return 'English';
        }

    }

    public function getCounters($idCustomer){
        
        $waiting_validation =  Db::getInstance()->getRow("SELECT count(current_state) AS waiting_validation FROM "._DB_PREFIX_."orders WHERE id_customer =" . $idCustomer . " AND current_state = 13");
        $waiting_payment =  Db::getInstance()->getRow("SELECT count(current_state) AS waiting_payment FROM "._DB_PREFIX_."orders WHERE id_customer =" . $idCustomer . " AND current_state = 14");
        $processing =  Db::getInstance()->getRow("SELECT count(current_state) AS processing FROM "._DB_PREFIX_."orders WHERE id_customer =" . $idCustomer . " AND current_state = 3");
        $backorders =  Db::getInstance()->getRow("SELECT count(current_state) AS backorders FROM "._DB_PREFIX_."orders WHERE id_customer =" . $idCustomer . " AND current_state = 9");
        $shipped =  Db::getInstance()->getRow("SELECT count(current_state) AS shipped FROM "._DB_PREFIX_."orders WHERE id_customer =" . $idCustomer . " AND current_state = 4");
        $canceled =  Db::getInstance()->getRow("SELECT count(current_state) AS canceled FROM "._DB_PREFIX_."orders WHERE id_customer =" . $idCustomer . " AND current_state = 6");
        
        $orders['waiting_validation'] = $waiting_validation['waiting_validation'];
        $orders['waiting_payment']    = $waiting_payment['waiting_payment'];
        $orders['processing']         = $processing['processing'];
        $orders['backorders']         = $backorders['backorders'];
        $orders['shipped']            = $shipped['shipped'];
        $orders['canceled']           = $canceled['canceled'];
        
        return $orders;
    }

    public function getOrderByDateAndStatus($idCustomer){
        
        $current_date = date('Y-m-d');
        
        $month = '';
        $status_array = ["Waiting validation", "Waiting payment", "Preparation in progress", "Backorders", "Shipped", "Canceled", "Payment accepted", "Refunded", "Delivered"];
        $status = '"Waiting validation", "Waiting payment", "Preparation in progress", "Backorders", "Shipped", "Canceled", "Payment accepted", "Refunded", "Delivered"';
        
        
        $waiting_validation_string = '';
        $waiting_payment_string = '';
        $processing_string = '';
        $backorders_string = '';
        $shipped_string = '';
        $canceled_string = '';
        $accepted_string = '';
        $refunded_string = '';
        $delivered_string = '';
        $colors = '';
        
        $order_by_month = array();
        
        $colors[]= '#000000';
        $colors[]= '#4258a7';
        $colors[]= '#048dcd';
        $colors[]= '#f78e1f';
        $colors[]= 'BlueViolet';
        $colors[]= '#e82025';
        $colors[]= '#00644a';
        $colors[]= '#7e63ab';
        $colors[]= '#8cc747';

        
        for($i = 1; $i < 13; $i++){
            $month .= '"' . date("M",strtotime($current_date . ' -' . $i . ' month')) . '"';

            if($i < 12){
                $month.= ', ';     
            }
        }
        
        for($i = 1; $i < 13; $i++){
            
            $unixdateLower = strtotime($current_date . ' -' . ($i+1) . ' month');
            $unixdateUpper = strtotime($current_date . ' -' . $i . ' month');
            
            $lower = date('Y-m-d', $unixdateLower);
            $upper = date('Y-m-d', $unixdateUpper);

            $waiting_validation =  Db::getInstance()->getRow("SELECT count(id_order_state) AS waiting_validation FROM psnz_order_history LEFT JOIN psnz_orders ON psnz_order_history.id_order = psnz_orders.id_order WHERE psnz_orders.id_customer =" . $idCustomer . " AND psnz_order_history.id_order_state = 15" . " AND psnz_order_history.date_add > '" . $lower . "' AND psnz_order_history.date_add < '" . $upper . "'");
            $waiting_payment =  Db::getInstance()->getRow("SELECT count(id_order_state) AS waiting_payment FROM psnz_order_history LEFT JOIN psnz_orders ON psnz_order_history.id_order = psnz_orders.id_order WHERE psnz_orders.id_customer =" . $idCustomer . " AND psnz_order_history.id_order_state = 10" . " AND psnz_order_history.date_add > '" . $lower . "' AND psnz_order_history.date_add < '" . $upper . "'");
            $processing =  Db::getInstance()->getRow("SELECT count(id_order_state) AS processing FROM psnz_order_history LEFT JOIN psnz_orders ON psnz_order_history.id_order = psnz_orders.id_order WHERE psnz_orders.id_customer =" . $idCustomer . " AND psnz_order_history.id_order_state = 3" . " AND psnz_order_history.date_add > '" . $lower . "' AND psnz_order_history.date_add < '" . $upper . "'");
            $backorders =  Db::getInstance()->getRow("SELECT count(id_order_state) AS backorders FROM psnz_order_history LEFT JOIN psnz_orders ON psnz_order_history.id_order = psnz_orders.id_order WHERE psnz_orders.id_customer =" . $idCustomer . " AND psnz_order_history.id_order_state = 9" . " AND psnz_order_history.date_add > '" . $lower . "' AND psnz_order_history.date_add < '" . $upper . "'");
            $shipped =  Db::getInstance()->getRow("SELECT count(id_order_state) AS shipped FROM psnz_order_history LEFT JOIN psnz_orders ON psnz_order_history.id_order = psnz_orders.id_order WHERE psnz_orders.id_customer =" . $idCustomer . " AND psnz_order_history.id_order_state = 4" . " AND psnz_order_history.date_add > '" . $lower . "' AND psnz_order_history.date_add < '" . $upper . "'");
            $canceled =  Db::getInstance()->getRow("SELECT count(id_order_state) AS canceled FROM psnz_order_history LEFT JOIN psnz_orders ON psnz_order_history.id_order = psnz_orders.id_order WHERE psnz_orders.id_customer =" . $idCustomer . " AND psnz_order_history.id_order_state = 6" . " AND psnz_order_history.date_add > '" . $lower . "' AND psnz_order_history.date_add < '" . $upper . "'");
            $accepted =  Db::getInstance()->getRow("SELECT count(id_order_state) AS accepted FROM psnz_order_history LEFT JOIN psnz_orders ON psnz_order_history.id_order = psnz_orders.id_order WHERE psnz_orders.id_customer =" . $idCustomer . " AND psnz_order_history.id_order_state = 2" . " AND psnz_order_history.date_add > '" . $lower . "' AND psnz_order_history.date_add < '" . $upper . "'");
            $refunded =  Db::getInstance()->getRow("SELECT count(id_order_state) AS refunded FROM psnz_order_history LEFT JOIN psnz_orders ON psnz_order_history.id_order = psnz_orders.id_order WHERE psnz_orders.id_customer =" . $idCustomer . " AND psnz_order_history.id_order_state = 7" . " AND psnz_order_history.date_add > '" . $lower . "' AND psnz_order_history.date_add < '" . $upper . "'");
            $delivered =  Db::getInstance()->getRow("SELECT count(id_order_state) AS delivered FROM psnz_order_history LEFT JOIN psnz_orders ON psnz_order_history.id_order = psnz_orders.id_order WHERE psnz_orders.id_customer =" . $idCustomer . " AND psnz_order_history.id_order_state = 5" . " AND psnz_order_history.date_add > '" . $lower . "' AND psnz_order_history.date_add < '" . $upper . "'");

            $waiting_validation_string .= $waiting_validation['waiting_validation'];
            $waiting_payment_string .= $waiting_payment['waiting_payment'];
            $processing_string .= $processing['processing'];
            $backorders_string .= $backorders['backorders'];
            $shipped_string .= $shipped['shipped'];
            $canceled_string .= $canceled['canceled'];
            $accepted_string .= $accepted['accepted'];
            $refunded_string .= $refunded['refunded'];
            $delivered_string .= $delivered['delivered'];
        
            if($i < 12) {
                $waiting_validation_string.= ', ';  
                $waiting_payment_string.= ', ';  
                $processing_string.= ', ';  
                $backorders_string.= ', ';  
                $shipped_string.= ', ';  
                $canceled_string.= ', ';  
                $accepted_string.= ', ';  
                $refunded_string.= ', ';  
                $delivered_string.= ', ';  
            }

        }
        
        return [ 
            $waiting_validation_string, 
            $waiting_payment_string, 
            $processing_string, 
            $backorders_string, 
            $shipped_string, 
            $canceled_string,
            $accepted_string,
            $refunded_string,
            $delivered_string,
            'colors' => $colors,
            'months' => $month,
            'status' => $status,
            'status_array' => $status_array
        ];
    }

    public function lastOrder($idCustomer){
        
        $order =  Db::getInstance()->getRow("SELECT date_add FROM psnz_orders WHERE id_customer =" . $idCustomer . " ORDER BY id_order DESC");
        
        $date = date_create($order['date_add']);
        return date_format($date, "Y-m-d");
    }

    public function getNumberOfOrders($idCustomer){
        
        $orders =  Db::getInstance()->getRow("SELECT count(*) AS total FROM psnz_orders WHERE id_customer =" . $idCustomer);
        return $orders['total'];
    }

    public function getTotalOfOrders($idCustomer){
        
        $orders =  Db::getInstance()->getRow("SELECT sum(total_paid) AS total FROM psnz_orders WHERE id_customer =" . $idCustomer . " AND current_state IN (2, 3, 4, 5, 9, 10, 15)");
        return number_format($orders['total'], 2, ',', '');
    }

    public function getNumberAddresses($idCustomer){
        $addresses =  Db::getInstance()->getRow("SELECT count(*) total FROM psnz_address WHERE id_customer =" . $idCustomer . " AND deleted=0");
        return $addresses['total'];
    }

    public function getLastViewedProducts(){


        $ids_viewed_products = explode(',', $this->context->cookie->viewed);
        $unique = array_unique($ids_viewed_products);
        $reversed = array_reverse($unique);
        $last_viewed_ids = array_slice($reversed, 0, 6);

        $products = array();
        foreach($last_viewed_ids AS $id){
            
            $sql = "SELECT psnz_manufacturer.name AS brand, psnz_product_lang.name AS name, psnz_product.reference, psnz_product.id_product AS id_product, psnz_product_lang.description_short AS description_short, psnz_manufacturer.id_manufacturer AS id_manufacturer
                    FROM psnz_product
                    LEFT JOIN psnz_product_lang
                    ON psnz_product_lang.id_product = psnz_product.id_product 
                    LEFT JOIN psnz_manufacturer
                    ON psnz_manufacturer.id_manufacturer = psnz_product.id_manufacturer 
                    WHERE psnz_product.id_product =" . $id . " AND psnz_product_lang.id_lang = ". $this->context->language->id;
            
            $products[] = Db::getInstance()->getRow($sql);

        }
        return $products;
    }

    public function getMostBoughtProducts($idCustomer){
        
        $sql = "SELECT sum(product_quantity) AS number,psnz_manufacturer.name AS brand, psnz_manufacturer.id_manufacturer AS id_manufacturer, psnz_product_lang.name AS name, psnz_product.reference, psnz_order_detail.product_id AS id_product, psnz_product_lang.description_short AS description_short
            FROM psnz_orders
            LEFT JOIN psnz_order_detail
            ON psnz_orders.id_order = psnz_order_detail.id_order
            LEFT JOIN psnz_product
            ON psnz_order_detail.product_id = psnz_product.id_product
            LEFT JOIN psnz_product_lang
            ON psnz_product_lang.id_product = psnz_product.id_product 
            LEFT JOIN psnz_manufacturer
            ON psnz_manufacturer.id_manufacturer = psnz_product.id_manufacturer 
            WHERE psnz_orders.id_customer =" . $idCustomer . " AND psnz_product_lang.id_lang = ". $this->context->language->id . " GROUP BY psnz_order_detail.product_id ORDER BY number DESC 
            LIMIT 6";

        return Db::getInstance()->executeS($sql);
    }
    
    function random_color() { return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT); }
    
    function random_hexcolor() {
        return '#' . self::random_color() . self::random_color() . self::random_color();
    }

    public function bestSellers(){
        
        $bestseller = '';
        $bestsellerReference= '';

        $sql = "SELECT sum(product_quantity) AS product_quantity, product_reference
            FROM psnz_order_detail
            WHERE id_order > 0
            AND product_reference NOT LIKE 'SHIPPING-%'
            GROUP BY product_id
            ORDER BY product_quantity DESC
            LIMIT 12";

        $products = Db::getInstance()->executeS($sql);
        
        foreach($products AS $i => $product){
            
            $bestsellerReference.= '"' . $product['product_reference'] . '"';
            $bestseller.= '"' . $product['product_quantity'] . '"';

            if($i < 11){
                $bestsellerReference.= ', '; 
                $bestseller.= ', '; 
            }
        }
        
        return [ 'colors' => '"' . self::random_hexcolor() . '"', 'references' => $bestsellerReference, 'values' => $bestseller ];
    }

    public function getTop100(){
        
        $top = [];

        $sql = "SELECT sum(product_quantity) AS product_quantity, product_reference, product_id
            FROM psnz_order_detail
            WHERE id_order > 0
            GROUP BY product_id
            ORDER BY product_quantity DESC
            LIMIT 100";

        $products = Db::getInstance()->executeS($sql);
        
        foreach($products AS $i => $product){
            $top[]= ['reference' => $product['product_reference'], 'id_product' => $product['product_id']];
        }
        
        $top = array_chunk( $top , 33 ,true);
        
        return ['top1' => $top[0], 'top2' => $top[1], 'top3' => $top[2]];
    }
    
}
