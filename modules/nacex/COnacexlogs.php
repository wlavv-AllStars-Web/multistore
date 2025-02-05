<?php
//SET ENVIRONMENT
include('../../config/config.inc.php');
include('../../init.php');
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'ROnacexlogs.php');
$_router = new ROnacexlogs();

switch ($_GET['method']) {
    case "init":
        $_router->init_delete_refresh();
        break;
    case "refresh":
        $_router->init_delete_refresh();
        break;
    case "delete":
        $_router->init_delete_refresh($_GET['file']);
        break;
    case "delete_all":
        $_router->init_delete_refresh($_GET['file']);
        break;
    case "read":
        $_router->read($_GET['file']);
        break;
    default:
        $_response = array();
        array_push($_response,
            array('cod_response' => 404,
                'header' => "",
                'result' => "<center><h1>" . $this->l("Error: Method not found") . "</h1></center>"
            ));
        echo json_encode($_response);
}



