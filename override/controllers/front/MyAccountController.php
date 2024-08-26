<?php

use PrestaShop\PrestaShop\Adapter\Presenter\Order\OrderPresenter;
class MyAccountController extends MyAccountControllerCore
{
    public $auth = true;
    public $php_self = 'my-account';
    public $authRedirection = 'my-account';
    // public $ssl = true;
    // public function setMedia()
    // {
    //     parent::setMedia();
    //     // $this->addCSS(_THEME_CSS_DIR_.'my-account.css');
    //     $this->addJS('https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js');
    // }


    public $order_presenter;
    protected $customer;

    public function init()
    {
        parent::init();
        $this->customer = $this->context->customer;
    }


    public function postProcess(){
        $origin_newsletter = (bool)$this->customer->newsletter;
        
        if(Tools::getValue('action') == 'check_vat'){
            $has_address = $this->context->customer->getAddresses($this->context->language->id);
            $country = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS("SELECT iso_code FROM ". _DB_PREFIX_ ."country WHERE id_country=" . $has_address[0]['id_country'] . " Limit 1 ");

            $iso_code = $country[0]['iso_code'];
            
            $vat_iso_code = substr(Tools::getValue('vatnumber',0), 0, 2);;
    
            $vat_iso_code = ($vat_iso_code == 'GR') ? 'EL' : $vat_iso_code;
            $iso_code = ($iso_code == 'GR') ? 'EL' : $iso_code;

            echo ($vat_iso_code != $iso_code) ? 0 : 1;
            exit;
        }

        if (Tools::isSubmit('updatenotification')) {
            $this->_updatenotification();
        }

        if (Tools::isSubmit('submitIdentity')) {
            
            $email = trim(Tools::getValue('email'));
            

            if (Tools::getValue('months') != '' && Tools::getValue('days') != '' && Tools::getValue('years') != '') {
                $this->customer->birthday = (int)Tools::getValue('years').'-'.(int)Tools::getValue('months').'-'.(int)Tools::getValue('days');
            } elseif (Tools::getValue('months') == '' && Tools::getValue('days') == '' && Tools::getValue('years') == '') {
                $this->customer->birthday = null;
            } else {
                $this->errors[] = Tools::displayError('Invalid date of birth.');
            }

            if (Tools::getIsset('old_passwd')) {
                $old_passwd = trim(Tools::getValue('old_passwd'));
            }
            // echo $this->context->cookie->passwd;
            // exit;
            if (!Validate::isEmail($email)) {
                $this->errors[] = Tools::displayError('This email address is not valid');
            } elseif ($this->customer->email != $email && Customer::customerExists($email, true)) {
                $this->errors[] = Tools::displayError('An account using this email address has already been registered.');
            } elseif (!$old_passwd || !password_verify($old_passwd, $this->context->cookie->passwd)) {
                $this->errors[] = Tools::displayError('The password you entered is incorrect.');
            } elseif (Tools::getValue('passwd') != Tools::getValue('confirmation')) {
                $this->errors[] = Tools::displayError('The password and confirmation do not match.');
            } else {
                $prev_id_default_group = $this->customer->id_default_group;

                // Merge all errors of this file and of the Object Model
                $this->errors = array_merge($this->errors, $this->customer->validateController());
            }

            if (!count($this->errors)) {
                $this->customer->id_default_group = (int)$prev_id_default_group;
                $this->customer->firstname = Tools::ucwords($this->customer->firstname);

                if (Configuration::get('PS_B2B_ENABLE')) {
                    $this->customer->website = Tools::getValue('website'); // force update of website, even if box is empty, this allows user to remove the website
                    $this->customer->company = Tools::getValue('company');
                }

                if (!Tools::getIsset('newsletter')) {
                    $this->customer->newsletter = 0;
                } elseif (!$origin_newsletter && Tools::getIsset('newsletter')) {
                    if ($module_newsletter = Module::getInstanceByName('blocknewsletter')) {
                        /** @var Blocknewsletter $module_newsletter */
                        if ($module_newsletter->active) {
                            $module_newsletter->confirmSubscription($this->customer->email);
                        }
                    }
                }

                if (!Tools::getIsset('optin')) {
                    $this->customer->optin = 0;
                }
                
                if (Tools::getValue('passwd')) {
                    $this->context->cookie->passwd = $this->customer->passwd;
                }

                if ($this->customer->update()) {
                    $this->context->cookie->customer_lastname = $this->customer->lastname;
                    $this->context->cookie->customer_firstname = $this->customer->firstname;
                    $this->context->smarty->assign('confirmation', 1);
                } else {
                    $this->errors[] = Tools::displayError('The information cannot be updated.');
                }
            }
        } else {
            $_POST = array_map('stripslashes', $this->customer->getFields());
        }

        return $this->customer;
    }

