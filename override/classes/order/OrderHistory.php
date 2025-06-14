<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */
 
use PrestaShop\PrestaShop\Adapter\MailTemplate\MailPartialTemplateRenderer;
use PrestaShop\PrestaShop\Adapter\StockManager as StockManagerAdapter;
use PrestaShop\PrestaShop\Core\Stock\StockManager;

class OrderHistoryCore extends ObjectModel
{
    /** @var int Order id */
    public $id_order;

    /** @var int Order status id */
    public $id_order_state;

    /** @var int Employee id for this history entry */
    public $id_employee;

    /** @var string Object creation date */
    public $date_add;

    /** @var string Object last modification date */
    public $date_upd;
    
    public $context;
    
    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'order_history',
        'primary' => 'id_order_history',
        'fields' => [
            'id_order' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true],
            'id_order_state' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true],
            'id_employee' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId'],
            'date_add' => ['type' => self::TYPE_DATE, 'validate' => 'isDate'],
        ],
    ];

    /**
     * @see  ObjectModel::$webserviceParameters
     */
    protected $webserviceParameters = [
        'objectsNodeName' => 'order_histories',
        'fields' => [
            'id_employee' => ['xlink_resource' => 'employees'],
            'id_order_state' => ['required' => true, 'xlink_resource' => 'order_states'],
            'id_order' => ['xlink_resource' => 'orders'],
        ],
        'objectMethods' => [
            'add' => 'addWs',
        ],
    ];

    /**
     * Sets the new state of the given order.
     *
     * @param int $new_order_state
     * @param int|OrderCore $id_order
     * @param bool $use_existing_payment
     */
    public function changeIdOrderState($new_order_state, $id_order, $use_existing_payment = false)
    {
        if (!$new_order_state || !$id_order) {
            return;
        }

        if (!is_object($id_order) && is_numeric($id_order)) {
            $order = new Order((int) $id_order);
        } elseif (is_object($id_order)) {
            $order = $id_order;
        } else {
            return;
        }

        ShopUrl::cacheMainDomainForShop($order->id_shop);

        $new_os = new OrderState((int) $new_order_state, $order->id_lang);
        $old_os = new OrderState((int) $order->current_state, $order->id_lang);

        // executes hook
        if (in_array($new_os->id, [Configuration::get('PS_OS_PAYMENT'), Configuration::get('PS_OS_WS_PAYMENT')])) {
            // Hook called only for the shop concerned
            Hook::exec('actionPaymentConfirmation', ['id_order' => (int) $order->id], null, false, true, false, $order->id_shop);
        }

        // executes hook
        // Hook called only for the shop concerned
        Hook::exec('actionOrderStatusUpdate', [
            'newOrderStatus' => $new_os,
            'oldOrderStatus' => $old_os,
            'id_order' => (int) $order->id,
        ], null, false, true, false, $order->id_shop);

        if (Validate::isLoadedObject($order) && $new_os instanceof OrderState) {
            $context = Context::getContext();

            // An email is sent the first time a virtual item is validated
            $virtual_products = $order->getVirtualProducts();
            if ($virtual_products && !$old_os->logable && $new_os->logable) {
                $assign = [];
                foreach ($virtual_products as $key => $virtual_product) {
                    $id_product_download = ProductDownload::getIdFromIdProduct($virtual_product['product_id']);
                    $product_download = new ProductDownload($id_product_download);
                    // If this virtual item has an associated file, we'll provide the link to download the file in the email
                    if ($product_download->display_filename != '') {
                        $assign[$key]['name'] = $product_download->display_filename;
                        $dl_link = $product_download->getTextLink(false, $virtual_product['download_hash'])
                            . '&id_order=' . (int) $order->id
                            . '&secure_key=' . $order->secure_key;
                        $assign[$key]['link'] = $dl_link;
                        if (isset($virtual_product['download_deadline']) && $virtual_product['download_deadline'] != '0000-00-00 00:00:00') {
                            $assign[$key]['deadline'] = Tools::displayDate($virtual_product['download_deadline']);
                        }
                        if ($product_download->nb_downloadable != 0) {
                            $assign[$key]['downloadable'] = (int) $product_download->nb_downloadable;
                        }
                    }
                }

                $customer = new Customer((int) $order->id_customer);
                $links = [];
                foreach ($assign as $product) {
                    $complementaryText = [];
                    if (isset($product['deadline'])) {
                        $complementaryText[] = $this->trans('expires on %s.', [$product['deadline']], 'Admin.Orderscustomers.Notification');
                    }
                    if (isset($product['downloadable'])) {
                        $complementaryText[] = $this->trans('downloadable %d time(s)', [(int) $product['downloadable']], 'Admin.Orderscustomers.Notification');
                    }
                    $links[] = [
                        'text' => Tools::htmlentitiesUTF8($product['name']),
                        'url' => $product['link'],
                        'complementary_text' => implode(' ', $complementaryText),
                    ];
                }

                $context = Context::getContext();
                $partialRenderer = new MailPartialTemplateRenderer($context->smarty);
                
                $links_txt = null;
                $links_html = null;

                $data = [
                    '{lastname}' => $customer->lastname,
                    '{firstname}' => $customer->firstname,
                    '{id_order}' => (int) $order->id,
                    '{order_name}' => $order->getUniqReference(),
                    '{nbProducts}' => count($virtual_products),
                    '{virtualProducts}' => $links_html,
                    '{virtualProductsTxt}' => $links_txt,
                ];
                // If there is at least one downloadable file
                if (!empty($assign)) {
                    $orderLanguage = new Language((int) $order->id_lang);
                    Mail::Send(
                        (int) $order->id_lang,
                        'download_product',
                        Context::getContext()->getTranslator()->trans(
                            'The virtual product that you bought is available for download',
                            [],
                            'Emails.Subject',
                            $orderLanguage->locale
                        ),
                        $data,
                        $customer->email,
                        $customer->firstname . ' ' . $customer->lastname,
                        null,
                        null,
                        null,
                        null,
                        _PS_MAIL_DIR_,
                        false,
                        (int) $order->id_shop
                    );
                }
            }

            /** @since 1.5.0 : gets the stock manager */
            $manager = null;
            if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')) {
                $manager = StockManagerFactory::getManager();
            }

            // ASGROUP remove stock only on payment accepted

            // if($order->id_shop != 3 || $order->id_shop != 2){
            //     $error_or_canceled_statuses = [Configuration::get('PS_OS_ERROR'), Configuration::get('PS_OS_CANCELED')];
            // }else{
                $error_or_canceled_statuses = [Configuration::get('PS_OS_ERROR'), Configuration::get('PS_OS_CANCELED'), Configuration::get('PS_OS_BANKWIRE')];
            // }

            $employee = null;
            if (!(int) $this->id_employee || !Validate::isLoadedObject(($employee = new Employee((int) $this->id_employee)))) {
                if (!Validate::isLoadedObject($old_os) && $context != null) {
                    // First OrderHistory, there is no $old_os, so $employee is null before here
                    $employee = $context->employee; // filled if from BO and order created (because no old_os)
                    if ($employee) {
                        $this->id_employee = $employee->id;
                    }
                } else {
                    $employee = null;
                }
            }

            // foreach products of the order
            foreach ($order->getProductsDetail() as $product) {
                if (Validate::isLoadedObject($old_os)) {
                    // pre(in_array($old_os->id, $error_or_canceled_statuses));
                    // if becoming logable => adds sale
                    if ($new_os->logable && !$old_os->logable) {
                        ProductSale::addProductSale($product['product_id'], $product['product_quantity']);
                        // @since 1.5.0 - Stock Management
                        if (!Pack::isPack($product['product_id']) &&
                            in_array($old_os->id, $error_or_canceled_statuses) &&
                            !StockAvailable::dependsOnStock($product['id_product'], (int) $order->id_shop)) {
                            StockAvailable::updateQuantity($product['product_id'], $product['product_attribute_id'], -(int) $product['product_quantity'], $order->id_shop);
                        }
                    } elseif (!$new_os->logable && $old_os->logable) {
                        // if becoming unlogable => removes sale
                        ProductSale::removeProductSale($product['product_id'], $product['product_quantity']);

                        // @since 1.5.0 - Stock Management
                        if (!Pack::isPack($product['product_id']) &&
                            in_array($new_os->id, $error_or_canceled_statuses) &&
                            !StockAvailable::dependsOnStock($product['id_product'])) {
                            StockAvailable::updateQuantity($product['product_id'], $product['product_attribute_id'], (int) $product['product_quantity'], $order->id_shop);
                        }
                    } elseif (!$new_os->logable && !$old_os->logable &&
                        in_array($new_os->id, $error_or_canceled_statuses) &&
                        !in_array($old_os->id, $error_or_canceled_statuses) &&
                        !StockAvailable::dependsOnStock($product['id_product'])
                    ) {
                        // if waiting for payment => payment error/canceled
                        StockAvailable::updateQuantity($product['product_id'], $product['product_attribute_id'], (int) $product['product_quantity'], $order->id_shop);
                    }
                }
                // From here, there is 2 cases : $old_os exists, and we can test shipped state evolution,
                // Or old_os does not exists, and we should consider that initial shipped state is 0 (to allow decrease of stocks)

                // @since 1.5.0 : if the order is being shipped and this products uses the advanced stock management :
                // decrements the physical stock using $id_warehouse
                if ($new_os->shipped == 1 && (!Validate::isLoadedObject($old_os) || $old_os->shipped == 0) &&
                    Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT') &&
                    Warehouse::exists($product['id_warehouse']) &&
                    $manager != null &&
                    (int) $product['advanced_stock_management'] == 1) {
                    // gets the warehouse
                    $warehouse = new Warehouse($product['id_warehouse']);

                    // decrements the stock (if it's a pack, the StockManager does what is needed)
                    $manager->removeProduct(
                        $product['product_id'],
                        $product['product_attribute_id'],
                        $warehouse,
                        ($product['product_quantity'] - $product['product_quantity_refunded'] - $product['product_quantity_return']),
                        (int) Configuration::get('PS_STOCK_CUSTOMER_ORDER_REASON'),
                        true,
                        (int) $order->id
                    );
                } elseif ($new_os->shipped == 0 && Validate::isLoadedObject($old_os) && $old_os->shipped == 1 &&
                    Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT') &&
                    Warehouse::exists($product['id_warehouse']) &&
                    $manager != null &&
                    (int) $product['advanced_stock_management'] == 1
                ) {
                    // @since.1.5.0 : if the order was shipped, and is not anymore, we need to restock products

                    // if the product is a pack, we restock every products in the pack using the last negative stock mvts
                    if (Pack::isPack($product['product_id'])) {
                        $pack_products = Pack::getItems($product['product_id'], Configuration::get('PS_LANG_DEFAULT', null, null, $order->id_shop));
                        foreach ($pack_products as $pack_product) {
                            if ($pack_product->advanced_stock_management == 1) {
                                $mvts = StockMvt::getNegativeStockMvts($order->id, $pack_product->id, 0, $pack_product->pack_quantity * $product['product_quantity']);
                                foreach ($mvts as $mvt) {
                                    $manager->addProduct(
                                        $pack_product->id,
                                        0,
                                        new Warehouse($mvt['id_warehouse']),
                                        $mvt['physical_quantity'],
                                        null,
                                        $mvt['price_te'],
                                        true,
                                        null
                                    );
                                }
                                if (!StockAvailable::dependsOnStock($product['id_product'])) {
                                    StockAvailable::updateQuantity($pack_product->id, 0, (int) $pack_product->pack_quantity * $product['product_quantity'], $order->id_shop);
                                }
                            }
                        }
                    } else {
                        // else, it's not a pack, re-stock using the last negative stock mvts

                        $mvts = StockMvt::getNegativeStockMvts(
                            $order->id,
                            $product['product_id'],
                            $product['product_attribute_id'],
                            ($product['product_quantity'] - $product['product_quantity_refunded'] - $product['product_quantity_return'])
                        );

                        foreach ($mvts as $mvt) {
                            $manager->addProduct(
                                $product['product_id'],
                                $product['product_attribute_id'],
                                new Warehouse($mvt['id_warehouse']),
                                $mvt['physical_quantity'],
                                null,
                                $mvt['price_te'],
                                true
                            );
                        }
                    }
                }

                // Save movement if :
                // not Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')
                // new_os->shipped != old_os->shipped
                if (Validate::isLoadedObject($old_os) && Validate::isLoadedObject($new_os) && $new_os->shipped != $old_os->shipped && !Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')) {
                    $product_quantity = (int) ($product['product_quantity'] - $product['product_quantity_refunded'] - $product['product_quantity_return']);

                    if ($product_quantity > 0) {
                        $current_shop_context_type = Context::getContext()->shop->getContextType();
                        if ($current_shop_context_type !== Shop::CONTEXT_SHOP) {
                            //change to order shop context
                            $current_shop_group_id = Context::getContext()->shop->getContextShopGroupID();
                            Context::getContext()->shop->setContext(Shop::CONTEXT_SHOP, $order->id_shop);
                        }
                        (new StockManager())->saveMovement(
                            (int) $product['product_id'],
                            (int) $product['product_attribute_id'],
                            (int) $product_quantity * ($new_os->shipped == 1 ? -1 : 1),
                            [
                                'id_order' => $order->id,
                                'id_stock_mvt_reason' => ($new_os->shipped == 1 ? Configuration::get('PS_STOCK_CUSTOMER_ORDER_REASON') : Configuration::get('PS_STOCK_CUSTOMER_ORDER_CANCEL_REASON')),
                            ]
                        );
                        //back to current shop context
                        if ($current_shop_context_type !== Shop::CONTEXT_SHOP && isset($current_shop_group_id)) {
                            Context::getContext()->shop->setContext($current_shop_context_type, $current_shop_group_id);
                        }
                    }
                }
            }
        }

        $this->id_order_state = (int) $new_order_state;

        // changes invoice number of order ?
        if (!Validate::isLoadedObject($new_os) || !Validate::isLoadedObject($order)) {
            throw new PrestaShopException($this->trans('Invalid new order status', [], 'Admin.Orderscustomers.Notification'));
        }

        // the order is valid if and only if the invoice is available and the order is not cancelled
        $order->current_state = $this->id_order_state;
        $order->valid = $new_os->logable;
        $order->update();

        if ($new_os->invoice && !$order->invoice_number) {
            $order->setInvoice($use_existing_payment);
        } elseif ($new_os->delivery && !$order->delivery_number) {
            $order->setDeliverySlip();
        }

        // set orders as paid
        if ($new_os->paid == 1) {
            if ($order->total_paid != 0) {
                $payment_method = Module::getInstanceByName($order->module);
            }

            $invoices = $order->getInvoicesCollection();
            foreach ($invoices as $invoice) {
                /** @var OrderInvoice $invoice */
                $rest_paid = $invoice->getRestPaid();
                if ($rest_paid > 0) {
                    $payment = new OrderPayment();
                    $payment->order_reference = Tools::substr($order->reference, 0, 9);
                    $payment->id_currency = $order->id_currency;
                    $payment->amount = $rest_paid;
                    $payment->payment_method = isset($payment_method) && $payment_method instanceof Module ? $payment_method->displayName : null;
                    $payment->conversion_rate = $order->conversion_rate;
                    $payment->save();

                    // Update total_paid_real value for backward compatibility reasons
                    $order->total_paid_real += $rest_paid;
                    $order->save();

                    Db::getInstance()->insert(
                        'order_invoice_payment',
                        [
                            'id_order_invoice' => (int) $invoice->id,
                            'id_order_payment' => (int) $payment->id,
                            'id_order' => (int) $order->id,
                        ]
                    );
                }
            }
        }

        // updates delivery date even if it was already set by another state change
        if ($new_os->delivery) {
            $order->setDelivery();
        }

        // executes hook
        // Hook called only for the shop concerned
        Hook::exec('actionOrderStatusPostUpdate', [
            'newOrderStatus' => $new_os,
            'oldOrderStatus' => $old_os,
            'id_order' => (int) $order->id,
        ], null, false, true, false, $order->id_shop);

        // sync all stock
        (new StockManagerAdapter())->updatePhysicalProductQuantity(
            (int) $order->id_shop,
            (int) Configuration::get('PS_OS_ERROR'),
            (int) Configuration::get('PS_OS_CANCELED'),
            null,
            (int) $order->id
        );

        ShopUrl::resetMainDomainCache();
    }

    /**
     * @param bool $autodate Optional
     * @param array|bool $template_vars Optional
     * @param Context|null $context Deprecated
     *
     * @return bool
     */
    public function addWithemail($autodate = true, $template_vars = false, Context $context = null)
    {
        $order = new Order($this->id_order);

        if (!$this->add($autodate)) {
            return false;
        }
        Order::cleanHistoryCache();

        if (!$this->sendEmail($order, $template_vars)) {
            return false;
        }

        return true;
    }

    /**
     * @param Order $order
     * @param array|false $template_vars
     *
     * @return bool
     */

    public function sendEmail($order, $template_vars = false)
    {
        if($order->id_shop == 3){
            $result = Db::getInstance()->getRow('
                SELECT osl.`template`, c.`lastname`, c.`firstname`, osl.`name` AS osname, c.`email`, os.`module_name`, os.`id_order_state`, os.`pdf_invoice`, os.`pdf_delivery`
                FROM `' . _DB_PREFIX_ . 'order_history` oh
                    LEFT JOIN `' . _DB_PREFIX_ . 'orders` o ON oh.`id_order` = o.`id_order`
                    LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON o.`id_customer` = c.`id_customer`
                    LEFT JOIN `' . _DB_PREFIX_ . 'order_state` os ON oh.`id_order_state` = os.`id_order_state`
                    LEFT JOIN `' . _DB_PREFIX_ . 'order_state_lang` osl ON (os.`id_order_state` = osl.`id_order_state` AND osl.`id_lang` = o.`id_lang`)
                WHERE oh.`id_order_history` = ' . (int) $this->id . ' AND os.`send_email` = 1');
        }else{
            $result = Db::getInstance()->getRow('
                SELECT osl.`template`, c.`lastname`, c.`firstname`, osl.`name` AS osname, c.`email`, os.`module_name`, os.`id_order_state`, os.`pdf_invoice`, os.`pdf_delivery`
                FROM `' . _DB_PREFIX_ . 'order_history` oh
                    LEFT JOIN `' . _DB_PREFIX_ . 'orders` o ON oh.`id_order` = o.`id_order`
                    LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON o.`id_customer` = c.`id_customer`
                    LEFT JOIN `' . _DB_PREFIX_ . 'order_state` os ON oh.`id_order_state` = os.`id_order_state`
                    LEFT JOIN `' . _DB_PREFIX_ . 'order_state_lang` osl ON (os.`id_order_state` = osl.`id_order_state` AND osl.`id_lang` = o.`id_lang`)
                WHERE oh.`id_order_history` = ' . (int) $this->id . ' AND os.`id_order_state` IN (3,4,6,8,10)');
        }
        
        // echo 'SELECT osl.`template`, c.`lastname`, c.`firstname`, osl.`name` AS osname, c.`email`, os.`module_name`, os.`id_order_state`, os.`pdf_invoice`, os.`pdf_delivery`
        //         FROM `' . _DB_PREFIX_ . 'order_history` oh
        //             LEFT JOIN `' . _DB_PREFIX_ . 'orders` o ON oh.`id_order` = o.`id_order`
        //             LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON o.`id_customer` = c.`id_customer`
        //             LEFT JOIN `' . _DB_PREFIX_ . 'order_state` os ON oh.`id_order_state` = os.`id_order_state`
        //             LEFT JOIN `' . _DB_PREFIX_ . 'order_state_lang` osl ON (os.`id_order_state` = osl.`id_order_state` AND osl.`id_lang` = o.`id_lang`)
        //         WHERE oh.`id_order_history` = ' . (int) $this->id . ' AND os.`id_order_state` IN (2,3,4,6,7,8,9,10)';
        // echo Context::getContext()->shop->id;
        // echo '<br>';
        // echo $result['template'];
        // echo '<br>';
        // echo $result['email'];
        //         exit;

        if (isset($result['template']) && Validate::isEmail($result['email'])) {
            ShopUrl::cacheMainDomainForShop($order->id_shop);

            $topic = $result['osname'];
            $carrierUrl = '';
            if (Validate::isLoadedObject($carrier = new Carrier((int) $order->id_carrier, $order->id_lang))) {
                $carrierUrl = $carrier->url;
            }
            $data = [
                '{lastname}' => $result['lastname'],
                '{firstname}' => $result['firstname'],
                '{id_order}' => (int) $this->id_order,
                '{order_name}' => $order->getUniqReference(),
                '{followup}' => str_replace('@', $order->getShippingNumber() ?? '', $carrierUrl),
                '{shipping_number}' => $order->getShippingNumber(),
            ];

            if ($result['module_name']) {
                $module = Module::getInstanceByName($result['module_name']);
                if (Validate::isLoadedObject($module) && isset($module->extra_mail_vars) && is_array($module->extra_mail_vars)) {
                    $data = array_merge($data, $module->extra_mail_vars);
                }
            }

            if (is_array($template_vars)) {
                $data = array_merge($data, $template_vars);
            }

            $context = Context::getContext();
            $data['{total_paid}'] = Tools::getContextLocale($context)->formatPrice((float) $order->total_paid, Currency::getIsoCodeById((int) $order->id_currency));

            if (Validate::isLoadedObject($order)) {
                // Attach invoice and / or delivery-slip if they exists and status is set to attach them
                if (($result['pdf_invoice'] || $result['pdf_delivery'])) {
                    $currentLanguage = $context->language;
                    $orderLanguage = new Language((int) $order->id_lang);
                    $context->language = $orderLanguage;
                    $context->getTranslator()->setLocale($orderLanguage->locale);
                    $invoice = $order->getInvoicesCollection();
                    $file_attachement = [];

                    if ($result['pdf_invoice'] && (int) Configuration::get('PS_INVOICE') && $order->invoice_number) {
                        Hook::exec('actionPDFInvoiceRender', ['order_invoice_list' => $invoice]);
                        $pdf = new PDF($invoice, PDF::TEMPLATE_INVOICE, $context->smarty);
                        $file_attachement['invoice']['content'] = $pdf->render(false);
                        $file_attachement['invoice']['name'] = $pdf->getFilename();
                        $file_attachement['invoice']['mime'] = 'application/pdf';
                    }
                    if ($result['pdf_delivery'] && $order->delivery_number) {
                        $pdf = new PDF($invoice, PDF::TEMPLATE_DELIVERY_SLIP, $context->smarty);
                        $file_attachement['delivery']['content'] = $pdf->render(false);
                        $file_attachement['delivery']['name'] = $pdf->getFilename();
                        $file_attachement['delivery']['mime'] = 'application/pdf';
                    }

                    $context->language = $currentLanguage;
                    $context->getTranslator()->setLocale($currentLanguage->locale);
                } else {
                    $file_attachement = null;
                }
                // echo $this->id_order_state;
                
                if( ( $order->id_shop == 3 || $order->id_shop == 1 || $order->id_shop == 2) && ( in_array( $this->id_order_state , [ 10, 6, 25, 4] ) ) ) $data = $this->setConfOrderInfo();
                

                $base_url = _PS_BASE_URL_ . __PS_BASE_URI__; // Get shop base URL
                if($order->id_shop == 2) {
                    $payment_img = $base_url . 'img/asm/all_stars_bank_info_1.jpg';
                    $shop_facebook = $base_url . 'img/asm/socials/facebook_mail.jpg';
                    $shop_instagram = $base_url . 'img/asm/socials/insta_mail.jpg';
                    $shop_flickr = $base_url . 'img/asm/socials/flickr_mail.jpg';
                    $shop_youtube = $base_url . 'img/asm/socials/youtube_mail.jpg';

                    $data += [
                        '{shop_facebook}' => $shop_facebook ? $shop_facebook : '',
                        '{shop_instagram}' => $shop_instagram ? $shop_instagram : '',
                        '{shop_flickr}' => $shop_flickr ? $shop_flickr : '',
                        '{shop_youtube}' => $shop_youtube ? $shop_youtube : '',
                        '{payment_img}' => $payment_img ? $payment_img : '',
                    ];
                }

                if($order->id_shop == 1){
                    $payment_img = $base_url . 'img/asm/euromus_bank_info.jpg';
                }
                if($order->id_shop == 6){
                    $payment_img = $base_url . 'img/bankwire_info_eurorider.jpg';
                }

                




                
                if (!Mail::Send(
                    (int) $order->id_lang,
                    $result['template'],
                    $topic,
                    $data,
                    $result['email'],
                    $result['firstname'] . ' ' . $result['lastname'],
                    null,
                    null,
                    $file_attachement,
                    null,
                    _PS_MAIL_DIR_,
                    false,
                    (int) $order->id_shop
                )) {
                    return false;
                }
            }

            ShopUrl::resetMainDomainCache();
        }

        return true;
    }
    
    protected function getPartialRenderer()
    {
        return $this->partialRenderer = new MailPartialTemplateRenderer($this->context->smarty);
    }
    
    protected function getEmailTemplateContent($template_name, $mail_type, $var)
    {
        $email_configuration = Configuration::get('PS_MAIL_TYPE');
        if ($email_configuration != $mail_type && $email_configuration != Mail::TYPE_BOTH) {
            return '';
        }

        return $this->getPartialRenderer()->render($template_name, $this->context->language, $var);
    }

    public function setConfOrderInfo(){

        $order = new Order((int) $this->id_order);

        $invoice = new Address((int) $order->id_address_invoice);
        $delivery = new Address((int) $order->id_address_delivery);
        $delivery_state = $delivery->id_state ? new State((int) $delivery->id_state) : false;
        $invoice_state = $invoice->id_state ? new State((int) $invoice->id_state) : false;
        $carrier = $order->id_carrier ? new Carrier($order->id_carrier) : false;
        $orderLanguage = new Language((int) $order->id_lang);
        $order_status = new OrderState((int) $this->id_order_state, (int) $order->id_lang);
        $customer = new Customer((int) $order->id_customer);
        $currency = new Currency((int) $order->id_currency);

        $this->context = Context::getContext();
        
        $ProductDetailObject = new OrderDetail;
        $order_details = $ProductDetailObject->getList($order->id);
        
        $order_list = array();

            $virtual_product = true;

            $product_list = $order->getProducts();

            $product_var_tpl_list = [];
            foreach ($product_list as $product) {
                
                // echo '<pre>' . print_r($product, 1) . '</pre>';
                // exit;


                $price = Product::getPriceStatic((int) $product['id_product'], false, ($product['product_attribute_id'] ? (int) $product['product_attribute_id'] : null), 6, null, false, true, $product['product_quantity'], false, (int) $order->id_customer, (int) $order->id_cart, (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')}, $specific_price, true, true, null, true, $product['id_customization']);
                if($this->context->shop->id == 3){
                    $price_wt = $product['product_price'];
                }else{
                    $price_wt = Product::getPriceStatic((int) $product['id_product'], true, ($product['product_attribute_id'] ? (int) $product['product_attribute_id'] : null), 2, null, false, true, $product['product_quantity'], false, (int) $order->id_customer, (int) $order->id_cart, (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')}, $specific_price, true, true, null, true, $product['id_customization']);
                }

                $product_price = Product::getTaxCalculationMethod() == PS_TAX_EXC ? Tools::ps_round($product['product_price'], Context::getContext()->getComputingPrecision()) : $price_wt;
                

                $image_link= new Link();
                $image_url = $image_link->getImageLink($product['reference'], null, null, 'jpg', $product['id_product'], $product['id_manufacturer'], 'thumb');

                $product_var_tpl = [
                    'id_product' => $product['id_product'],
                    'id_product_attribute' => $product['product_attribute_id'],
                    'reference' => $product['reference'],
                    /**'name' => $product['product_name'] . (isset($product['attributes']) ? ' - ' . $product['attributes'] : ''),**/
                    'name' => $product['product_name'],
                    'price' => Tools::getContextLocale($this->context)->formatPrice($product_price * $product['product_quantity'], $this->context->currency->iso_code),
                    'quantity' => $product['product_quantity'],
                    'customization' => [],
                    'image_p' => $image_url,
                    'quantity_sent' => $product['product_quantity_sent'],
                ];

                if (isset($product['price']) && $product['price']) {
                    $product_var_tpl['unit_price'] = Tools::getContextLocale($this->context)->formatPrice($product_price, $this->context->currency->iso_code);
                    $product_var_tpl['unit_price_full'] = Tools::getContextLocale($this->context)->formatPrice($product_price, $this->context->currency->iso_code)
                        . ' ' . $product['unity'];
                } else {
                    $product_var_tpl['unit_price'] = $product_var_tpl['unit_price_full'] = '';
                }

                $customized_datas = Product::getAllCustomizedDatas((int) $order->id_cart, null, true, null, (int) $product['id_customization']);
                if (isset($customized_datas[$product['id_product']][$product['product_attribute_id']])) {
                    $product_var_tpl['customization'] = [];
                    foreach ($customized_datas[$product['id_product']][$product['product_attribute_id']][$order->id_address_delivery] as $customization) {
                        $customization_text = '';
                        if (isset($customization['datas'][Product::CUSTOMIZE_TEXTFIELD])) {
                            foreach ($customization['datas'][Product::CUSTOMIZE_TEXTFIELD] as $text) {
                                $customization_text .= '<strong>' . $text['name'] . '</strong>: ' . $text['value'] . '<br />';
                            }
                        }

                        if (isset($customization['datas'][Product::CUSTOMIZE_FILE])) {
                            $customization_text .= $this->trans('%d image(s)', [count($customization['datas'][Product::CUSTOMIZE_FILE])], 'Admin.Payment.Notification') . '<br />';
                        }

                        $customization_quantity = (int) $customization['quantity'];

                        $product_var_tpl['customization'][] = [
                            'customization_text' => $customization_text,
                            'customization_quantity' => $customization_quantity,
                            'quantity' => Tools::getContextLocale($this->context)->formatPrice($customization_quantity * $product_price, $this->context->currency->iso_code),
                        ];
                    }
                }

                $product_var_tpl_list[] = $product_var_tpl;
                // Check if is not a virtual product for the displaying of shipping
                if (!$product['is_virtual']) {
                    $virtual_product &= false;
                }
            }

            $product_list_txt = '';
            $product_list_html = '';
            if (count($product_var_tpl_list) > 0){
                if($this->context->shop->id === 3 ){
                    $product_list_txt = $this->getEmailTemplateContent('order_conf_product_list.txt', Mail::TYPE_TEXT, $product_var_tpl_list);
                    $product_list_html = $this->getEmailTemplateContent('order_conf_product_list_3.tpl', Mail::TYPE_HTML, $product_var_tpl_list);
                    $product_list_html_shipped = $this->getEmailTemplateContent('order_conf_product_list_1_shipped.tpl', Mail::TYPE_HTML, $product_var_tpl_list);
                }else if($this->context->shop->id === 1){
                    $product_list_txt = $this->getEmailTemplateContent('order_conf_product_list.txt', Mail::TYPE_TEXT, $product_var_tpl_list);
                    $product_list_html = $this->getEmailTemplateContent('order_conf_product_list.tpl', Mail::TYPE_HTML, $product_var_tpl_list);
                }else{
                    $product_list_txt = $this->getEmailTemplateContent('order_conf_product_list.txt', Mail::TYPE_TEXT, $product_var_tpl_list);
                    $product_list_html = $this->getEmailTemplateContent('order_conf_product_list.tpl', Mail::TYPE_HTML, $product_var_tpl_list);
                }
            }

            $total_reduction_value_ti = 0;
            $total_reduction_value_tex = 0;

            $cart_rules_list = array();

            /**$cart_rules_list = $this->createOrderCartRules(
                $order,
                $this->context->cart,
                $order_list,
                $total_reduction_value_ti,
                $total_reduction_value_tex,
                $id_order_state
            );**/

            $cart_rules_list_txt = '';
            $cart_rules_list_html = '';
            if (count($cart_rules_list) > 0) {
                $cart_rules_list_txt = $this->getEmailTemplateContent('order_conf_cart_rules.txt', Mail::TYPE_TEXT, $cart_rules_list);
                $cart_rules_list_html = $this->getEmailTemplateContent('order_conf_cart_rules.tpl', Mail::TYPE_HTML, $cart_rules_list);
            }

            

        $shop_id = $this->context->shop->id;
        $base_url = _PS_BASE_URL_ . __PS_BASE_URI__; // Get shop base URL
        
        // Get the email logo filename from Prestashop configuration
        $email_logo_filename = Configuration::get('PS_LOGO_MAIL', null, null, $shop_id);
        
        // If no custom email logo is set, fallback to the default one
        if (!$email_logo_filename) {
            $email_logo_filename = 'logo_mail.jpg'; // Default email logo
        }
        
        // Full email logo URL
        $email_logo_url = $base_url . 'img/' . $email_logo_filename;
            

        $data = [
            '{shop_logo}' => $email_logo_url,
            '{firstname}' => $customer->firstname,
            '{lastname}' => $customer->lastname,
            '{email}' => $customer->email,
            '{delivery_block_txt}' => $this->_getFormatedAddress($delivery, AddressFormat::FORMAT_NEW_LINE),
            '{invoice_block_txt}' => $this->_getFormatedAddress($invoice, AddressFormat::FORMAT_NEW_LINE),
            '{delivery_block_html}' => $this->_getFormatedAddress($delivery, '<br />', [
                'firstname' => '<span style="font-weight:bold;">%s</span>',
                'lastname' => '<span style="font-weight:bold;">%s</span>',
            ]),
            '{invoice_block_html}' => $this->_getFormatedAddress($invoice, '<br />', [
                'firstname' => '<span style="font-weight:bold;">%s</span>',
                'lastname' => '<span style="font-weight:bold;">%s</span>',
            ]),
            '{delivery_company}' => $delivery->company,
            '{delivery_firstname}' => $delivery->firstname,
            '{delivery_lastname}' => $delivery->lastname,
            '{delivery_address1}' => $delivery->address1,
            '{delivery_address2}' => $delivery->address2,
            '{delivery_city}' => $delivery->city,
            '{delivery_postal_code}' => $delivery->postcode,
            '{delivery_country}' => $delivery->country,
            '{delivery_state}' => $delivery->id_state ? $delivery_state->name : '',
            '{delivery_phone}' => ($delivery->phone) ? $delivery->phone : $delivery->phone_mobile,
            '{delivery_other}' => $delivery->other,
            '{invoice_company}' => $invoice->company,
            '{invoice_vat_number}' => $invoice->vat_number,
            '{invoice_firstname}' => $invoice->firstname,
            '{invoice_lastname}' => $invoice->lastname,
            '{invoice_address2}' => $invoice->address2,
            '{invoice_address1}' => $invoice->address1,
            '{invoice_city}' => $invoice->city,
            '{invoice_postal_code}' => $invoice->postcode,
            '{invoice_country}' => $invoice->country,
            '{invoice_state}' => $invoice->id_state ? $invoice_state->name : '',
            '{invoice_phone}' => ($invoice->phone) ? $invoice->phone : $invoice->phone_mobile,
            '{invoice_other}' => $invoice->other,
            '{order_name}' => $order->getUniqReference(),
            '{id_order}' => $order->id,
            '{date}' => Tools::displayDate(date('Y-m-d H:i:s'), true),
            '{carrier}' => (!isset($carrier->name)) ? $this->trans('No carrier', [], 'Admin.Payment.Notification') : $carrier->name,
            '{payment}' => Tools::substr($order->payment, 0, 255) . ($order->hasBeenPaid() ? '' : '&nbsp;' . $this->trans('(waiting for validation)', [], 'Emails.Body')),
            '{products}' => $product_list_html,
            '{products_shipped}' => $product_list_html_shipped,
            '{products_txt}' => $product_list_txt,
            '{discounts}' => $cart_rules_list_html,
            '{discounts_txt}' => $cart_rules_list_txt,
            '{total_paid}' => Tools::getContextLocale($this->context)->formatPrice($order->total_paid, $currency->iso_code),
            '{total_paid_tax_excl}' => Tools::getContextLocale($this->context)->formatPrice($order->total_paid_tax_excl, $currency->iso_code),
            '{total_shipping_tax_excl}' => Tools::getContextLocale($this->context)->formatPrice($order->total_shipping_tax_excl, $currency->iso_code),
            '{total_shipping_tax_incl}' => Tools::getContextLocale($this->context)->formatPrice($order->total_shipping_tax_incl, $currency->iso_code),
            '{total_tax_paid}' => Tools::getContextLocale($this->context)->formatPrice(($order->total_paid_tax_incl - $order->total_paid_tax_excl), $currency->iso_code),
            '{recycled_packaging_label}' => $order->recyclable ? $this->trans('Yes', [], 'Shop.Theme.Global') : $this->trans('No', [], 'Shop.Theme.Global'),
            '{message}' => $order->getFirstMessage() ? $order->getFirstMessage() : '---',
            
            '{note}' => $this->getNote($order->id),
            '{message_payment}' => $this->getMessage($order->payment_id,$order->reference,$order->id_lang),
            '{shipping_number}' => $order->getWsShippingNumber(),

        ];

        if (Product::getTaxCalculationMethod() == PS_TAX_EXC) {
            $data = array_merge($data, [
                '{total_products}' => Tools::getContextLocale($this->context)->formatPrice($order->total_products, $currency->iso_code),
                '{total_discounts}' => Tools::getContextLocale($this->context)->formatPrice($order->total_discounts_tax_excl, $currency->iso_code),
                '{total_shipping}' => Tools::getContextLocale($this->context)->formatPrice($order->total_shipping_tax_excl, $currency->iso_code),
                '{total_wrapping}' => Tools::getContextLocale($this->context)->formatPrice($order->total_wrapping_tax_excl, $currency->iso_code),
            ]);
        } else {
            $data = array_merge($data, [
                '{total_products}' => Tools::getContextLocale($this->context)->formatPrice($order->total_products_wt, $currency->iso_code),
                '{total_discounts}' => Tools::getContextLocale($this->context)->formatPrice($order->total_discounts, $currency->iso_code),
                '{total_shipping}' => Tools::getContextLocale($this->context)->formatPrice($order->total_shipping, $currency->iso_code),
                '{total_wrapping}' => Tools::getContextLocale($this->context)->formatPrice($order->total_wrapping, $currency->iso_code),
            ]);
        }

        return $data;

    }

    public function getMessage($payment_id,$reference,$lang) {
        if($payment_id == 2){
            $message =
            '<table style="text-align:center;width:100%;">
                    <tr>
                        <td style="text-align:center;">
                            <p>';
                                
            if($lang == 1){
                 $message .= 'Tendo selecionado o cartão de crédito como método de pagamento desta encomenda, encontrará abaixo um link que lhe permitirá efetuar o pagamento através da plataforma de débito do nosso parceiro financeiro. Este link totalmente seguro estará ativo apenas durante 48 horas e atualizará automaticamente o estado do seu pedido assim que for validado.'; 
            }else if($lang == 2){
                $message .= 'As you selected credit card as payment method for this order, you will find below a link that will allow you to make the payment through our financial partner platform. This completely secure link will be active only for 48 hours and will automatically update the status of your order once validated.'; 
            }else if($lang == 4){
                $message .= 'Habiendo seleccionado la tarjeta de crédito como método de pago para este pedido, encontrará a continuación un enlace que le permitirá realizar el pago a través de la plataforma de débito de nuestro socio financiero. Este enlace completamente seguro estará activo solo durante 48 horas y actualizará automáticamente el estado de su pedido una vez validado.'; 
            }else if($lang == 5){
                $message .= 'Ayant sélectionné carte bancaire comme mode de paiement pour cette commande, vous trouverez ci-dessous un lien cliquable vous permettant d\'effectuer votre paiement via la plateforme de débit de notre partenaire financier. Ce lien complètement sécurisé sera actif durant 48h uniquement et actualisera automatiquement le statut de votre commande une fois validé.'; 
            }else if($lang == 7){
                $message .= 'Avendo selezionato la carta di credito come metodo di pagamento per questo ordine, troverai di seguito un collegamento che ti permetterà di effettuare il pagamento tramite la piattaforma di addebito del nostro partner finanziario. Questo collegamento completamente sicuro sarà attivo solo per 48 ore e aggiornerà automaticamente lo stato del tuo ordine una volta convalidato.'; 
            }else{
                $message .= 'As you selected credit card as payment method for this order, you will find below a link that will allow you to make the payment through our financial partner platform. This completely secure link will be active only for 48 hours and will automatically update the status of your order once validated.'; 
            }
                  
            $message .= '</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;padding-top:20px;">
                        
                            <a href="http://webtools.all-stars-motorsport.com/customTools/worldline/validate?order_reference='.$reference.'" style="background-color: #0273eb; color: white; padding: .5rem 1rem; border: none; cursor: pointer;border-radius: .25rem;">';
                                
                                
                                if($lang == 1){
                 $message .= 'Link'; 
            }else if($lang == 2){
                $message .= 'Link'; 
            }else if($lang == 4){
                $message .= 'Enlace'; 
            }else if($lang == 5){
                $message .= 'Lien'; 
            }else if($lang == 7){
                $message .= 'Collegamento'; 
            }else{
                $message .= 'Link'; 
            }
                                
                                
                          $message .= '</a>
                        </td>
                    </tr>
                </table>';
                
         return $message;
        }else{
            $message = '<p>';
            
            if($lang == 1){
                 $message .= 'Tendo selecionado a transferência bancária como método de pagamento desta encomenda, solicitamos que efetue esta transferência para a nossa conta portuguesa (Banco Millennium BCP) através dos dados bancários fornecidos aquando da criação da sua conta de revendedor. Qualquer e-mail a solicitar pagamento para outra conta deve ser considerado fraudulento. Não hesite em contactar-nos para mais informações.'; 
            }else if($lang == 2){
                $message .= 'As you selected bank transfer as payment method for this order, we kindly ask you to make this transfer to our Portuguese account (Millennium BCP Bank) via the bank details provided when creating your dealer account. Any email requesting payment to another account should be considered fraudulent. Do not hesitate to contact us for more information.'; 
            }else if($lang == 4){
                $message .= 'Habiendo seleccionado la transferencia bancaria como método de pago para este pedido, le rogamos que realice esta transferencia a nuestra cuenta portuguesa (Millennium BCP Bank) a través de los datos bancarios proporcionados al crear su cuenta de revendedor. Cualquier correo electrónico solicitando pago a otra cuenta debe considerarse fraudulento. No dude en contactarnos para más información.'; 
            }else if($lang == 5){
                $message .= 'Ayant sélectionné virement bancaire comme mode paiement pour cette commande, nous vous prions de bien vouloir effectuer ce transfert de fonds vers notre compte portugais (Millennium BCP Bank) via les coordonnées bancaires fournies lors de la création de votre compte revendeur. Tout email demandant un paiement vers un autre compte doit être considéré comme frauduleux. N\'hésitez pas à nous contacter pour plus d\'informations.'; 
            }else if($lang == 7){
                $message .= 'Avendo selezionato il bonifico bancario come metodo di pagamento per questo ordine, ti chiediamo gentilmente di effettuare questo trasferimento di fondi sul nostro conto portoghese (Millennium BCP Bank) tramite le coordinate bancarie fornite durante la creazione del tuo account rivenditore. Qualsiasi e-mail che richieda il pagamento su un altro account dovrebbe essere considerata fraudolenta. Non esitate a contattarci per ulteriori informazioni.'; 
            }else{
                $message .= 'As you selected bank transfer as payment method for this order, we kindly ask you to make this transfer to our Portuguese account (Millennium BCP Bank) via the bank details provided when creating your dealer account. Any email requesting payment to another account should be considered fraudulent. Do not hesitate to contact us for more information.'; 
            }
            
            $message .= '</p>';
            
         return $message;
        }

    }

    public function getNote($id_order) {
        $query = new DbQuery();
        $query->select('note');
        $query->from('orders');
        $query->where('id_order = ' . $id_order);

        $order = Db::getInstance()->getValue($query);
        
        if( strlen($order) < 3) $order = '---';
        
        return $order;
    }

    protected function _getFormatedAddress(Address $the_address, $line_sep, $fields_style = [])
    {
        return AddressFormat::generateAddress($the_address, ['avoid' => []], $line_sep, ' ', $fields_style);
    }

    public function add($autodate = true, $null_values = false)
    {
        if (!parent::add($autodate)) {
            return false;
        }

        $order = new Order((int) $this->id_order);
        // Update id_order_state attribute in Order
        $order->current_state = $this->id_order_state;
        $order->update();

        // Hook called only for the shop concerned
        Hook::exec('actionOrderHistoryAddAfter', ['order_history' => $this], null, false, true, false, $order->id_shop);

        return true;
    }

    /**
     * @return int
     */
    public function isValidated()
    {
        return (int) Db::getInstance()->getValue('
        SELECT COUNT(oh.`id_order_history`) AS nb
        FROM `' . _DB_PREFIX_ . 'order_state` os
        LEFT JOIN `' . _DB_PREFIX_ . 'order_history` oh ON (os.`id_order_state` = oh.`id_order_state`)
        WHERE oh.`id_order` = ' . (int) $this->id_order . '
        AND os.`logable` = 1');
    }

    /**
     * Add method for webservice create resource Order History
     * If sendemail=1 GET parameter is present sends email to customer otherwise does not.
     *
     * @return bool
     */
    public function addWs()
    {
        $sendemail = (bool) Tools::getValue('sendemail', false);
        $this->changeIdOrderState($this->id_order_state, $this->id_order);
        
        // echo $sendemail;
        // echo (Tools::usingSecureMode() && Configuration::get('PS_SSL_ENABLED'));
        // exit;

        if ($sendemail) {
            //Mail::Send requires link object on context and is not set when getting here
            $context = Context::getContext();
            if ($context->link == null) {
                $protocol_link = (Tools::usingSecureMode() && Configuration::get('PS_SSL_ENABLED')) ? 'https://' : 'http://';
                $protocol_content = (Tools::usingSecureMode() && Configuration::get('PS_SSL_ENABLED')) ? 'https://' : 'http://';
                $context->link = new Link($protocol_link, $protocol_content);
            }

            return $this->addWithemail();
        } else {
            return $this->add();
        }
    }
}