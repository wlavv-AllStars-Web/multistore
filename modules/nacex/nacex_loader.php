<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class NacexLoader {

    private static $nacex_loader;
    
    private $expDAO;
    private $config;
    private $rateDAO;
    private $zones_controller;
    
    public function __construct() {
        /*require_once(dirname(__FILE__).'/app/models/expedition_dao.php');
        require_once(dirname(__FILE__).'/app/utils/service_factory.php');
        require_once(dirname(__FILE__).'/app/controllers/config_menu.php');
        require_once(dirname(__FILE__).'/app/models/rate_dao.php');
        require_once(dirname(__FILE__).'/app/controllers/nacex_zones_controller.php');
        
        $this->expDAO = &ServiceFactory::get_instance()->get(ExpeditionDAO::class);
        $this->config = &ServiceFactory::get_instance()->get(ConfigMenu::class);
        $this->rateDAO = &ServiceFactory::get_instance()->get(RateDAO::class);
	    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		    $this->zones_controller = &ServiceFactory::get_instance()->get(NacexZonesController::class);
	    }*/
    }
    
    public static function get_instance() {
        if (!self::$nacex_loader instanceof self) {
            self::$nacex_loader = new self;
        }
        return self::$nacex_loader;
    }

    public function activate() {
    	if ($this->expDAO->needs_migration()) {
		    $migrated = $this->expDAO->migrate_table();
		    if (!$migrated) {
		    	return false;
		    }
	    } else if (!$this->expDAO->exists_table()) {
    		$created = $this->expDAO->create_table(ExpeditionDAO::TABLE);
    		if (!$created) {
    			return false;
		    }
	    }

	    if (!$this->rateDAO->create_all_tables()) {
		    return false;
	    }

        $this->config->init_default_config();

	    /**
	     * Check if WooCommerce is active
	     **/
	    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		    $this->zones_controller->init_zones();
	    }

	    return true;
    }
    public function deactivate() {
        if (get_option('nacex_clean_db', 'SI') === 'SI') {
            $this->expDAO->drop_table();
            $this->config->delete_config();
            $this->rateDAO->drop_all_tables();
            $this->zones_controller->delete_zones();
        }
    }
}