    public function initContent()
    {

        parent::initContent();

        $shipping = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS("SELECT * FROM ". _DB_PREFIX_ ."distribution_shipping LEFT JOIN ". _DB_PREFIX_ ."country_lang ON ". _DB_PREFIX_ ."distribution_shipping.id_country = ". _DB_PREFIX_ ."country_lang.id_country AND ". _DB_PREFIX_ ."country_lang.id_lang = " . $this->context->language->id . " WHERE deleted = 0 AND status = 1 ORDER BY country ASC");

        $idCustomer = $this->context->customer->id;
// paulo
        $date = date_create($this->context->customer->date_add);
        $clientSince = date_format($date, "Y-m-d");

        $numberOfOrders = self::getNumberOfOrders($idCustomer);
        $totalOfOrders = self::getTotalOfOrders($idCustomer);
        // echo $numberOfOrders;
        // echo $totalOfOrders;

        if($numberOfOrders > 0) {
            $average = $totalOfOrders / $numberOfOrders;
        }

        if ($this->context->customer->birthday) {
            $birthday = explode('-', $this->context->customer->birthday);
        } else {
            $birthday = array('-', '-', '-');
        }

        /* Generate years, months and days */
        $this->context->smarty->assign(array(
            'has_customer_an_address' => empty($has_address),
            'years' => Tools::dateYears(),
            'sl_year' => $birthday[0],
            'months' => Tools::dateMonths(),
            'sl_month' => $birthday[1],
            'days' => Tools::dateDays(),
            'sl_day' => $birthday[2],
            'errors' => $this->errors,
            'genders' => Gender::getGenders(),
        ));

        // Call a hook to display more information
        $this->context->smarty->assign(array(
            'HOOK_CUSTOMER_IDENTITY_FORM' => Hook::exec('displayCustomerIdentityForm'),
        ));

        $newsletter = Configuration::get('PS_CUSTOMER_NWSL') || (Module::isInstalled('blocknewsletter') && Module::getInstanceByName('blocknewsletter')->active);
        $this->context->smarty->assign('newsletter', $newsletter);
        $this->context->smarty->assign('optin', (bool)Configuration::get('PS_CUSTOMER_OPTIN'));

        $this->context->smarty->assign('field_required', $this->context->customer->validateFieldsRequiredDatabase());
// --->

        if ($this->order_presenter === null) {
            $this->order_presenter = new OrderPresenter();
        }

        $has_address = $this->context->customer->getAddresses($this->context->language->id);
        $this->context->smarty->assign(array(
            'shipping' => $shipping,
            'has_customer_an_address' => empty($has_address),
            'voucherAllowed' => (int)CartRule::isFeatureActive(),
            'returnAllowed' => (int)Configuration::get('PS_ORDER_RETURN'),
            'lastYearOrdersMonth' => array_reverse(self::lastYearOrders($idCustomer)['month']),
            'lastYearOrdersTotal' => array_reverse(self::lastYearOrders($idCustomer)['total']),
            'lastYearOrdersColor' => self::random_hexcolor(),
            'ordersByBrand' => self::ordersByBrand($idCustomer),
            'ordersByBrandColors' => self::lastYearOrders($idCustomer)['colors'],
            'ordersByBrandBrands' => self::lastYearOrders($idCustomer)['brands'],
            // 'showNotificationBall' => self::verifyLastNotification(),

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
            'top' => self::getTop100(),
            'messages' => self::getNotifications()
        ));

        // echo '<pre>'. print_r(self::ordersByBrand($idCustomer)['brands'],1) .'</pre>';
        // exit;
        // echo '<pre>'.print_r($this->getTemplateVarOrders(),1).'</pre>';
        // exit;

        $this->context->smarty->assign([
            'orders' => $this->getTemplateVarOrders(),
        ]);

        // echo  _PS_THEME_DIR_;
        // exit;
        $this->context->smarty->assign('HOOK_CUSTOMER_ACCOUNT', Hook::exec('displayCustomerAccount'));
        $this->setTemplate('customer/my-account');

    
    }

