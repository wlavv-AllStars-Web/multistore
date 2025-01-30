<?php
class asg_cars extends Module
{
    public function __construct()
    {
        $this->name = "asg_cars";
        $this->tab = "front_office_features";
        $this->version = "1.0.0";
        $this->author = "All Stars Group";
        $this->need_instance = 0;
        $this->secure_key = Tools::encrypt($this->name);
        $this->bootstrap = true;
        $this->displayName = $this->l('ASG - CARS');
        $this->description = $this->l('Tool to create cms cars');
        parent::__construct();
        $this->ps_versions_compliancy = [
            'min' => '8.0.0',
            'max' => _PS_VERSION_,
        ];
    }
	
    public function install()
    {
        if (!parent::install() || !$this->registerHook('displayAsgCars') || !$this->registerHook('actionAdminControllerSetMedia')) return false;

		$tab = new Tab();
		$tab->active = 1;
		$tab->class_name = 'AdminAsgCars';
		$tab->position = 3;
		foreach (Language::getLanguages(true) as $lang) $tab->name[$lang['id_lang']] = 'ASG CARS';
		$tab->id_parent = (int) Tab::getIdFromClassName('IMPROVE');
		$tab->module = $this->name;
		$tab->add();
		$tab->save();

       // Create the table for asg_cars
        $sql = "CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "asg_cars` (
            `id_asg_car` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_shop` INT UNSIGNED NOT NULL,
            `name` VARCHAR(255) NOT NULL,
            `car_name_galleries` VARCHAR(255) NOT NULL,
            `description_en` VARCHAR(255),
            `description_es` VARCHAR(255),
            `description_fr` VARCHAR(255),
            `description_pt` VARCHAR(255),
            `description_it` VARCHAR(255),
            `budget_en` VARCHAR(255),
            `budget_es` VARCHAR(255),
            `budget_fr` VARCHAR(255),
            `budget_pt` VARCHAR(255),
            `budget_it` VARCHAR(255),
            `images` TEXT,
            `display` TINYINT(1) NOT NULL DEFAULT 0,
            `position` TINYINT(1) NOT NULL DEFAULT 0,
            `created_at` DATETIME NOT NULL,
            PRIMARY KEY (`id_asg_car`)
        ) ENGINE=" . _MYSQL_ENGINE_ . " DEFAULT CHARSET=utf8;";

        // Create the table for asg_cars_product
        $sql2 = "CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "asg_cars_product` (
            `id_asg_car_product` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_asg_car` INT UNSIGNED NOT NULL,
            `name` VARCHAR(255) NOT NULL,
            `category` VARCHAR(255) NOT NULL,
            `id_lang` INT UNSIGNED NOT NULL,
            `link` TEXT DEFAULT NULL,
            `id_product` INT UNSIGNED,
            `created_at` DATETIME NOT NULL,
            PRIMARY KEY (`id_asg_car_product`),
            FOREIGN KEY (`id_asg_car`) REFERENCES `" . _DB_PREFIX_ . "asg_cars` (`id_asg_car`) ON DELETE CASCADE
        ) ENGINE=" . _MYSQL_ENGINE_ . " DEFAULT CHARSET=utf8;";

        // Execute the SQL queries
        if (!Db::getInstance()->execute($sql)) {
        return false;
        }

        if (!Db::getInstance()->execute($sql2)) {
        return false;
        }

        return true;
    }
	
    public function uninstall()
    {
        if (!parent::uninstall() || !$this->unregisterHook('displayAsgCars') || !$this->unregisterHook('actionAdminControllerSetMedia')) {
            return false;
        }

        // Remove the admin tab
        $id_tab = (int) Tab::getIdFromClassName('AdminAsgCars');
        if ($id_tab) {
            $tab = new Tab($id_tab);
            $tab->delete();
        }

        // Drop the table
        $sql = "DROP TABLE IF EXISTS `" . _DB_PREFIX_ . "asg_cars`;";
        if (!Db::getInstance()->execute($sql)) {
            return false;
        }

        $sql2 = "DROP TABLE IF EXISTS `" . _DB_PREFIX_ . "asg_cars_product`;";
        if (!Db::getInstance()->execute($sql2)) {
            return false;
        }

        return true;
    }

    public function hookActionAdminControllerSetMedia()
    {
        $this->context->controller->addCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css');
        $this->context->controller->addJs('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js');
        $this->context->controller->addJs('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js');
        $this->context->controller->addJs('https://cdn.jsdelivr.net/npm/lenis@1.1.20/dist/lenis.min.js');
        $this->context->controller->addJs('https://code.jquery.com/ui/1.12.1/jquery-ui.js');
    }

    public function hookDisplayAsgCars()
    {
        // Fetch car data
        $cars = Db::getInstance()->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'asg_cars` WHERE `display` = 1 ORDER BY position ASC');

        foreach ($cars as &$car) {
            
            if (!empty($car['images'])) {
                $car['images'] = json_decode($car['images'], true);
            }

            $car['products'] = Db::getInstance()->executeS('SELECT * FROM `' . _DB_PREFIX_ . 'asg_cars_product` WHERE `id_asg_car` = ' . (int)$car['id_asg_car']);
        }

        // Assign data to Smarty
        $this->context->smarty->assign([
            'cars' => $cars,
        ]);

        // Return rendered template
        return $this->display(__FILE__, 'views/templates/front/cms.tpl');
    }

	
}