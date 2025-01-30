<?php
class asd_alert_messages extends Module
{
    public function __construct()
    {
        $this->name = "asd_alert_messages";
        $this->tab = "front_office_features";
        $this->version = "1.0.0";
        $this->author = "All Stars Distribution";
        $this->need_instance = 0;
        $this->secure_key = Tools::encrypt($this->name);
        $this->bootstrap = true;
        $this->module_key = '109266ed154d174c4856ec182d55ec5e';
        $this->displayName = $this->l('ASD - Alert Messages');
        $this->description = $this->l('Professional');
        parent::__construct();
    }
	
    public function install()
    {
        if (parent::install() == false) return false;

		$tab = new Tab();
		$tab->active = 1;
		$tab->class_name = 'AdminWmModuleAlertMessages';
		$tab->position = 3;
		$tab->name[1] = 'ASD - Alert Messages';
		$tab->name[2] = 'ASD - Alert Messages';
		$tab->name[3] = 'ASD - Alert Messages';
		$tab->name[4] = 'ASD - Alert Messages';
		$tab->name[5] = 'ASD - Alert Messages';
		$tab->id_parent = (int) Tab::getIdFromClassName('IMPROVE');
		$tab->module = $this->name;
        $tab->icon = 'notifications';
		$tab->add();
		$tab->save();

        return true;
    }
	
    public function uninstall()
    {
        if (parent::uninstall() == false) return false;
        return true;
    }
	
}