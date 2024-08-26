<?php
class asdmodule_homepage extends Module{
    
    public function __construct(){
        $this->name = "asdmodule_homepage";
        $this->tab = "front_office_features";
        $this->version = "1.0.0";
        $this->author = "Bruno Fernandes - All Stars Distribution";
        $this->need_instance = 0;
        $this->secure_key = Tools::encrypt($this->name);
        $this->bootstrap = true;
        $this->module_key = '109266ed154d174c4856ec182d55ecHo';
        $this->displayName = $this->l('ASD - Homepage Module');
        $this->description = $this->l('Proprietary module - All Stars Distribution');
        parent::__construct();
    }
	
    public function install(){
        if (parent::install() == false) return false;

		$tab = new Tab();
		$tab->active = 1;
		$tab->class_name = 'AdminASDModuleHomepage';
		$tab->position = 3;
		$tab->name = array();
		foreach (Language::getLanguages(true) as $lang) $tab->name[$lang['id_lang']] = 'ASD Homepage';
		$tab->id_parent = (int) Tab::getIdFromClassName('IMPROVE');
		$tab->module = $this->name;
		$tab->add();
		$tab->save();

        return true;
    }
	
    public function uninstall(){
        if (parent::uninstall() == false) return false;
        return true;
    }
	
}