

<?php

class ContactControllerCore extends FrontController
{
    public $php_self = 'contact';
    public $ssl = true;

    public function postProcess()
    {
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
                    } elseif (Tools::getValue('id_contact') && (!(int)Tools::getValue('id_contact') || !Validate::isLoadedObject($contact = new Contact((int)Tools::getValue('id_contact'), $this->context->language->id)))) {
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
                                            '{order_name}' => Tools::getValue('reference') ? Tools::getValue('reference') :'-',
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

                            if(Tools::getValue('name')){
                                $var_list['{name}'] = (string)Tools::getValue('name');
                            }
        
                            // echo Tools::getValue('name');
                            // exit;
        
                            if (!empty($contact->email) || !empty(Tools::getValue('from'))) {
                                if (!Mail::Send((int)$this->context->language->id, 'contact', Mail::l('Message from contact form').' [no_sync]',
                                    $var_list, 'sales@'.$serverName, $contact->name, null, null,
                                            $file_attachment, null,    _PS_MAIL_DIR_, false, null, null, $from)) {
                                    $this->errors[] = Tools::displayError('An error occurred while sending the message.');
                                }else{
                                    $this->context->cookie->__set('contact_alert', $this->trans('Message successfully sent.', [], 'Shop.Theme.ContactForm'));
                                    
                                    Tools::redirect($this->context->link->getPageLink('contact'));
                                }
                                
                                // Mail::Send($this->context->language->id, 'contact_form', Mail::l('Message from contact form').' [no_sync]',
                                //     $var_list, 'info@euromuscleparts.com', $var_list['{firstname}'] . ' ' . $var_list['{lastname}'], null, null,
                                //             $file_attachment, null,    _PS_MAIL_DIR_, false, null, null, $from);
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
                
        
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->addCSS(_THEME_CSS_DIR_.'distribution.css');
        $this->addJS(_THEME_JS_DIR_.'contact-form.js');
        $this->addJS(_PS_JS_DIR_.'validate.js');
    }

    /**
    * Assign template vars related to page content
    * @see FrontController::initContent()
    */
    public function initContent()
    {
        parent::initContent();

        $this->assignOrderList();

        $contact_alert = $this->context->cookie->contact_alert;

        if (!empty($contact_alert)) {
            $this->context->controller->success[] = $contact_alert;

            $this->context->cookie->__unset('contact_alert');
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
        
        if ($this->context->shop->id == 3) {
            $this->setTemplate('contact-form');
        }else{
            $this->setTemplate('contact');
        }
    }

    /**
    * Assign template vars related to order list and product list ordered by the customer
    */
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

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();
    
        $breadcrumb['links'][] = [
            'title' => $this->trans('Contact', [], 'Shop.Theme.MyCars'),
            'url' => $this->context->link->getPageLink('contact'),
        ];
    
        return $breadcrumb;
    }
}