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
        $serverName = $_SERVER['SERVER_NAME'];

    if($_POST['g-recaptcha-response']){
        $api_url = 'https://www.google.com/recaptcha/api/siteverify'; 
        
        
            $resq_data = array( 
                'secret' => '6LePv_oqAAAAAL_fWcMUQtnc-oCStLGmrp6ESiyT', 
                'response' => $_POST['g-recaptcha-response'], 
                'remoteip' => $_SERVER['REMOTE_ADDR'] 
            ); 


        $curlConfig = array( 
            CURLOPT_URL => $api_url, 
            CURLOPT_POST => true, 
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_POSTFIELDS => $resq_data, 
            CURLOPT_SSL_VERIFYPEER => false 
        ); 
        
        $ch = curl_init(); 
        curl_setopt_array($ch, $curlConfig); 
        $response = curl_exec($ch); 
        
        if (curl_errno($ch)) $api_error = curl_error($ch); 
        
        curl_close($ch); 
        
        $responseData = json_decode($response); 
        // echo 'paulo';
        // echo '<pre>'.print_r($responseData,1).'</pre>' ;
        // exit;
        
        if(!empty($responseData) && $responseData->success){


        // if (Tools::isSubmit('submitMessage')) {
            // echo 'paulo';
            // exit;
            $saveContactKey = $this->context->cookie->contactFormKey;
            $extension = array('.txt', '.rtf', '.doc', '.docx', '.pdf', '.zip', '.png', '.jpeg', '.gif', '.jpg');
            $file_attachment = Tools::fileAttachment('fileUpload');
            $message = Tools::getValue('message'); // Html entities is not usefull, iscleanHtml check there is no bad html tags.

            if (!($from = trim(Tools::getValue('from'))) || !Validate::isEmail($from)) {
                $this->errors[] = Tools::displayError('Invalid email address.');
            } elseif (!$message) {
                $this->errors[] = Tools::displayError('The message cannot be blank.');
            } elseif (!Validate::isCleanHtml($message)) {
                $this->errors[] = Tools::displayError('Invalid message');
            } elseif (!($id_contact = (int)Tools::getValue('id_contact')) || !(Validate::isLoadedObject($contact = new Contact($id_contact, $this->context->language->id)))) {
                $this->errors[] = Tools::displayError('Please select a subject from the list provided. ');
            } elseif (!empty($file_attachment['name']) && $file_attachment['error'] != 0) {
                $this->errors[] = Tools::displayError('An error occurred during the file-upload process.');
            } elseif (!empty($file_attachment['name']) && !in_array(Tools::strtolower(substr($file_attachment['name'], -4)), $extension) && !in_array(Tools::strtolower(substr($file_attachment['name'], -5)), $extension)) {
                $this->errors[] = Tools::displayError('Bad file extension');
            } else {
                $customer = $this->context->customer;
                if (!$customer->id) {
                    $customer->getByEmail($from);
                }

                $id_order = (int)$this->getOrder();

                /**
                 * Check if customer select his order.
                 */
                
                if (!empty($id_order)) {
                    $order = new Order($id_order);
                    $id_order = (int) $order->id_customer === (int) $customer->id ? $id_order : 0;
                }

                if (!((
                        ($id_customer_thread = (int)Tools::getValue('id_customer_thread'))
                        && (int)Db::getInstance()->getValue('
						SELECT cm.id_customer_thread FROM '._DB_PREFIX_.'customer_thread cm
						WHERE cm.id_customer_thread = '.(int)$id_customer_thread.' AND cm.id_shop = '.(int)$this->context->shop->id.' AND token = \''.pSQL(Tools::getValue('token')).'\'')
                    ) || (
                        $id_customer_thread = CustomerThread::getIdCustomerThreadByEmailAndIdOrder($from, $id_order)
                    ))) {
                    $fields = Db::getInstance()->executeS('
					SELECT cm.id_customer_thread, cm.id_contact, cm.id_customer, cm.id_order, cm.id_product, cm.email
					FROM '._DB_PREFIX_.'customer_thread cm
					WHERE email = \''.pSQL($from).'\' AND cm.id_shop = '.(int)$this->context->shop->id.' AND ('.
                        ($customer->id ? 'id_customer = '.(int)$customer->id.' OR ' : '').'
						id_order = '.(int)$id_order.')');
                    $score = 0;
                    foreach ($fields as $key => $row) {
                        $tmp = 0;
                        if ((int)$row['id_customer'] && $row['id_customer'] != $customer->id && $row['email'] != $from) {
                            continue;
                        }
                        if ($row['id_order'] != 0 && $id_order != $row['id_order']) {
                            continue;
                        }
                        if ($row['email'] == $from) {
                            $tmp += 4;
                        }
                        if ($row['id_contact'] == $id_contact) {
                            $tmp++;
                        }
                        if (Tools::getValue('id_product') != 0 && $row['id_product'] == Tools::getValue('id_product')) {
                            $tmp += 2;
                        }
                        if ($tmp >= 5 && $tmp >= $score) {
                            $score = $tmp;
                            $id_customer_thread = $row['id_customer_thread'];
                        }
                    }
                }
                $old_message = Db::getInstance()->getValue('
					SELECT cm.message FROM '._DB_PREFIX_.'customer_message cm
					LEFT JOIN '._DB_PREFIX_.'customer_thread cc on (cm.id_customer_thread = cc.id_customer_thread)
					WHERE cc.id_customer_thread = '.(int)$id_customer_thread.' AND cc.id_shop = '.(int)$this->context->shop->id.'
					ORDER BY cm.date_add DESC');
                if ($old_message == $message) {
                    $this->context->smarty->assign('alreadySent', 1);
                    $contact->email = '';
                    $contact->customer_service = 0;
                }

                if ($contact->customer_service) {
                    if ((int)$id_customer_thread) {
                        $ct = new CustomerThread($id_customer_thread);
                        $ct->status = 'open';
                        $ct->id_lang = (int)$this->context->language->id;
                        $ct->id_contact = (int)$id_contact;
                        $ct->id_order = (int)$id_order;
                        if ($id_product = (int)Tools::getValue('id_product')) {
                            $ct->id_product = $id_product;
                        }
                        $ct->update();
                    } else {
                        $ct = new CustomerThread();
                        if (isset($customer->id)) {
                            $ct->id_customer = (int)$customer->id;
                        }
                        $ct->id_shop = (int)$this->context->shop->id;
                        $ct->id_order = (int)$id_order;
                        if ($id_product = (int)Tools::getValue('id_product')) {
                            $ct->id_product = $id_product;
                        }
                        $ct->id_contact = (int)$id_contact;
                        $ct->id_lang = (int)$this->context->language->id;
                        $ct->email = $from;
                        $ct->status = 'open';
                        $ct->token = Tools::passwdGen(12);
                        $ct->add();
                    }

                    if ($ct->id) {
                        $cm = new CustomerMessage();
                        $cm->id_customer_thread = $ct->id;
                        $cm->message = $message;
                        if (isset($file_attachment['rename']) && !empty($file_attachment['rename']) && rename($file_attachment['tmp_name'], _PS_UPLOAD_DIR_.basename($file_attachment['rename']))) {
                            $cm->file_name = $file_attachment['rename'];
                            @chmod(_PS_UPLOAD_DIR_.basename($file_attachment['rename']), 0664);
                        }
                        $cm->ip_address = (int)ip2long(Tools::getRemoteAddr());
                        $cm->user_agent = $_SERVER['HTTP_USER_AGENT'];
                        if (!$cm->add()) {
                            $this->errors[] = Tools::displayError('An error occurred while sending the message.');
                        }
                    } else {
                        $this->errors[] = Tools::displayError('An error occurred while sending the message.');
                    }
                }

                if (!count($this->errors)) {
                    $var_list = array(
                                    '{order_name}' => '-',
                                    '{attached_file}' => '-',
                                    '{message}' => Tools::nl2br(stripslashes($message)),
                                    '{email}' =>  $from,
                                    '{product_name}' => '',
                                    '{firstname}' => Tools::getValue('firstname'),
                                    '{lastname}' => Tools::getValue('lastname')
                                );

                    if (isset($file_attachment['name'])) {
                        $var_list['{attached_file}'] = $file_attachment['name'];
                    }

                    $id_product = (int)Tools::getValue('id_product');

                    if (isset($ct) && Validate::isLoadedObject($ct) && $ct->id_order) {
                        $order = new Order((int)$ct->id_order);
                        $var_list['{order_name}'] = $order->getUniqReference();
                        $var_list['{id_order}'] = (int)$order->id;
                    }

                    if ($id_product) {
                        $product = new Product((int)$id_product);
                        if (Validate::isLoadedObject($product) && isset($product->name[Context::getContext()->language->id])) {
                            $var_list['{product_name}'] = $product->name[Context::getContext()->language->id];
                        }
                    }

                    // echo Tools::getValue('name');
                    // exit;

                    if (!empty($contact->email) || !empty(Tools::getValue('from'))) {
                        if (!Mail::Send(2, 'contact', Mail::l('Message from contact form').' [no_sync]',
                            $var_list, 'sales@'.$serverName, $contact->name, null, null,
                                    $file_attachment, null,    _PS_MAIL_DIR_, false, null, null, $from)) {
                            $this->errors[] = Tools::displayError('An error occurred while sending the message.');
                        }
                        
                        Mail::Send($this->context->language->id, 'contact_form', Mail::l('Message from contact form').' [no_sync]',
                            $var_list, 'sales@'.$serverName, $var_list['{firstname}'] . ' ' . $var_list['{lastname}'], null, null,
                                    $file_attachment, null,    _PS_MAIL_DIR_, false, null, null, $from);
                    }
                }

                if (count($this->errors) > 1) {
                    array_unique($this->errors);
                } elseif (!count($this->errors)) {
                    $this->context->smarty->assign('confirmation', 1);
                }
            }
        // }
            }
        }
        
        if(Tools::getValue('action') == 'check_vat'){
            // $has_address = $this->context->customer->getAddresses($this->context->language->id);
            
            // if($has_address) {
            //     $country = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS("SELECT iso_code FROM ". _DB_PREFIX_ ."country WHERE id_country=" . $has_address[0]['id_country'] . " Limit 1 ");
            //     $iso_code = $country[0]['iso_code'];
            //     $iso_code = ($iso_code == 'GR') ? 'EL' : $iso_code;
            // }

            $vat_iso_code = substr(Tools::getValue('vatnumber',0), 0, 2);
    
            $vat_iso_code = ($vat_iso_code == 'GR') ? 'EL' : $vat_iso_code;


            // if($has_address) {
            // echo ($vat_iso_code != $iso_code) ? 0 : 1;
            // }else{
                if(preg_match('/^[A-Za-z]+$/', $vat_iso_code)){
                    echo 1;
                }else{
                     $this->errors[] = $this->trans('VAT number is not valid.', [], 'Shop.Notifications.Error');
                }
            // }
            // $this->redirectWithNotifications($this->getCurrentURL());

            // if($vat_iso_code != $iso_code){
            //     $this->errors[] = $this->trans('Could not update your information, you cannot edit "Siret" or "Company".', [], 'Shop.Notifications.Error');

            //     $this->redirectWithNotifications($this->getCurrentURL());
            // }else{
            //     $this->redirectWithNotifications($this->getCurrentURL());
            // }
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

        // echo '<pre>'.print_r($order->getDeliverySlipsCollection(),1).'</pre>';
        // exit;

        parent::initContent();

        // contact form inicion
        if(Tools::getValue('type') == 'slip'){
            $order = new Order(Tools::getValue('id_order'));
            $order_invoice_collection = $order->getDeliverySlipsCollection();
            $pdf = new PDF($order_invoice_collection, PDF::TEMPLATE_DELIVERY_SLIP, Context::getContext()->smarty);  
            $pdf->render();
        }

        $email = Tools::safeOutput(Tools::getValue('from',
        ((isset($this->context->cookie) && isset($this->context->cookie->email) && Validate::isEmail($this->context->cookie->email)) ? $this->context->cookie->email : '')));
        $this->context->smarty->assign(array(
            'errors' => $this->errors,
            'email' => $email,
            'fileupload' => Configuration::get('PS_CUSTOMER_SERVICE_FILE_UPLOAD'),
            'max_upload_size' => (int)Tools::getMaxUploadSize()
        ));

        if (($id_customer_thread = (int)Tools::getValue('id_customer_thread')) && $token = Tools::getValue('token')) {
            $customer_thread = Db::getInstance()->getRow('
				SELECT cm.*
				FROM '._DB_PREFIX_.'customer_thread cm
				WHERE cm.id_customer_thread = '.(int)$id_customer_thread.'
				AND cm.id_shop = '.(int)$this->context->shop->id.'
				AND token = \''.pSQL($token).'\'
			');

            $order = new Order((int)$customer_thread['id_order']);
            if (Validate::isLoadedObject($order)) {
                $customer_thread['reference'] = $order->getUniqReference();
            }
            $this->context->smarty->assign('customerThread', $customer_thread);
        }

        $contactKey = md5(uniqid(microtime(), true));
        $this->context->cookie->__set('contactFormKey', $contactKey);

        $this->context->smarty->assign(array(
            'contacts' => Contact::getContacts($this->context->language->id),
            'message' => html_entity_decode(Tools::getValue('message')),
            'contactKey' => $contactKey,
        ));
        // contact form fim

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
            'totalOfOrders' => number_format($totalOfOrders, 2, '.', ' '),
            'average' => number_format($average, 2, '.', ' '),
            'lastViewedProducts' => self::getLastViewedProducts(),
            'mostBoughtProducts' => self::getMostBoughtProducts($idCustomer),
            'orderByDateAndStatus' => self::getOrderByDateAndStatus($idCustomer),
            'bestSellers' => self::bestSellers(),
            'top' => self::getTop100(),
            'messages' => self::getNotifications()
        ));

        


        $this->context->smarty->assign([
            'orders' => $this->getTemplateVarOrders(),
            'orders_detail' => $this->getQtySent(),
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

    public function getQtySent() {
        $orders_detail = [];
        $customer_orders = Order::getCustomerOrders($this->context->customer->id);
    
        foreach ($customer_orders as $customer_order) {
            $order_details = OrderDetail::getList($customer_order['id_order']); 
    
            usort($order_details, function($a, $b) {
                return $b['id_order_detail'] - $a['id_order_detail'];
            });

            

            $quantity_sent = [];
            foreach ($order_details as $detail) {
                
                    $quantity_sent[] = [ 
                        'qty_sent' =>$detail['product_quantity_sent'],
                        'qty' => $detail['product_quantity'],
                        'qty_reference' => $detail['product_reference'],
                    ];
            }

            $orders_detail[$customer_order['id_order']] =  $quantity_sent;
        }
    
        // echo '<pre>'.print_r($orders_detail,1).'</pre>';
        // exit;
    
        return $orders_detail;
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
            $sql = "SELECT ". _DB_PREFIX_ ."manufacturer.name AS brand, ". _DB_PREFIX_ ."product_lang.name AS name, ". _DB_PREFIX_ ."product.reference, ". _DB_PREFIX_ ."product.id_product AS id_product, ". _DB_PREFIX_ ."product_lang.description_short AS description_short, ". _DB_PREFIX_ ."manufacturer.id_manufacturer AS id_manufacturer,". _DB_PREFIX_ ."product_lang.link_rewrite AS link_rewrite, cl.link_rewrite AS link_category
                    FROM ". _DB_PREFIX_ ."product
                    LEFT JOIN ". _DB_PREFIX_ ."product_lang
                    ON ". _DB_PREFIX_ ."product_lang.id_product = ". _DB_PREFIX_ ."product.id_product 
                    LEFT JOIN ". _DB_PREFIX_ ."manufacturer
                    ON ". _DB_PREFIX_ ."manufacturer.id_manufacturer = ". _DB_PREFIX_ ."product.id_manufacturer 
                    LEFT JOIN ". _DB_PREFIX_."category_lang AS cl
                    ON "._DB_PREFIX_."product.id_category_default = cl.id_category
                    WHERE ". _DB_PREFIX_ ."product.id_product =" . $id . " AND ". _DB_PREFIX_ ."product_lang.id_lang = ". $this->context->language->id . " AND ". _DB_PREFIX_ ."product_lang.id_shop =".$this->context->shop->id ." AND cl.id_lang = ".$this->context->language->id;
            
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
            
            $link_product = $link->getProductLink($id);

            // Add the image path to the product details array
            if ($productDetails) {
                $productDetails['image_path'] = $cleanedPath;
                $productDetails['link_product'] = $link_product;
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
            WHERE ". _DB_PREFIX_ ."orders.id_customer =" . $idCustomer . " AND ". _DB_PREFIX_ ."product.active = 1 AND ". _DB_PREFIX_ ."product_lang.id_lang = ". $this->context->language->id . " AND  ". _DB_PREFIX_ ."product_lang.id_shop=". $this->context->shop->id . " GROUP BY ". _DB_PREFIX_ ."order_detail.product_id ORDER BY number DESC 
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

            $link_product = $link->getProductLink($product['id_product']);
        
            // Add the image path to the product details
            $product['image_path'] = $cleanedPath;
            $product['link_product'] = $link_product;
        
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
            AND product_reference NOT LIKE 'ccFee'
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

    protected function assignOrderList()
    {
        if ($this->context->customer->isLogged()) {
            $this->context->smarty->assign('isLogged', 1);

            $products = array();
            $result = Db::getInstance()->executeS('
			SELECT id_order
			FROM '._DB_PREFIX_.'orders
			WHERE id_customer = '.(int)$this->context->customer->id.Shop::addSqlRestriction(Shop::SHARE_ORDER).' ORDER BY date_add');

            $orders = array();

            foreach ($result as $row) {
                $order = new Order($row['id_order']);
                $date = explode(' ', $order->date_add);
                $tmp = $order->getProducts();
                foreach ($tmp as $key => $val) {
                    $products[$row['id_order']][$val['product_id']] = array('value' => $val['product_id'], 'label' => $val['product_name']);
                }

                $orders[] = array('value' => $order->id, 'label' => $order->getUniqReference().' - '.Tools::displayDate($date[0], null) , 'selected' => (int)$this->getOrder() == $order->id);
            }

            $this->context->smarty->assign('orderList', $orders);
            $this->context->smarty->assign('orderedProductList', $products);
        }
    }

    protected function getOrder()
    {
        $id_order = false;
        if (!is_numeric($reference = Tools::getValue('id_order'))) {
            $reference = ltrim($reference, '#');
            $orders = Order::getByReference($reference);
            if ($orders) {
                foreach ($orders as $order) {
                    $id_order = (int)$order->id;
                    break;
                }
            }
        } elseif (Order::getCartIdStatic((int)Tools::getValue('id_order'))) {
            $id_order = (int)Tools::getValue('id_order');
        }
        return (int)$id_order;
    }
    
}