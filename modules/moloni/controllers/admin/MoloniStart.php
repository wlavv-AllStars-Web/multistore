<?php
/**
 * 2020 - moloni.pt
 *
 * NOTICE OF LICENSE
 *
 * This file is licenced under the Software License Agreement.
 * With the purchase or the installation of the software in your application
 * you accept the licence agreement.
 *
 * You must not modify, adapt or create derivative works of this source code
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    Nuno Almeida
 * @copyright Nuno Almeida
 * @license   https://creativecommons.org/licenses/by-nd/4.0/  Attribution-NoDerivatives 4.0 International (CC BY-ND 4.0)
 */

use Moloni\Classes\Curl;
use Moloni\Classes\General;
use Moloni\Classes\MoloniError;
use Moloni\Classes\Start;
use Moloni\Services\Orders\FetchPendingOrders;
use Moloni\Facades\ModuleFacade;

class MoloniStartController extends ModuleAdminController
{
    public $moloniTpl;

    public function __construct()
    {
        parent::__construct();

        ModuleFacade::setModule($this->module);

        $this->bootstrap = true;
        $this->className = 'Moloni';
        $this->context = Context::getContext();

        $moloni = new Start();
        $functions = new General();

        if (!$this->ajax) {
            $this->moloniTpl = $moloni->template;

            $companies = null;
            $message = array();
            $resultPrev = array();

            #Gerar o documento
            if (Tools::getValue('action') && Tools::getValue('action') === 'submitPreview') {
                $result = $functions->submitPreview();
            }

            if (Tools::getValue('action') && Tools::getValue('action') === 'preview'&& Tools::getValue('id_order')) {
                $resultPrev = $functions->getPreview(Tools::getValue('id_order'));
                $configurations = $functions->getConfigsAll();
                $this->moloniTpl = 'preview';
            }

            if (Tools::getValue('action') && Tools::getValue('action') === "create" && Tools::getValue('id_order')) {
                $result = $functions->makeInvoice(Tools::getValue('id_order'));
                if (MoloniError::$exists) {
                    $message['error'] = MoloniError::$message;
                } else {
                    $message['success'] = $result;
                }
            }

            if (Tools::getValue('action') && Tools::getValue('action') === "clean" && Tools::getValue('id_order')) {
                $result = $functions->cleanInvoice(Tools::getValue('id_order'));
                $message['success'] = $result;
            }

            if (Tools::getValue('action') && Tools::getValue('action') === "cleanAnulate" && Tools::getValue('id_order')) {
                $result = $functions->cleanInvoiceAnulate(Tools::getValue('id_order'));
                $message['success'] = $result;
            }

            if ($this->moloniTpl === 'company') {
                $companies = $functions->getCompaniesAll();
            }

            $this->context->smarty->assign([
                'moloni' => [
                    'path' => [
                        'img' => '../modules/moloni/views/img/',
                        'css' => '../modules/moloni/views/css/',
                        'js' => '../modules/moloni/views/js/'
                    ],
                    'companies' => $companies,
                    'message' => $message,
                    'resultPrev' => $resultPrev,
                    'configurations' => $configurations,
                    'version' => $this->module->version,
                ],
                'html' => $moloni->template
            ]);

            $this->context->smarty->assign([
                'resultPrev' => $resultPrev
            ]);

            if (defined("MOLONI_ERROR_LOGIN")) {
                $this->context->smarty->assign([
                    'moloni_error' => [
                        'login' => "login-errado",
                    ],
                    'curl_logs' => json_encode(Curl::getLogs(), JSON_PRETTY_PRINT)
                ]);
            }
        }
    }

    // public function postProcess()
    // {
                    
    //         if (Tools::getValue('ajax') && Tools::isSubmit('action') && Tools::getValue('action') === 'getdataPreview') {
    //             $documentSetId = Tools::getValue('document_set_id');
                
    //             // Call the General class to get the data
    //             $data = General::getDocumentSetData($documentSetId);
    
    //             // Return JSON response
    //             header('Content-Type: application/json');
    //             echo json_encode($data);
    //             exit;
    //         }

    // }

    public function displayAjax()
    {
        echo json_encode((new FetchPendingOrders(Tools::getAllValues()))->run());
    }

    public function initContent()
    {
        parent::initContent();
    }

    public function renderList()
    {
        return $this->module->display(_PS_MODULE_DIR_ . 'moloni', 'views/templates/admin/' . $this->moloniTpl . '.tpl');
    }
}
