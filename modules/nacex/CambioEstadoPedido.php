<?php

require_once(dirname(__FILE__) . '/../../config/config.inc.php');
require_once(dirname(__FILE__) . '/../../init.php');
require_once(dirname(__FILE__) . '/nacexDAO.php');

$id_order = Tools::getValue('id_order');
nacexDAO::actualizaEstadoPedido($id_order, 'i');
die();