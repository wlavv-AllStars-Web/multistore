<?php
class AdminASDModuleHomepageController extends AdminController{
    
    public function __construct(){
		$this->identifier= 'id';
		$this->bootstrap = true;        
		$this->table = 'asdhomepage';        
		$this->lang = false;        
		$this->_orderWay = $this->_defaultOrderWay;        
		parent::__construct();
        $this->context = Context::getContext();
        $this->default_form_language = $this->context->language->id;
		$this->explicitSelect = true;
		$this->_select = 'id_order';
		$this->_where = 'AND `current_state` = 10';
        $this->_default_pagination = 50;
    }

    public function initContent(){
        
        parent::initContent();
		include dirname(__FILE__) . '/../../classes/ASDModuleHomepageMain.php';
        $template_file = _PS_MODULE_DIR_. 'asdmodule_homepage/views/templates/admin/view.tpl';
        $this->addJS(_PS_MODULE_DIR_ . '/asdmodule_homepage/views/templates/admin/js/picking.js');
		$this->context->smarty->assign("asd_page_name", 'Homepage');
		$this->context->smarty->assign("asd_page_name", 'Homepage');
		$this->context->smarty->assign("data", Db::getInstance()->getRow('SELECT * FROM '._DB_PREFIX_.'asd_homepage WHERE id=1'));
        $this->context->smarty->assign(array( 'content' =>  $this->context->smarty->fetch($template_file) ));
    }

    public function postProcess(){
        
        $data = Tools::getAllValues();
        
        if(isset($data['action']) && ($data['action'] == 'update')){
            
            if(isset($_FILES['homepage_banner']['name']) && ($_FILES['homepage_banner']['name'] !='')){

                $file_object = array();

                $file_object['type'] = $_FILES['homepage_banner']['type'];
                $file_object['tmp_name'] = $_FILES['homepage_banner']['tmp_name'];
                $file_object['error'] = $_FILES['homepage_banner']['error'];
                $file_object['size'] = $_FILES['homepage_banner']['size'];
                
                $full_final_path = $_SERVER['DOCUMENT_ROOT'] . '/img/asd/homepage/main.webp';
                
                if(file_exists($full_final_path)) unlink($full_final_path);
                
                if (!move_uploaded_file($file_object['tmp_name'], $full_final_path)) {
                }else{
                    move_uploaded_file($file_object['tmp_name'], $full_final_path);
                    
                }
                
            }
            
            if(isset($_FILES['footer_banner']['name']) && ($_FILES['footer_banner']['name'] !='')){

            	$file_object = array();
                $file_object['type'] = $_FILES['footer_banner']['type'];
                $file_object['tmp_name'] = $_FILES['footer_banner']['tmp_name'];
                $file_object['error'] = $_FILES['footer_banner']['error'];
                $file_object['size'] = $_FILES['footer_banner']['size'];

                $full_final_path = $_SERVER['DOCUMENT_ROOT'] . '/img/asd/Events/main_250x100.webp';
                
                if(file_exists($full_final_path)) unlink($full_final_path);

                if (!move_uploaded_file($file_object['tmp_name'], $full_final_path)) {
                }else{
                    move_uploaded_file($file_object['tmp_name'], $full_final_path);
                    
                }
            }
            
    		Db::getInstance()->getRow("UPDATE "._DB_PREFIX_."asd_homepage SET `link_banner`='" . $data['link_banner'] . "',`alt_banner`='" . $data['alt_banner'] . "',`link_footer`='" . $data['link_footer'] . "',`alt_footer`='" . $data['alt_footer'] . "' WHERE id=1");
        }

        
        
        /*$file_object = array();
        $file_object['name'] = $data['id'];
        $file_object['type'] = $_FILES['fileUpload_fr']['type'];
        $file_object['tmp_name'] = $_FILES['fileUpload_fr']['tmp_name'];
        $file_object['error'] = $_FILES['fileUpload_fr']['error'];
        $file_object['size'] = $_FILES['fileUpload_fr']['size'];

        $ext = substr($_FILES['fileUpload_fr']['name'], strrpos($_FILES['fileUpload_fr']['name'] , '.') + 1);
        $full_final_path = '/home/allstar1/public_html/img/homepage/' . $data['type'] . '/' . $data['id'] . '_fr.' . $ext;
        
        if (!move_uploaded_file($file_object['tmp_name'], $full_final_path)) {
            
        }else{
            move_uploaded_file($file_object['tmp_name'], $full_final_path);
            move_uploaded_file($file_object['name'], $full_final_path);
        }
        
        $image_fr = "https://" . $_SERVER['SERVER_NAME'] . '/img/homepage/' . $data['type'] . '/' . $data['id'] . '_fr.' . $ext;*/

    }

}