    public function getTemplateVarOrders()
    {
        $orders = [];
        $customer_orders = Order::getCustomerOrders($this->context->customer->id);
        foreach ($customer_orders as $customer_order) {
            $order = new Order((int) $customer_order['id_order']);
            $orders[$customer_order['id_order']] = $this->order_presenter->present($order);
        }

        return $orders;
    }


    public function lastYearOrders($idCustomer)
    {
        
        $current_date = date('Y-m-d');
        $month = '';
        $byMonth = '';

        for($i = 0; $i < 13; $i++){
            
            if($i == 0){
                $unixdateLower = strtotime($current_date . ' -1 month');
                $unixdateUpper = strtotime($current_date);
            }else{
                $unixdateLower = strtotime($current_date . ' -' . ($i+1) . ' month');
                $unixdateUpper = strtotime($current_date . ' -' . $i . ' month');
            }

            $lower = date('Y-m-d', $unixdateLower);
            $upper = date('Y-m-d', $unixdateUpper);

            $orders =  Db::getInstance()->getRow("SELECT sum(total_paid) AS total FROM ". _DB_PREFIX_ ."orders WHERE id_customer =" . $idCustomer . " AND date_add > '" . $lower . "' AND date_add < '" . $upper . "'");
            
            if($i == 0){
                $month .= '' . date("M",strtotime($current_date)) . '';
            }else{
                $month .= '' . date("M",strtotime($current_date . ' -' . $i . ' month')) . '';
            }
            
            $byMonth.= $orders['total'] + 0;
            
            
            if($i < 12){
              $byMonth.= ', ';  
              $month.= ', ';  
            } 
        }
        
        return ['month' => explode(',',$month), 'total' => explode(',',$byMonth)];
    }

    public function _updatenotification(){
        $id_notification = Tools::getValue('id_notification');
        $id_customer = Tools::getValue('id_customer');


        $sql = "UPDATE "._DB_PREFIX_."customer
                SET id_notification=".$id_notification.
                " WHERE id_customer=".$id_customer;

        Db::getInstance()->execute($sql);

    }

    public function verifyLastNotification() {

        $sqlLastid = "SELECT MAX(id) AS lastIdNotification FROM "._DB_PREFIX_."asd_alert_messages WHERE message_status=1";
        $valueTableAlert = Db::getInstance()->getRow($sqlLastid);
    
        $sqlCustomeridnotification = "SELECT id_notification AS currentIdNotification FROM "._DB_PREFIX_."customer WHERE id_customer=".$this->context->customer->id;
        $valueCustomerNotification = Db::getInstance()->getRow($sqlCustomeridnotification);

        if($valueTableAlert['lastIdNotification'] === $valueCustomerNotification['currentIdNotification'] || $valueTableAlert['lastIdNotification'] <= $valueCustomerNotification['currentIdNotification']){
            return 0;
        }else{
            return 1;
        }
    }
    
    

    public function ordersByBrand($idCustomer)
    {
        $sql = "SELECT sum(". _DB_PREFIX_ ."order_detail.product_price) AS total, ". _DB_PREFIX_ ."manufacturer.name
                    FROM ". _DB_PREFIX_ ."orders 
                    LEFT JOIN ". _DB_PREFIX_ ."order_detail 
                    ON ". _DB_PREFIX_ ."orders.id_order = ". _DB_PREFIX_ ."order_detail.id_order  
                    LEFT JOIN ". _DB_PREFIX_ ."product 
                    ON ". _DB_PREFIX_ ."order_detail.product_id = ". _DB_PREFIX_ ."product.id_product
                    LEFT JOIN ". _DB_PREFIX_ ."manufacturer 
                    ON ". _DB_PREFIX_ ."manufacturer.id_manufacturer = ". _DB_PREFIX_ ."product.id_manufacturer 
                    WHERE id_customer =" . $idCustomer . '
                    GROUP BY '. _DB_PREFIX_ .'product.id_manufacturer';
        
                    // echo $sql;
                    // exit;

        $manufacturers =  Db::getInstance()->executeS($sql);
        
        $brands = '';
        $totals = '';
        $colors = '';
        foreach($manufacturers AS $index => $manufacturer){
            
            if($manufacturer['name'] !='Shipping'){
                if($index > 0){
                    $brands.= ', ';  
                    $colors.= ', ';  
                    $totals.= ', ';  
                } 
                $brands .= "" . $manufacturer['name'] . "";
                $colors .= '' . self::random_hexcolor() . '';
                $totals .= '' . number_format($manufacturer['total'], 0, '', '') . '';
            }
        }
        
        // return ['brands' => explode(',',$brands), 'totals' => explode(',',$totals), 'colors' => explode(',',$colors)];
        return ['brands' => $brands, 'totals' => $totals, 'colors' => explode(',',$colors)];

    }
    
