<?php
class AdminWmModuleAlertMessagesController extends AdminController{
    
    public function __construct(){
        $this->bootstrap = true;
        parent::__construct();
        $this->context = Context::getContext();
    }

    public function initContent(){
        parent::initContent();
        include dirname(__FILE__).'/../../classes/WmModuleMain.php';
        $this->context->smarty->assign("wm_page_name", 'Alert Messages');
        $this->context->smarty->assign("messages", Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT * FROM ps_asd_alert_messages WHERE deleted = 0'));
        $content = $this->context->smarty->fetch(_PS_MODULE_DIR_. 'asd_alert_messages/views/templates/admin/view.tpl');
        $this->context->smarty->assign("content", $content);
    }
    
    public function postProcess(){
        if(Tools::getValue('action') == 'saveMessage') return self::saveMessage();
        elseif(Tools::getValue('action') == 'deleteMessage') return self::deleteMessage();
    }
    
    public function saveMessage(){

        if(Tools::getValue('id') == 0){

            Db::getInstance(_PS_USE_SQL_SLAVE_)->execute('INSERT INTO ps_asd_alert_messages(title, title_en, title_es, title_fr, title_pt, title_it, message_type, message_status, message_en, message_es, message_fr, message_ro, message_pt, message_it) VALUES ("' . Tools::getValue('title') . '", "' . Tools::getValue('title_en') . '","' . Tools::getValue('title_es') . '","' . Tools::getValue('title_fr') . '","' . Tools::getValue('title_pt') . '","' . Tools::getValue('title_it') . '",' . Tools::getValue('message_type') . ', ' . Tools::getValue('message_status') . ', "' . Tools::getValue('message_en') . '", "' . Tools::getValue('message_es') . '", "' . Tools::getValue('message_fr') . '", "' . Tools::getValue('message_ro') . '", "' . Tools::getValue('message_pt') . '", "' . Tools::getValue('message_it') . '")');
            // header('Location: '.$_SERVER['REQUEST_URI']);
        }else{
            Db::getInstance(_PS_USE_SQL_SLAVE_)->execute('UPDATE ps_asd_alert_messages SET title="' . Tools::getValue('title') . '",title_en="' . Tools::getValue('title_en') . '",title_es="' . Tools::getValue('title_es') . '",title_fr="' . Tools::getValue('title_fr') . '",title_pt="' . Tools::getValue('title_pt') . '",title_it="' . Tools::getValue('title_it') . '",message_type="' . Tools::getValue('message_type') . '", message_status=' . Tools::getValue('message_status') . ', message_en="' . Tools::getValue('message_en') . '", message_es="' . Tools::getValue('message_es') . '", message_fr="' . Tools::getValue('message_fr') . '", message_ro="' . Tools::getValue('message_ro') . '", message_pt="' . Tools::getValue('message_pt') . '", message_it="' . Tools::getValue('message_it') . '" WHERE id=' . Tools::getValue('id'));
        }
        
        // return 1;
    }
    
    public function deleteMessage(){
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute("UPDATE `ps_asd_alert_messages` SET `deleted`=1, deleted_date=NOW()  WHERE id=" . Tools::getValue('id'));
    }
    
    public function hookDisplayBackOfficeHeader()
    {
       $this->context->controller->addCss($this->_path.'css/tab.css');
    }
}