    public function random_color() { return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT); }
    
    public function random_hexcolor() {
        return '#' . self::random_color() . self::random_color() . self::random_color();
    }


    public function getDefaultLanguage()
    {
        $defaultLanguageId = $this->context->customer->id_lang;
        
        switch($defaultLanguageId){
            case 2 : return 'English';
            case 4 : return 'Español';
            case 5 : return 'Français';
            case 1 : return 'Português';
            case 7 : return 'Italian';
            default : return 'English';
        }

    }

    public function getNotifications() {
        $messages = Db::getInstance()->executeS('SELECT * FROM '._DB_PREFIX_.'asd_alert_messages WHERE deleted = 0 AND message_status = 1 ORDER BY id DESC');

        return $messages;
    }


    public function getCounters($idCustomer){
        
        $waiting_validation =  Db::getInstance()->getRow("SELECT count(current_state) AS waiting_validation FROM ". _DB_PREFIX_ ."orders WHERE id_customer =" . $idCustomer . " AND current_state = 24");
        $waiting_payment =  Db::getInstance()->getRow("SELECT count(current_state) AS waiting_payment FROM ". _DB_PREFIX_ ."orders WHERE id_customer =" . $idCustomer . " AND current_state = 10");
        $processing =  Db::getInstance()->getRow("SELECT count(current_state) AS processing FROM ". _DB_PREFIX_ ."orders WHERE id_customer =" . $idCustomer . " AND current_state = 3");
        $backorders =  Db::getInstance()->getRow("SELECT count(current_state) AS backorders FROM ". _DB_PREFIX_ ."orders WHERE id_customer =" . $idCustomer . " AND current_state = 9");
        $shipped =  Db::getInstance()->getRow("SELECT count(current_state) AS shipped FROM ". _DB_PREFIX_ ."orders WHERE id_customer =" . $idCustomer . " AND current_state = 4");
        $canceled =  Db::getInstance()->getRow("SELECT count(current_state) AS canceled FROM ". _DB_PREFIX_ ."orders WHERE id_customer =" . $idCustomer . " AND current_state = 6");
        $partial_shipping =  Db::getInstance()->getRow("SELECT count(current_state) AS partial_shipping FROM ". _DB_PREFIX_ ."orders WHERE id_customer =" . $idCustomer . " AND current_state = 22");
        $total_orders =  Db::getInstance()->getRow("SELECT count(id_order) AS total_orders FROM ". _DB_PREFIX_ ."orders WHERE id_customer =" . $idCustomer);
        
        $orders['waiting_validation'] = $waiting_validation['waiting_validation'];
        $orders['waiting_payment']    = $waiting_payment['waiting_payment'];
        $orders['processing']         = $processing['processing'];
        $orders['backorders']         = $backorders['backorders'];
        $orders['shipped']            = $shipped['shipped'];
        $orders['canceled']           = $canceled['canceled'];
        $orders['partial_shipping']   = $partial_shipping['partial_shipping'];
        $orders['total_orders']       = $total_orders['total_orders'];
        
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
        $colors = array();
        
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

            $waiting_validation =  Db::getInstance()->getRow("SELECT count(id_order_state) AS waiting_validation FROM ". _DB_PREFIX_ ."order_history LEFT JOIN ". _DB_PREFIX_ ."orders ON ". _DB_PREFIX_ ."order_history.id_order = ". _DB_PREFIX_ ."orders.id_order WHERE ". _DB_PREFIX_ ."orders.id_customer =" . $idCustomer . " AND ". _DB_PREFIX_ ."order_history.id_order_state = 15" . " AND ". _DB_PREFIX_ ."order_history.date_add > '" . $lower . "' AND ". _DB_PREFIX_ ."order_history.date_add < '" . $upper . "'");
            $waiting_payment =  Db::getInstance()->getRow("SELECT count(id_order_state) AS waiting_payment FROM ". _DB_PREFIX_ ."order_history LEFT JOIN ". _DB_PREFIX_ ."orders ON ". _DB_PREFIX_ ."order_history.id_order = ". _DB_PREFIX_ ."orders.id_order WHERE ". _DB_PREFIX_ ."orders.id_customer =" . $idCustomer . " AND ". _DB_PREFIX_ ."order_history.id_order_state = 10" . " AND ". _DB_PREFIX_ ."order_history.date_add > '" . $lower . "' AND ". _DB_PREFIX_ ."order_history.date_add < '" . $upper . "'");
            $processing =  Db::getInstance()->getRow("SELECT count(id_order_state) AS processing FROM ". _DB_PREFIX_ ."order_history LEFT JOIN ". _DB_PREFIX_ ."orders ON ". _DB_PREFIX_ ."order_history.id_order = ". _DB_PREFIX_ ."orders.id_order WHERE ". _DB_PREFIX_ ."orders.id_customer =" . $idCustomer . " AND ". _DB_PREFIX_ ."order_history.id_order_state = 3" . " AND ". _DB_PREFIX_ ."order_history.date_add > '" . $lower . "' AND ". _DB_PREFIX_ ."order_history.date_add < '" . $upper . "'");
            $backorders =  Db::getInstance()->getRow("SELECT count(id_order_state) AS backorders FROM ". _DB_PREFIX_ ."order_history LEFT JOIN ". _DB_PREFIX_ ."orders ON ". _DB_PREFIX_ ."order_history.id_order = ". _DB_PREFIX_ ."orders.id_order WHERE ". _DB_PREFIX_ ."orders.id_customer =" . $idCustomer . " AND ". _DB_PREFIX_ ."order_history.id_order_state = 9" . " AND ". _DB_PREFIX_ ."order_history.date_add > '" . $lower . "' AND ". _DB_PREFIX_ ."order_history.date_add < '" . $upper . "'");
            $shipped =  Db::getInstance()->getRow("SELECT count(id_order_state) AS shipped FROM ". _DB_PREFIX_ ."order_history LEFT JOIN ". _DB_PREFIX_ ."orders ON ". _DB_PREFIX_ ."order_history.id_order = ". _DB_PREFIX_ ."orders.id_order WHERE ". _DB_PREFIX_ ."orders.id_customer =" . $idCustomer . " AND ". _DB_PREFIX_ ."order_history.id_order_state = 4" . " AND ". _DB_PREFIX_ ."order_history.date_add > '" . $lower . "' AND ". _DB_PREFIX_ ."order_history.date_add < '" . $upper . "'");
            $canceled =  Db::getInstance()->getRow("SELECT count(id_order_state) AS canceled FROM ". _DB_PREFIX_ ."order_history LEFT JOIN ". _DB_PREFIX_ ."orders ON ". _DB_PREFIX_ ."order_history.id_order = ". _DB_PREFIX_ ."orders.id_order WHERE ". _DB_PREFIX_ ."orders.id_customer =" . $idCustomer . " AND ". _DB_PREFIX_ ."order_history.id_order_state = 6" . " AND ". _DB_PREFIX_ ."order_history.date_add > '" . $lower . "' AND ". _DB_PREFIX_ ."order_history.date_add < '" . $upper . "'");
            $accepted =  Db::getInstance()->getRow("SELECT count(id_order_state) AS accepted FROM ". _DB_PREFIX_ ."order_history LEFT JOIN ". _DB_PREFIX_ ."orders ON ". _DB_PREFIX_ ."order_history.id_order = ". _DB_PREFIX_ ."orders.id_order WHERE ". _DB_PREFIX_ ."orders.id_customer =" . $idCustomer . " AND ". _DB_PREFIX_ ."order_history.id_order_state = 2" . " AND ". _DB_PREFIX_ ."order_history.date_add > '" . $lower . "' AND ". _DB_PREFIX_ ."order_history.date_add < '" . $upper . "'");
            $refunded =  Db::getInstance()->getRow("SELECT count(id_order_state) AS refunded FROM ". _DB_PREFIX_ ."order_history LEFT JOIN ". _DB_PREFIX_ ."orders ON ". _DB_PREFIX_ ."order_history.id_order = ". _DB_PREFIX_ ."orders.id_order WHERE ". _DB_PREFIX_ ."orders.id_customer =" . $idCustomer . " AND ". _DB_PREFIX_ ."order_history.id_order_state = 7" . " AND ". _DB_PREFIX_ ."order_history.date_add > '" . $lower . "' AND ". _DB_PREFIX_ ."order_history.date_add < '" . $upper . "'");
            $delivered =  Db::getInstance()->getRow("SELECT count(id_order_state) AS delivered FROM ". _DB_PREFIX_ ."order_history LEFT JOIN ". _DB_PREFIX_ ."orders ON ". _DB_PREFIX_ ."order_history.id_order = ". _DB_PREFIX_ ."orders.id_order WHERE ". _DB_PREFIX_ ."orders.id_customer =" . $idCustomer . " AND ". _DB_PREFIX_ ."order_history.id_order_state = 5" . " AND ". _DB_PREFIX_ ."order_history.date_add > '" . $lower . "' AND ". _DB_PREFIX_ ."order_history.date_add < '" . $upper . "'");

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
        
        $order =  Db::getInstance()->getRow("SELECT date_add FROM ". _DB_PREFIX_ ."orders WHERE id_customer =" . $idCustomer . " ORDER BY id_order DESC");
        
        $date = date_create($order['date_add']);
        return date_format($date, "Y-m-d");
    }

    public function getNumberOfOrders($idCustomer){
        
        $orders =  Db::getInstance()->getRow("SELECT count(*) AS total FROM ". _DB_PREFIX_ ."orders WHERE id_customer =" . $idCustomer);
        return (int)$orders['total'];
    }

    public function getTotalOfOrders($idCustomer){
        
        $orders =  Db::getInstance()->getRow("SELECT sum(total_paid) AS total FROM ". _DB_PREFIX_ ."orders WHERE id_customer =" . $idCustomer . " AND current_state IN (2, 3, 4, 5, 9, 10, 15)");
        return (float)$orders['total']; 
    }

    public function getNumberAddresses($idCustomer){
        $addresses =  Db::getInstance()->getRow("SELECT count(*) total FROM ". _DB_PREFIX_ ."address WHERE id_customer =" . $idCustomer . " AND deleted=0");
        return $addresses['total'];
    }

    public function getLastViewedProducts(){

    
        $ids_viewed_products = explode(',', $this->context->cookie->viewed);
        $unique = array_unique($ids_viewed_products);
        $reversed = array_reverse($unique);
        $last_viewed_ids = array_slice($reversed, 0, 4);

        
        // echo '<pre>'.print_r($this->context->cookie,1).'</pre>';
        //  exit;


        $products = array();
        foreach($last_viewed_ids AS $id){
            if($id != ''){
            $sql = "SELECT ". _DB_PREFIX_ ."manufacturer.name AS brand, ". _DB_PREFIX_ ."product_lang.name AS name, ". _DB_PREFIX_ ."product.reference, ". _DB_PREFIX_ ."product.id_product AS id_product, ". _DB_PREFIX_ ."product_lang.description_short AS description_short, ". _DB_PREFIX_ ."manufacturer.id_manufacturer AS id_manufacturer
                    FROM ". _DB_PREFIX_ ."product
                    LEFT JOIN ". _DB_PREFIX_ ."product_lang
                    ON ". _DB_PREFIX_ ."product_lang.id_product = ". _DB_PREFIX_ ."product.id_product 
                    LEFT JOIN ". _DB_PREFIX_ ."manufacturer
                    ON ". _DB_PREFIX_ ."manufacturer.id_manufacturer = ". _DB_PREFIX_ ."product.id_manufacturer 
                    WHERE ". _DB_PREFIX_ ."product.id_product =" . $id . " AND ". _DB_PREFIX_ ."product_lang.id_lang = ". $this->context->language->id . " AND ". _DB_PREFIX_ ."product_lang.id_shop =".$this->context->shop->id;
            
            // echo '<pre>'.print_r($sql,1).'</pre>';
            // exit;
            // Fetch the product details
            $productDetails = Db::getInstance()->getRow($sql);

            // Fetch the image cover and path
            $image = Image::getCover($id);
            $product = new Product($id);
            $link = new Link;
            $imageURL = $link->getImageLink($product->link_rewrite[Context::getContext()->language->id], $image['id_image'], 'home_default');

            $parsedUrl = parse_url($imageURL, PHP_URL_PATH);
      
            // echo '<pre>'.print_r($_SERVER['SERVER_NAME'],1).'</pre>';
            // echo '<pre>'.print_r($parsedUrl,1).'</pre>';
            // exit;

            $cleanedPath = str_replace($_SERVER['SERVER_NAME'], '', $parsedUrl);

            // Add the image path to the product details array
            if ($productDetails) {
                $productDetails['image_path'] = $cleanedPath;
                $products[] = $productDetails;
            }
            }
            
            // echo '<pre>'.print_r($products,1).'</pre>';
            // exit;
        }

        return $products;
    }

    public function getMostBoughtProducts($idCustomer){
        
        $sql = "SELECT sum(product_quantity) AS number,". _DB_PREFIX_ ."manufacturer.name AS brand, ". _DB_PREFIX_ ."manufacturer.id_manufacturer AS id_manufacturer, ". _DB_PREFIX_ ."product_lang.name AS name, ". _DB_PREFIX_ ."product.reference, ". _DB_PREFIX_ ."order_detail.product_id AS id_product, ". _DB_PREFIX_ ."product_lang.description_short AS description_short
            FROM ". _DB_PREFIX_ ."orders
            LEFT JOIN ". _DB_PREFIX_ ."order_detail
            ON ". _DB_PREFIX_ ."orders.id_order = ". _DB_PREFIX_ ."order_detail.id_order
            LEFT JOIN ". _DB_PREFIX_ ."product
            ON ". _DB_PREFIX_ ."order_detail.product_id = ". _DB_PREFIX_ ."product.id_product
            LEFT JOIN ". _DB_PREFIX_ ."product_lang
            ON ". _DB_PREFIX_ ."product_lang.id_product = ". _DB_PREFIX_ ."product.id_product 
            LEFT JOIN ". _DB_PREFIX_ ."manufacturer
            ON ". _DB_PREFIX_ ."manufacturer.id_manufacturer = ". _DB_PREFIX_ ."product.id_manufacturer 
            WHERE ". _DB_PREFIX_ ."orders.id_customer =" . $idCustomer . " AND ". _DB_PREFIX_ ."product_lang.id_lang = ". $this->context->language->id . " AND  ". _DB_PREFIX_ ."product_lang.id_shop=". $this->context->shop->id . " GROUP BY ". _DB_PREFIX_ ."order_detail.product_id ORDER BY number DESC 
            LIMIT 4 ";

            // echo $sql;
            // exit;
        $productDetails = Db::getInstance()->executeS($sql);
        
        $products = array();

        foreach ($productDetails as $product) {
            // Fetch image details for the product
            $image = Image::getCover($product['id_product']);
            $productObject = new Product($product['id_product']);
            $link = new Link;
            $imagePath = $link->getImageLink($productObject->link_rewrite[Context::getContext()->language->id], $image['id_image'], 'home_default');
        
            // Remove the host part from the image path, if needed
            $parsedUrl = parse_url($imagePath, PHP_URL_PATH);
      
            // echo '<pre>'.print_r($_SERVER['SERVER_NAME'],1).'</pre>';
            // echo '<pre>'.print_r($parsedUrl,1).'</pre>';
            // exit;

            $cleanedPath = str_replace($_SERVER['SERVER_NAME'], '', $parsedUrl);
        
            // Add the image path to the product details
            $product['image_path'] = $cleanedPath;
        
            // Add the modified product details to the products array
            $products[] = $product;
        }


        return $products;
    }


    public function bestSellers(){
        
        $bestseller = '';
        $bestsellerReference= '';

        $sql = "SELECT sum(product_quantity) AS product_quantity, product_reference
            FROM ". _DB_PREFIX_ ."order_detail
            WHERE id_order > 0
            AND product_reference NOT LIKE 'SHIPPING-%'
            GROUP BY product_id
            ORDER BY product_quantity DESC
            LIMIT 12";

        $products = Db::getInstance()->executeS($sql);
        
        foreach($products AS $i => $product){
            
            $bestsellerReference.= '' . $product['product_reference'] . '';
            $bestseller.= '' . $product['product_quantity'] . '';

            if($i < 11){
                $bestsellerReference.= ', '; 
                $bestseller.= ', '; 
            }
        }
        
        return [ 'colors' => '' . self::random_hexcolor() . '', 'references' => $bestsellerReference, 'values' => $bestseller ];
    }

    public function getTop100(){
        
        $top = [];

        $sql = "SELECT sum(product_quantity) AS product_quantity, product_reference, product_id
            FROM ". _DB_PREFIX_ ."order_detail
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