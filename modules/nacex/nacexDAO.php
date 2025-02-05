<?php
include_once dirname(__FILE__) . "/AdminConfig.php";
include_once dirname(__FILE__) . "/nacexutils.php";
include_once dirname(__FILE__) . "/nacexDTO.php";
include_once dirname(__FILE__) . "/ROnacexshop.php";

/*
 * mexpositop 2017
 */
// session_start(); mexpositop 20180201
class nacexDAO
{
    public static function guardarExpedicion($agcli, $id_order, $putExpedicionResponse, $bultos, $array_shop_data, $ret, $serv_cod, $nacex_reembolso)
    {
        nacexutils::writeNacexLog("----");
        nacexutils::writeNacexLog("INI guardarExpedicion :: id_order: " . $id_order);

        nacexDAO::createTablesIfNotExists();

        $shop_codigo = isset($array_shop_data[0]) ? $array_shop_data[0] : "";
        $shop_alias = isset($array_shop_data[1]) ? $array_shop_data[1] : "";
        $shop_nombre = isset($array_shop_data[2]) ? $array_shop_data[2] : "";
        $shop_direccion = isset($array_shop_data[3]) ? $array_shop_data[3] : "";
        $shop_cp = isset($array_shop_data[4]) ? $array_shop_data[4] : "";
        $shop_poblacion = isset($array_shop_data[5]) ? $array_shop_data[5] : "";
        $shop_provincia = isset($array_shop_data[6]) ? $array_shop_data[6] : "";
        $shop_telefono = isset($array_shop_data[7]) ? $array_shop_data[7] : "";
        $estado = "PENDIENTE";
        $imp_ree = isset($nacex_reembolso) && $nacex_reembolso != null ? number_format($nacex_reembolso, 2, ".", "") : 0;

        /**
         * Permitimos varias expediciones con la misma referencia
         */

        $result = Db::getInstance()->execute('INSERT INTO ' . _DB_PREFIX_ . 'nacex_expediciones (
						id_envio_order, agcli, fecha_alta, ref, exp_cod, ag_cod_num_exp,color, 
						ent_ruta, ent_cod, ent_nom, ent_tlf, serv_cod, serv, hora_entrega, 
						barcode,  fecha_objetivo, cambios, bultos, shop_codigo, 	
						shop_alias, shop_nombre, shop_direccion, shop_cp, shop_poblacion, shop_provincia,
						shop_telefono, ret, estado, fecha_estado,imp_ree
					) VALUES( 
						"' . $id_order . '",
						"' . $agcli . '",
						"' . date('Y-m-d H:i:s') . '",
						"' . nacexutils::getReferenciaGeneral() . $id_order . '",
						"' . $putExpedicionResponse["exp_cod"] . '",
						"' . $putExpedicionResponse["ag_cod_num_exp"] . '",
						"' . $putExpedicionResponse["color"] . '",
						"' . $putExpedicionResponse["ent_ruta"] . '",
						"' . $putExpedicionResponse["ent_cod"] . '",
						"' . $putExpedicionResponse["ent_nom"] . '",
						"' . $putExpedicionResponse["ent_tlf"] . '",
						"' . $serv_cod . '",
						"' . $putExpedicionResponse["serv"] . '",
						"' . $putExpedicionResponse["hora_entrega"] . '",
						"' . $putExpedicionResponse["barcode"] . '",
						"' . $putExpedicionResponse["fecha_objetivo"] . '",
						"' . $putExpedicionResponse["cambios"] . '",
						"' . $bultos . '",
						"' . $shop_codigo . '",
						"' . $shop_alias . '",
						"' . $shop_nombre . '",
						"' . $shop_direccion . '",
						"' . $shop_cp . '",
						"' . $shop_poblacion . '",
						"' . $shop_provincia . '",
						"' . $shop_telefono . '",
						"' . $ret . '",
						"' . $estado . '",
						"' . date('Y-m-d H:i:s') . '",
						"' . $imp_ree . '")');
        if ($result) {
            nacexutils::writeNacexLog("INSERT guardarExpedicion :: Insertada expedicion en nacex_expediciones");
        } else {
            nacexutils::writeNacexLog("INSERT guardarExpedicion :: ERROR expedicion en nacex_expediciones");
        }

        nacexutils::writeNacexLog("FIN guardarExpedicion :: id_order: " . $id_order);
        nacexutils::writeNacexLog("----");

        return $result;
    }

    public static function setTransportistasBackend($selectStd = null, $selectShp = null, $selectInt = null)
    {
        nacexutils::writeNacexLog("----");
        nacexutils::writeNacexLog("INI setTransportistasBackend");

        $default_generic_nacex = Configuration::get('NACEX_DEFAULT_TIP_SER');
        $default_generic_nacexshop = Configuration::get('NACEX_DEFAULT_TIP_NXSHOP_SER');
        $default_generic_nacexint = Configuration::get('NACEX_DEFAULT_TIP_SER_INT');
        $default_generic_name_nacex = Configuration::get('NACEX_GEN_SERV_NAME');
        $default_generic_name_nacexshop = Configuration::get('NACEXSHOP_GEN_SERV_NAME');
        $default_generic_name_nacexint = Configuration::get('NACEXINT_GEN_SERV_NAME');

        $tracking_url = nacexDTO::$url_seguimiento . '/seguimientoFormularioExterno.do?intcli=@';

        // Si no existe transportista genérico, lo creamos
        if (is_null($selectStd) || empty($selectStd)) {
            $carrierNacex = array(
                'name' => $default_generic_name_nacex,
                'id_tax_rules_group' => 0,
                'active' => true,
                'deleted' => 0,
                'shipping_handling' => false,
                'range_behavior' => 0,
                'delay' => array(
                    Language::getIsoById(Configuration::get('PS_LANG_DEFAULT')) => 'Con total entrega'
                ),
                'id_zone' => 1,
                //'is_module' => true,
                'shipping_external' => (new self)->getShippingExternal(),
                'external_module_name' => nacexutils::getModuleName(),
                'ncx' => 'nacexG',
                'need_range' => true,
                'tip_serv' => $default_generic_nacex,
                'url' => $tracking_url
            );

            // Si no existe puede ser que haya cambiado de nombre: entonces miramos si ya había uno creado para ponérselo como referencia
            if(nacexDTO::getNacexIdCarrier()) $carrierNacex['id_reference'] = nacexDTO::getNacexIdCarrier();

            $id_transportista_nacex = self::instalarTransportista($carrierNacex, "nacex.jpg");
            Configuration::updateValue('TRANSPORTISTA_NACEX', (int) $id_transportista_nacex);

            nacexutils::writeNacexLog("setTransportistasBackend :: Instalado transportista NACEX GENERICO con id [" . $id_transportista_nacex . "]");
        } else {
            // Si existe transportista genérico y no hay ninguno instalado lo actualizamos
            //$carriers_std_activated = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier WHERE deleted=0 and shipping_external=1 and external_module_name="nacex" and ncx="nacexG"');
            $carriers_std_activated = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier WHERE deleted=0 and external_module_name="nacex" and ncx="nacexG"');
            if (count($carriers_std_activated) < 1) {
                Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'carrier SET deleted=0, ncx="nacexG",
																				name="' . $default_generic_name_nacex . '",
																				tip_serv="' . $default_generic_nacex . '" ,
																				url="' . $tracking_url . '",
																				external_module_name="nacex"
																	WHERE id_carrier =' . $selectStd[0]['id_carrier']);

                // Si no existe logo lo añadimos
                $nombre_fichero = _PS_SHIP_IMG_DIR_ . '/' . $default_generic_nacex . '.jpg';
                if (!file_exists($nombre_fichero)) {
                    copy(dirname(__FILE__) . '/images/servicios/nacex.jpg', _PS_SHIP_IMG_DIR_ . '/' . $default_generic_nacex . '.jpg');
                }

                Configuration::updateValue('TRANSPORTISTA_NACEX', (int)$selectStd[0]['id_carrier']);
                nacexutils::writeNacexLog("setTransportistasBackend :: Actualizado transportista NACEX GENERICO con id [" . $selectStd[0]['id_carrier'] . "] , tipo_serv [$default_generic_nacex] y nombre [$default_generic_name_nacex]");
                nacexutils::writeNacexLog("setTransportistasBackend :: TRANSPORTISTA_NACEX = " . Configuration::get('TRANSPORTISTA_NACEX'));
            }
        }

        // ****** NACEXSHOP ***********
        if (is_null($selectShp) || empty($selectShp)) {
            $carrierNacexShop = array(
                'name' => $default_generic_name_nacexshop,
                'id_tax_rules_group' => 0,
                'active' => true,
                'deleted' => 0,
                'shipping_handling' => false,
                'range_behavior' => 0,
                'delay' => array(
                    Language::getIsoById(Configuration::get('PS_LANG_DEFAULT')) => 'Estamos cuando tú no estás'
                ),
                'id_zone' => 1,
                //'is_module' => true,
                'shipping_external' => (new self)->getShippingExternal(),
                'external_module_name' => nacexutils::getModuleName(),
                'ncx' => 'nacexshopG',
                'need_range' => true,
                'tip_serv' => $default_generic_nacexshop,
                'url' => $tracking_url
            );

            // Si no existe puede ser que haya cambiado de nombre: entonces miramos si ya había uno creado para ponérselo como referencia
            if(nacexDTO::getNacexShopIdCarrier()) $carrierNacexShop['id_reference'] = nacexDTO::getNacexShopIdCarrier();


            $id_transportista_nacexshop = self::instalarTransportista($carrierNacexShop, "nacexshop.jpg");
            Configuration::updateValue('TRANSPORTISTA_NACEXSHOP', (int) $id_transportista_nacexshop);

            nacexutils::writeNacexLog("setTransportistasBackend :: Instalado transportista NACEXSHOP GENERICO con id [" . $id_transportista_nacexshop . "]");
        } else {
            // Si existe transportista genérico y no hay ninguno instalado lo actualizamos
            $carriers_shp_activated = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier WHERE deleted=0 and external_module_name="nacex" and ncx="nacexshopG"');
            if (count($carriers_shp_activated) < 1) {
                Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'carrier SET deleted=0, ncx="nacexshopG", 
																				name="' . $default_generic_name_nacexshop . '",
																				tip_serv="' . $default_generic_nacexshop . '",
																				url="' . $tracking_url . '",
																				external_module_name="nacex"
																	WHERE id_carrier =' . $selectShp[0]['id_carrier']);

                // Si no existe logo lo añadimos
                $nombre_fichero = _PS_SHIP_IMG_DIR_ . '/' . $default_generic_nacexshop . '.jpg';
                if (!file_exists($nombre_fichero)) {
                    copy(dirname(__FILE__) . '/images/servicios/nacexshop.jpg', _PS_SHIP_IMG_DIR_ . '/' . $default_generic_nacexshop . '.jpg');
                }

                Configuration::updateValue('TRANSPORTISTA_NACEXSHOP', (int)$selectShp[0]['id_carrier']);
                nacexutils::writeNacexLog("setTransportistasBackend :: Actualizado transportista NACEXSHOP GENERICO con id [" . $selectShp[0]['id_carrier'] . "] , tipo_serv [$default_generic_nacexshop] y nombre [$default_generic_name_nacexshop]");
                nacexutils::writeNacexLog("setTransportistasBackend :: TRANSPORTISTA_NACEXSHOP = " . Configuration::get('TRANSPORTISTA_NACEXSHOP'));
            }
        }

        // Si no existe transportista genérico nacexshop, lo creamos
        //if (! $existe_gen_nacexshop) {
        if (is_null($selectInt) || empty($selectInt)) {
            $carrierNacexInt = array(
                'name' => $default_generic_name_nacexint,
                'id_tax_rules_group' => 0,
                'active' => true,
                'deleted' => 0,
                'shipping_handling' => false,
                'range_behavior' => 0,
                'delay' => array(
                    Language::getIsoById(Configuration::get('PS_LANG_DEFAULT')) => 'Estamos cuando tú no estás'
                ),
                'id_zone' => 1,
                //'is_module' => true,
                'shipping_external' => (new self)->getShippingExternal(),
                'external_module_name' => nacexutils::getModuleName(),
                'ncx' => 'nacexintG',
                'need_range' => true,
                'tip_serv' => $default_generic_nacexint,
                'url' => $tracking_url
            );

            // Si no existe puede ser que haya cambiado de nombre: entonces miramos si ya había uno creado para ponérselo como referencia
            if(nacexDTO::getNacexIntIdCarrier()) $carrierNacexInt['id_reference'] = nacexDTO::getNacexIntIdCarrier();

            $id_transportista_nacexint = self::instalarTransportista($carrierNacexInt, "nacex.jpg");
            Configuration::updateValue('TRANSPORTISTA_NACEXINT', (int) $id_transportista_nacexint);

            nacexutils::writeNacexLog("setTransportistasBackend :: Instalado transportista NACEXINT GENERICO con id [" . $id_transportista_nacexint . "]");
        } else {
            // Si existe transportista genérico y no hay ninguno instalado lo actualizamos
            $carriers_int_activated = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier WHERE deleted=0 and external_module_name="nacex" and ncx="nacexintG"');
            if (count($carriers_int_activated) < 1) {
                Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'carrier SET deleted=0, ncx="nacexintG", 
																				name="' . $default_generic_name_nacexint . '",
																				tip_serv="' . $default_generic_nacexint . '",
																				url="' . $tracking_url . '",
																				external_module_name="nacex" 
																	WHERE id_carrier =' . $selectInt[0]['id_carrier']);

                // Si no existe logo lo añadimos
                $nombre_fichero = _PS_SHIP_IMG_DIR_ . '/' . $default_generic_nacex . '.jpg';
                if (!file_exists($nombre_fichero)) {
                    copy(dirname(__FILE__) . '/images/servicios/nacex' . $default_generic_nacex . '.jpg', _PS_SHIP_IMG_DIR_ . '/' . $default_generic_nacex . '.jpg');
                }

                Configuration::updateValue('TRANSPORTISTA_NACEXINT', (int)$selectInt[0]['id_carrier']);
                nacexutils::writeNacexLog("setTransportistasBackend :: Actualizado transportista NACEXINT GENERICO con id [" . $selectInt[0]['id_carrier'] . "] , tipo_serv [$default_generic_nacexint] y nombre [$default_generic_name_nacexint]");
                nacexutils::writeNacexLog("setTransportistasBackend :: TRANSPORTISTA_NACEXINT = " . Configuration::get('TRANSPORTISTA_NACEXINT'));
            }
        }
        nacexutils::writeNacexLog("FIN setTransportistasBackend");
        nacexutils::writeNacexLog("----");
    }

    public static function setTransportistasFrontend()
    {
        nacexutils::writeNacexLog("----");
        nacexutils::writeNacexLog("INI setTransportistasFrontend");

        $nacexDTO = new nacexDTO();

        foreach ($nacexDTO->getServiciosNacex() as $serv => $value) {
            $array_servs_f[] = $serv;
        }
        $ids_instalados = "";

        //$tracking_url = substr(Configuration::get('NACEX_PRINT_URL'), 0, strpos(Configuration::get('NACEX_PRINT_URL'), '/applets')) . '/seguimientoFormularioExterno.do?intcli=@';
        $tracking_url = $nacexDTO::$url_seguimiento . '/seguimientoFormularioExterno.do?intcli=@';

        // Recorremos los servicios Frontend seleccionados en configuración para convertirlos en Transportistas
        for ($i = 0; $i < count($array_servs_f); $i ++) {
            // Si no existe Transportista
            //if (! Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier c WHERE c.name = "NACEX_' . $array_servs_f[$i] . '" AND c.external_module_name = "nacex" and c.ncx = "nacex" ORDER BY c.id_carrier DESC LIMIT 1')) {
            if (sizeof(Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier WHERE name LIKE "NACEX_' . $array_servs_f[$i] . '" AND ncx != ""')) == 0) {
                // echo "<br><h1><font color='red'>NO EXISTE NACEX_".$array_servs_f[$i]."</font></h1><br>";
                $carrierNacex = array(
                    'name' => 'NACEX_' . $array_servs_f[$i],
                    'id_tax_rules_group' => 0,
                    'active' => false,  // Inicializamos que no se vean
                    'deleted' => 1,     // y se activen cuando las seleccione el cliente
                    'shipping_handling' => false,
                    'range_behavior' => 0,
                    'delay' => array(
                        Language::getIsoById(Configuration::get('PS_LANG_DEFAULT')) => $nacexDTO->getServiciosNacex()[$array_servs_f[$i]]["nombre"] . ". " . $nacexDTO->getServiciosNacex()[$array_servs_f[$i]]["descripcion"]
                    ),
                    'id_zone' => 1,
                    //'is_module' => true,
                    'shipping_external' => (new self)->getShippingExternal(),
                    'external_module_name' => nacexutils::_moduleName,
                    'ncx' => 'nacex',
                    'need_range' => true,
                    'tip_serv' => $array_servs_f[$i],
                    'url' => $tracking_url
                );

                $ids_instalados .= self::instalarTransportista($carrierNacex, "nacex_servicio_" . $array_servs_f[$i] . ".jpg") . "|";
                nacexutils::writeNacexLog("setTransportistasFrontend :: instalado transportista NACEX_" . $array_servs_f[$i]);
            } else {
                // Si existe actualizamos ID por si fuera distinto
                // antes nos aseguramos de que no está borrado
                Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'carrier SET deleted=1, tip_serv="' . $array_servs_f[$i] . '", url="' . $tracking_url . '" WHERE name = "NACEX_' . $array_servs_f[$i] . '" AND ncx LIKE "nacex%" ORDER BY id_carrier DESC LIMIT 1');

                // Corregimos problema de los transportistas externos
                Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'carrier SET external_module_name="nacex" WHERE name = "NACEX_' . $array_servs_f[$i] . '" AND ncx LIKE "nacex%" ORDER BY id_carrier DESC LIMIT 1');

                $datoscarrier = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier c WHERE c.name = "NACEX_' . $array_servs_f[$i] . '" AND c.ncx = "nacex" ORDER BY c.id_carrier DESC LIMIT 1');
                $ids_instalados .= (int)$datoscarrier[0]['id_carrier'] . "|";
                nacexutils::writeNacexLog("setTransportistasFrontend :: actualizado transportista NACEX_" . $array_servs_f[$i]);
            }
        }

        // Eliminamos último PIPE
        $ids_instalados = substr_replace($ids_instalados, "", strrpos($ids_instalados, "|"));
        Configuration::updateValue('NACEX_ID_TRANSPORTISTAS_F', $ids_instalados);

        // ------Para servicios NacexShop-----------------------------------------------------------------------

        /*$piped_servs_f = Configuration::get('NACEX_AVAILABLE_SERVS_NXSHOP_F');
        if (! empty($piped_servs_f)) {
            $array_servs_f = explode("|", $piped_servs_f);
        } else {
            $array_servs_f = null;
        }*/

        $array_servs_f = array();

        foreach ($nacexDTO->getServiciosNacexShop() as $serv => $value) {
            $array_servs_f[] = $serv;
        }
        $ids_instalados = "";

        // Recorremos los servicios Nacexshop del Frontend seleccionados en configuración para convertirlos en Transportistas
        for ($i = 0; $i < count($array_servs_f); $i ++) {

            // Si no existe Transportista
            //if (! Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier c WHERE c.name = "NACEXSHOP_' . $array_servs_f[$i] . '" AND c.external_module_name = "nacex" AND c.ncx = "nacexshop" ORDER BY c.id_carrier DESC LIMIT 1')) {
            if (sizeof(Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier WHERE name LIKE "NACEXSHOP_' . $array_servs_f[$i] . '" AND ncx != ""')) == 0) {
                // echo "<br><h1><font color='red'>NO EXISTE NACEXSHOP_".$array_servs_f[$i]."</font></h1><br>";
                $carrierNacex = array(
                    'name' => 'NACEXSHOP_' . $array_servs_f[$i],
                    'id_tax_rules_group' => 0,
                    'active' => false,  // Inicializamos que no se vean
                    'deleted' => 1,     // y se activen cuando las seleccione el cliente
                    'shipping_handling' => false,
                    'range_behavior' => 0,
                    'delay' => array(
                        Language::getIsoById(Configuration::get('PS_LANG_DEFAULT')) => $nacexDTO->getServiciosNacexShop()[$array_servs_f[$i]]["nombre"] . ". " . $nacexDTO->getServiciosNacexShop()[$array_servs_f[$i]]["descripcion"]
                    ),
                    'id_zone' => 1,
                    //'is_module' => true,
                    'shipping_external' => (new self)->getShippingExternal(),
                    'external_module_name' => nacexutils::_moduleName,
                    'ncx' => 'nacexshop',
                    'need_range' => true,
                    'tip_serv' => $array_servs_f[$i],
                    'url' => $tracking_url
                );

                $ids_instalados .= self::instalarTransportista($carrierNacex, "nacexshop_servicio_" . $array_servs_f[$i] . ".jpg") . "|";
                nacexutils::writeNacexLog("setTransportistasFrontend :: instalado transportista NACEXSHOP_" . $array_servs_f[$i]);
            } else {
                // Si existe actualizamos ID por si fuera distinto
                // antes nos aseguramos de que no está borrado
                Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'carrier SET deleted=1, tip_serv="' . $array_servs_f[$i] . '", url="' . $tracking_url . '" WHERE name = "NACEXSHOP_' . $array_servs_f[$i] . '" AND ncx = "nacexshop" ORDER BY id_carrier DESC LIMIT 1');

                $datoscarrier = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier c WHERE c.name = "NACEXSHOP_' . $array_servs_f[$i] . '" AND c.ncx = "nacexshop" ORDER BY c.id_carrier DESC LIMIT 1');
                $ids_instalados .= (int)$datoscarrier[0]['id_carrier'] . "|";
                nacexutils::writeNacexLog("setTransportistasFrontend :: actualizado transportista NACEXSHOP_" . $array_servs_f[$i]);
            }
        }

        // Eliminamos último PIPE
        $ids_instalados = substr_replace($ids_instalados, "", strrpos($ids_instalados, "|"));
        Configuration::updateValue('NACEX_ID_TRANSPORTISTAS_NXSHOP_F', $ids_instalados);

        /* SERVICIOS INTERNACIONALES */
        $array_servs_f = array();

        foreach ($nacexDTO->getServiciosNacexInt() as $serv => $value) {
            $array_servs_f[] = $serv;
        }
        $ids_instalados = "";

        // Recorremos los servicios Nacex Internacional del Frontend seleccionados en configuración para convertirlos en Transportistas
        for ($i = 0; $i < count($array_servs_f); $i ++) {

            // Si no existe Transportista
            //if (! Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier c WHERE c.name = "NACEXSHOP_' . $array_servs_f[$i] . '" AND c.external_module_name = "nacex" AND c.ncx = "nacexshop" ORDER BY c.id_carrier DESC LIMIT 1')) {
            if (sizeof(Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier WHERE name LIKE "NACEXINT_' . $array_servs_f[$i] . '" AND ncx != ""')) == 0) {
                // echo "<br><h1><font color='red'>NO EXISTE NACEXSHOP_".$array_servs_f[$i]."</font></h1><br>";
                $carrierNacex = array(
                    'name' => 'NACEXINT_' . $array_servs_f[$i],
                    'id_tax_rules_group' => 0,
                    'active' => false,  // Inicializamos que no se vean
                    'deleted' => 1,     // y se activen cuando las seleccione el cliente
                    'shipping_handling' => false,
                    'range_behavior' => 0,
                    'delay' => array(
                        Language::getIsoById(Configuration::get('PS_LANG_DEFAULT')) => $nacexDTO->getServiciosNacexInt()[$array_servs_f[$i]]["nombre"] . ". " . $nacexDTO->getServiciosNacexInt()[$array_servs_f[$i]]["descripcion"]
                    ),
                    'id_zone' => 1,
                    //'is_module' => true,
                    'shipping_external' => (new self)->getShippingExternal(),
                    'external_module_name' => nacexutils::_moduleName,
                    'ncx' => 'nacexint',
                    'need_range' => true,
                    'tip_serv' => $array_servs_f[$i],
                    'url' => $tracking_url
                );

                $ids_instalados .= self::instalarTransportista($carrierNacex, "nacex_servicio_" . $array_servs_f[$i] . ".jpg") . "|";
                nacexutils::writeNacexLog("setTransportistasFrontend :: instalado transportista NACEXINT_" . $array_servs_f[$i]);
            } else {
                // Si existe actualizamos ID por si fuera distinto
                // antes nos aseguramos de que no está borrado
                Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'carrier SET deleted=1, tip_serv="' . $array_servs_f[$i] . '", url="' . $tracking_url . '" WHERE name = "NACEXINT_' . $array_servs_f[$i] . '" AND ncx = "nacexint" ORDER BY id_carrier DESC LIMIT 1');

                $datoscarrier = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier c WHERE c.name = "NACEXINT_' . $array_servs_f[$i] . '" AND c.ncx = "nacexint" ORDER BY c.id_carrier DESC LIMIT 1');
                $ids_instalados .= (int)$datoscarrier[0]['id_carrier'] . "|";
                nacexutils::writeNacexLog("setTransportistasFrontend :: actualizado transportista NACEXINT_" . $array_servs_f[$i]);
            }
        }

        // Eliminamos último PIPE
        $ids_instalados = substr_replace($ids_instalados, "", strrpos($ids_instalados, "|"));
        Configuration::updateValue('NACEX_ID_TRANSPORTISTAS_NXINT_F', $ids_instalados);

        nacexutils::writeNacexLog("FIN setTransportistasFrontend");
        nacexutils::writeNacexLog("---");
    }

    public static function instalarTransportista($config, $logo)
    {
        //$tracking_url = substr(Configuration::get('NACEX_PRINT_URL'), 0, strpos(Configuration::get('NACEX_PRINT_URL'), '/applets')) . '/seguimientoFormularioExterno.do?intcli=@';
        $tracking_url = nacexDTO::$url_seguimiento . '/seguimientoFormularioExterno.do?intcli=@';
        $carrier = new Carrier();
        $carrier->name = $config['name'];
        $carrier->id_tax_rules_group = $config['id_tax_rules_group'];
        $carrier->id_zone = $config['id_zone'];
        $carrier->active = $config['active'];
        $carrier->deleted = $config['deleted'];
        $carrier->delay = $config['delay'];
        $carrier->shipping_handling = $config['shipping_handling'];
        $carrier->range_behavior = $config['range_behavior'];
        //$carrier->is_module = $config['is_module'];
        $carrier->shipping_external = $config['shipping_external'];
        $carrier->external_module_name = $config['external_module_name'];
        $carrier->need_range = $config['need_range'];
        $carrier->url = $tracking_url;

        $languages = Language::getLanguages(true);
        foreach ($languages as $language) {
            if ($language['iso_code'] == 'fr')
                $carrier->delay[(int)$language['id_lang']] = $config['delay'][$language['iso_code']];
            if ($language['iso_code'] == 'en')
                $carrier->delay[(int)$language['id_lang']] = $config['delay'][$language['iso_code']];
            if ($language['iso_code'] == Language::getIsoById(Configuration::get('PS_LANG_DEFAULT')))
                $carrier->delay[(int) $language['id_lang']] = $config['delay'][$language['iso_code']];
        }

        // Añadimos el carrier
        $carrier->add();

        // Añadimos datos a los transportistas después de crear las zonas
        $groups = Group::getGroups(true);

        foreach ($groups as $group) {

            /* mexpositop 20180619                 *                 */
            Db::getInstance()->insert(
                'carrier_group',
                array( 'id_carrier' => (int) ($carrier->id),'id_group' => (int) ($group['id_group'] )),
                false,
                false,
                Db::INSERT,
                true
            );
        }

        // Copiamos el logo
        copy(dirname(__FILE__) . '/images/servicios/' . $logo, _PS_SHIP_IMG_DIR_ . '/' . (int)$carrier->id . '.jpg');

        if(isset($config['id_reference'])) $carrier->id_reference = $config['id_reference'];
        else $carrier->id_reference = $carrier->id;

        Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'carrier SET ncx="' . $config["ncx"] . '", tip_serv="' . $config["tip_serv"] . '", url="' . $tracking_url . '", external_module_name="' . $carrier->external_module_name . '" ,id_reference="' . $carrier->id_reference . '" WHERE id_carrier = "' . $carrier->id . '"');

        // Return ID Carrier
        return (int) ($carrier->id);
    }

    public static function activarServicios($modo = "backend", $meth = null)
    {
        if ($modo != "backend") {
            // Cogemos las que están desactivadas previamente
            $disabled = Db::getInstance()->ExecuteS('SELECT id_carrier FROM ' . _DB_PREFIX_ . 'carrier WHERE active=0 AND deleted=0 AND ncx != ""');
            // Desactivamos todo
            //Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'carrier SET active=0, deleted=1 WHERE external_module_name = "nacex"');
            Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'carrier SET active=0, deleted=1 WHERE ncx != ""');

            $servicios_frontend_activados = explode('|', Configuration::get('NACEX_AVAILABLE_TIP_SER'));
            $servicios_frontend_shp_activados = explode('|', Configuration::get('NACEX_AVAILABLE_TIP_NXSHOP_SER'));
            $servicios_frontend_int_activados = explode('|', Configuration::get('NACEX_AVAILABLE_TIP_SER_INT'));

            // Para saber los ID's de los métodos
            if (!empty($servicios_frontend_activados[0])) {
                $query = Db::getInstance()->ExecuteS('SELECT id_reference FROM ' . _DB_PREFIX_ . 'carrier WHERE ncx = "nacex" AND id_carrier = ' . nacexDTO::getNacexIdCarrier() . ' ORDER BY id_carrier DESC');
                $sdg = (!empty($query)) ? $query[0]['id_reference'] : '';
                foreach ($servicios_frontend_activados as $sfa)
                    $arrayids[] = Db::getInstance()->ExecuteS('SELECT id_carrier FROM ' . _DB_PREFIX_ . 'carrier WHERE tip_serv = "' . $sfa . '" AND ncx = "nacex" AND id_reference != "' . $sdg . '" ORDER BY id_carrier DESC')[0]['id_carrier'];
            }

            if (!empty($servicios_frontend_shp_activados[0])) {
                $query = Db::getInstance()->ExecuteS('SELECT id_reference FROM ' . _DB_PREFIX_ . 'carrier WHERE ncx = "nacexshop" AND id_carrier = ' . nacexDTO::getNacexShopIdCarrier() . ' ORDER BY id_carrier DESC');
                $shg = (!empty($query)) ? $query[0]['id_reference'] : '';
                foreach ($servicios_frontend_shp_activados as $sfa)
                    $arrayids[] = Db::getInstance()->ExecuteS('SELECT id_carrier FROM ' . _DB_PREFIX_ . 'carrier WHERE tip_serv = "' . $sfa . '" AND ncx = "nacexshop" AND id_reference != "' . $shg . '" ORDER BY id_carrier DESC')[0]['id_carrier'];
            }

            if (!empty($servicios_frontend_int_activados[0])) {
                $query = Db::getInstance()->ExecuteS('SELECT id_reference FROM ' . _DB_PREFIX_ . 'carrier WHERE ncx = "nacexint" AND id_carrier = ' . nacexDTO::getNacexIntIdCarrier() . ' ORDER BY id_carrier DESC');
                $itg = (!empty($query)) ? $query[0]['id_reference'] : '';
                foreach ($servicios_frontend_int_activados as $sfa)
                    $arrayids[] = Db::getInstance()->ExecuteS('SELECT id_carrier FROM ' . _DB_PREFIX_ . 'carrier WHERE tip_serv = "' . $sfa . '" AND ncx = "nacexint" AND id_reference != "' . $itg . '" ORDER BY id_carrier DESC')[0]['id_carrier'];
            }

            if (!empty($disabled[0])) {
                foreach ($disabled as $dis)
                    $arraydis[] = $dis['id_carrier'];
            }

            //$ncx_int = Configuration::get('NACEX_AVAILABLE_TIP_SER_INT');

            $currentShop = Context::getContext()->shop->id;

            for ($i = 0; $i < count($arrayids); $i++) {
                if (isset($arraydis) && !in_array($arrayids[$i], $arraydis))
                    Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'carrier SET active=1, deleted=0 WHERE id_carrier = "' . $arrayids[$i] . '"');
                else
                    Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'carrier SET active=0, deleted=0 WHERE id_carrier = "' . $arrayids[$i] . '"');

                // Multitienda
                $activeInShop = Db::getInstance()->ExecuteS('SELECT id_shop FROM ' . _DB_PREFIX_ . 'carrier_shop WHERE id_carrier=' . $arrayids[$i]);
                // Si no está activo en la tienda actual, créalo
                if (!in_array($currentShop, array_column($activeInShop, 'id_shop'))) {
                    Db::getInstance()->insert(
                        'carrier_shop',
                        array(
                            'id_carrier' => $arrayids[$i],
                            'id_shop' => $currentShop
                        )
                    );
                }
            }
        }
    }

    public static function getImporteWebservice($params, $id_carrier)
    {
        global $cookie;
        $result = 0;
        $id_customer = $params->id_customer;
        $id_shippin_addr = $params->id_address_delivery;
        $textLog = "";

        nacexutils::writeNacexLog("===> INI getImporteWebservice");

        if (CustomerCore::getAddressesTotalById($id_customer) > 0) {
            $addr = new Address($id_shippin_addr);
            $carrier = self::getCarrierById($id_carrier);
            $cp_ent = $addr->postcode;
            $tip_ser = $carrier[0]["tip_serv"];
            $tip_env = Configuration::get('NACEX_TIP_ENV');
            $kil = $params->gettotalWeight() < 1 ? 1 : $params->gettotalWeight();
            $totalPedido = $params->getOrderTotal(true, Cart::ONLY_PHYSICAL_PRODUCTS_WITHOUT_SHIPPING);

            // Cargamos los valores del CP y del valor del carrier para cargar uno u otro
            $context = Context::getContext();
            $valor_cookie = $context->cookie->__isset('checked_carrier_' . $id_carrier) ? $context->cookie->__get('checked_carrier_' . $id_carrier) : false;

            if ($context->cookie->__get('cp_nacex_' . $id_carrier) != $cp_ent) {
                $change_cp = true;
                $context->cookie->__set('cp_nacex_' . $id_carrier, $cp_ent);
            } else $change_cp = false;

            // Miramos total del pedido (también por variación de artículos/peso)
            if ($context->cookie->__get('total_nacex_' . $id_carrier) != $totalPedido) {
                $change_total = true;
                $context->cookie->__set('total_nacex_' . $id_carrier, $totalPedido);
            } else $change_total = false;

            nacexutils::writeNacexLog("valor_cookie :: " . $valor_cookie);
            nacexutils::writeNacexLog("change_cp :: " . $change_cp);
            nacexutils::writeNacexLog("change_total :: " . $change_total);

            if (isset($_SESSION[$cp_ent . "-" . $tip_ser . "-" . $kil])) {
                $textLog .= "getImporteWebservice :: No lanzamos llamada a getValoracion. Sin CP o recuperado de cache. (Carrier:";
                $result = $_SESSION[$cp_ent . "-" . $tip_ser . "-" . $kil];
            } elseif ($valor_cookie != false && $change_cp == false && $change_total == false) {
                $textLog .= "getImporteWebservice :: Hay valor guardado en la cookie. Valor: $valor_cookie - (Carrier:";
                $result = floatval(str_replace(",", ".", $valor_cookie));
            } else {
                if (!empty($cp_ent) && strlen($cp_ent) > 0) { // Valoración si tenemos CP de entrega

                    nacexutils::writeNacexLog("INVOCAMOS A GETVALORACION DE WS");
                    $ws_response = nacexWS::ws_getValoracion($cp_ent, $tip_ser, $kil, $tip_env);

                    // Con esta condición controlamos la falta de conexión de WS
                    if ($ws_response[0] === '500ERROR') { // Si es un error 500 por falta de conexión con WS

                        nacexutils::writeNacexLog('calculateWithWebService:: ERROR DE COMUNICACIÓN CON WS.');
                        nacexutils::writeNacexLog('calculateWithWebService:: comprobamos configuración de TableRates');

                        /* Controlamos que si son islas (07,35,38) o Ceuta o Melilla (51,52) NO se muestre el método NacexShop */
                        $cod_prov = substr($cp_ent, 0, 2);
                        $prov_no_nxshp = ['07', '35', '38', '51', '52'];
                        $servicio = $carrier[0]['ncx'];
                        if ($servicio != 'nacexshop' || ($servicio == 'nacexshop' && !in_array($cod_prov, $prov_no_nxshp))) {
                            $calculo_importe = '';
                            $coste_fijo = '';
                            $id = '';

                            // Llamamos a una función NO estática de esta clase desde una función estática
                            (new self)->calculaPrecioFijo($carrier[0]['id_carrier'], $calculo_importe, $coste_fijo, $id);

                            // Miramos si hay configuradas tarifas para la zona
                            $carrierTemp = new Carrier($id);
                            $result = number_format(round($carrierTemp->getDeliveryPriceByWeight($kil, Address::getZoneById($id_shippin_addr)), 2), 2);

                            // Miramos si hay algún precio fijo por defecto
                            if (!$result || $result == 0) {
                                nacexutils::writeNacexLog("getImporteWebservice :: no hay configurada una tarifa. Asignamos el precio por defecto.");
                                $result = number_format(round($coste_fijo, 2), 2);
                            }
                        } else $result = false;

                    } else {

                        if (isset($ws_response) && isset($ws_response[0]) && $ws_response[0] != "ERROR" && sizeof($ws_response) > 1) {
                            $result = floatval(str_replace(",", ".", $ws_response[1]));
                        } else {
                            // Si da error miramos con otros tipos de envío
                            $arrayEnv = [0, 1, 2];
                            unset($arrayEnv[$tip_env]);  // Eliminamos la opción por defecto, que es la que miramos primero
                            $arrayEnv = array_reverse($arrayEnv, true);

                            foreach ($arrayEnv as $tip_env) {
                                nacexutils::writeNacexLog("INVOCAMOS A GETVALORACION DE WS (DIFERENTE ENVASE PARA OBTENER PRECIO)");
                                $response = nacexWS::ws_getValoracion($cp_ent, $tip_ser, $kil, $tip_env);
                                if ($response[0] != 'ERROR') break;
                            }

                            if ($response[0] == 'ERROR') return false; // Si no existe el método en ningún caso, devuelve falso

                            $result = floatval(str_replace(",", ".", $response[1]));
                        }
                    }

                    $_SESSION[$cp_ent . "-" . $tip_ser . "-" . $kil] = $result;
                    $textLog .= "getImporteWebservice :: Calculamos importe con WS (Carrier:";
                }
            }
        }

        $shipping_cost = $result ? number_format($result, 2, ".", "") : false;
        nacexutils::writeNacexLog($textLog . $id_carrier . " => " . $shipping_cost . " euros)");
        nacexutils::writeNacexLog("===> FIN getImporteWebservice");
        return $shipping_cost;
    }

    public function calculaPrecioFijo($value, &$calculo_importe, &$coste_fijo, &$id)
    {
        $id = str_replace(",", "", $value);
        $nacexDTO = new nacexDTO();
        $array_id_carriers = $array_nxshop_id_carriers = $array_nxint_id_carriers = [];
        if ($nacexDTO->isNacexCarrier($id)) {
            array_push($array_id_carriers, intval($value));
            $calculo_importe = Configuration::get('NACEX_CALCULO_IMPORTE_STD');
            $coste_fijo = floatval(str_replace(",", ".", Configuration::get('NACEX_IMP_FIJO_VAL')));
        } elseif ($nacexDTO->isNacexShopCarrier($id)) {
            array_push($array_nxshop_id_carriers, intval($value));
            $calculo_importe = Configuration::get('NACEX_CALCULO_IMPORTE_SHP');
            $coste_fijo = floatval(str_replace(",", ".", Configuration::get('NACEXSHOP_IMP_FIJO_VAL')));
        } elseif ($nacexDTO->isNacexIntCarrier($id)) {
            array_push($array_nxint_id_carriers, intval($value));
            $calculo_importe = Configuration::get('NACEX_CALCULO_IMPORTE_INT');
            $coste_fijo = floatval(str_replace(",", ".", Configuration::get('NACEXINT_IMP_FIJO_VAL')));
        }


    }

    public static function actDatosNacexExpediciones($id_pedido, $getDatosWSExpedicion, $estado, $fecha_estado_exp, $hora_estado_exp)
    {
        nacexutils::writeNacexLog("----\nINI actDatosNacexExpediciones :: id_pedido: " . $id_pedido . " estado:" . $estado . " fecha_estado_exp:" . $fecha_estado_exp . " hora_estado_exp:" . $hora_estado_exp);

        nacexDAO::createTablesIfNotExists();

        // $serv_cod = $getDatosWSExpedicion["serv_cod"];
        // $referencias = explode(";", $getDatosWSExpedicion["ref"]);
        $newDate = $fecha_estado_exp . "" . $hora_estado_exp;
        $serv_cod = isset($getDatosWSExpedicion["serv_cod"]) ? $getDatosWSExpedicion["serv_cod"] : '';
        $referencias = isset($getDatosWSExpedicion["ref"]) ? explode(";", $getDatosWSExpedicion["ref"]) : '';

        if (! empty($newDate) && strlen($newDate) > 0 && "-------" != $newDate) {
            $arrayfecha = explode("/", $fecha_estado_exp);
            $arrayhora = explode(":", $hora_estado_exp);
            $dia = $arrayfecha[0];
            $mes = $arrayfecha[1];
            $any = $arrayfecha[2];
            $hora = $arrayhora[0];
            $min = $arrayhora[1];
            $seg = $arrayhora[2];
            $newDate = date("Y-m-d H:i:s", mktime($hora, $min, $seg, $mes, $dia, $any));
        } else {
            $newDate = date("Y-m-d H:i:s");
        }

        $query = 'UPDATE ' . _DB_PREFIX_ . 'nacex_expediciones SET
					serv_cod="' . $serv_cod . '",
					estado="' . $estado . '",
					ref="' . $referencias[0] . '",
					fecha_estado = "' . $newDate . '"
					WHERE exp_cod = "' . $getDatosWSExpedicion['exp_cod'] . '"';
        Db::getInstance()->execute($query);
        nacexutils::writeNacexLog("actDatosNacexExpediciones :: actualizados campos [" . $serv_cod . "," . $estado . "," . $referencias[0] . "," . $newDate . "] en [nacex_expediciones] del pedido:" . $id_pedido);
    }

    public static function getExpRelacionadas($id_pedido)
    {
        $arraydatos = array();
        $arraydatos = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'nacex_expediciones_his where id_envio_order = "' . $id_pedido . '" order by ag_cod_num_exp desc');
        return $arraydatos;
    }

    public function tieneExpedicion($id_pedido)
    {
        $sql = "SELECT * FROM " . _DB_PREFIX_ . "nacex_expediciones where fecha_baja is null and id_envio_order =" . $id_pedido;

        $result = Db::getInstance()->ExecuteS($sql);

        return $result;
    }

    public static function actualizarTrackingExpedicion($id_pedido, $numexp)
    {
        if (Configuration::get('NACEX_ACT_TRACKING') == "SI") {
            nacexutils::writeNacexLog("actualizarTrackingExpedicion :: añadimos informacion del tracking de la Expedición " . $numexp);
            Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'orders SET shipping_number="' . $numexp . '" WHERE id_order = "' . $id_pedido . '"');
            Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'order_carrier SET tracking_number="' . $numexp . '" WHERE id_order = "' . $id_pedido . '"');
        }
    }

    public static function setNacexShopAddressinBD($id_order, $id_cart, $id_address, $id_customer, $shop_datos, &$id_nueva = null)
    {
        nacexutils::writeNacexLog("-----");
        nacexutils::writeNacexLog("INI setNacexShopAddressinBD :: id_order: " . $id_order . "|id_cart: " . $id_cart . "|id_address: " . $id_address . "|id_customer: " . $id_customer . "|shop_datos: " . $shop_datos);

        if (sizeof(explode('|', $shop_datos)) == 1) {
            // Busco los datos en el archivo droppoints
            $ROnacexshop = new nacexshop();
            $data = $ROnacexshop->getFileData($shop_datos, true);
            $shop_datos = $data[0];
        }
        $array_shop_data = nacexutils::explodeShopData($shop_datos);
        $array_address = nacexDAO::getAddressById($id_address);

        nacexutils::provincia($array_shop_data["shop_cp"], $prov);
        $provincia = State::getIdByName($prov);

        // Corregir de que el shop_alias es superior a 32 caracteres
        $shop_alias = substr($array_shop_data["shop_nombre"], 0, 32);

        // Hemos añadido los números de teléfono y el DNI para que coincidan con una única persona
        $dirnacexshop = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'address WHERE 
					alias = "' . $shop_alias . '" AND 
					firstname= "' . $array_address[0]["firstname"] . '" AND 
					lastname = "' . $array_address[0]["lastname"] . '" AND 
					company = "' . $array_shop_data["shop_alias"] . '" AND 
					address1 = "' . $array_shop_data["shop_direccion"] . '" AND 
					address2 = "' . $array_shop_data["shop_codigo"] . '"|"' . $array_shop_data['shop_nombre'] . '" AND 
					postcode = "' . $array_shop_data["shop_cp"] . '" AND 
					city = "' . $array_shop_data["shop_poblacion"] . '" AND 
					id_state = "' . $provincia . '" AND 
					phone = "' . $array_address[0]["phone"] . '" AND 
					phone_mobile = "' . $array_address[0]["phone_mobile"] . '" AND 
					dni = "' . $array_address[0]["dni"] . '"');

        // Hemos añadido los números de teléfono y el DNI para que coincidan con una única persona
        /*$dirnacexshop = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'address WHERE
                    alias = "' . $array_shop_data["shop_codigo"] . '" AND
                    firstname= "' . $array_shop_data["shop_alias"] . '" AND
                    lastname = "' . $array_shop_data["shop_nombre"] . '" AND
                    address1 = "' . $array_shop_data["shop_direccion"] . '" AND
                    postcode = "' . $array_shop_data["shop_cp"] . '" AND
                    city = "' . $array_shop_data["shop_poblacion"] . '" AND
                    other = "' . $array_shop_data["shop_provincia"] . '" AND
                    phone = "' . $array_address[0]["phone"] . '" AND
                    phone_mobile = "' . $array_address[0]["phone_mobile"] . '" AND
                    dni = "' . $array_address[0]["dni"] . '"');*/


        // Revisamos que este habilitado en la configuración el Mostrar Empresa para obtener el campo company que ha añadido el Usuario
        $showEmpresa = Configuration::get("NACEX_SHOW_EMPRESA");

        $address = new Address($id_address);
        $campoEmpresa = $address->company;

        if ($showEmpresa == "SI" && !empty($campoEmpresa)){
            $campoEmpresaFinal = $array_shop_data["shop_alias"] . '|' . $campoEmpresa;
        }else{
            $campoEmpresaFinal = $array_shop_data["shop_alias"];
        }

        if (!empty($dirnacexshop)) {
            // Si existe sobreescribimos id_address_delivery en ORDERS y CART
            nacexutils::writeNacexLog("setNacexShopAddressinBD :: Sobreescribimos id_address_delivery en ORDERS y CART");
            Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'orders SET id_address_delivery="' . $dirnacexshop[0]["id_address"] . '" WHERE id_order = "' . $id_order . '"');
            Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'cart SET id_address_delivery="' . $dirnacexshop[0]["id_address"] . '" WHERE id_cart = "' . $id_cart . '"');
            $id_nueva = $dirnacexshop[0]["id_address"];
        } else {
            // Si no existe la creamos
            nacexutils::writeNacexLog("setNacexShopAddressinBD :: Creamos nueva direccion NacexShop");
            $id_country = $array_address[0]['id_country'];

            $new_address = new Address();
            $new_address->id_customer = $id_customer;
            $new_address->id_manufacturer = NULL;
            $new_address->id_supplier = NULL;
            $new_address->id_country = $id_country;
            $new_address->id_state = $provincia;

            $new_address->alias = $shop_alias;
            // Los dos siguientes son provisionales, luego se sobreescriben con mysql porque la clase no permite caracteres numéricos para estos dos campos
            $new_address->firstname = $array_address[0]["firstname"];
            $new_address->lastname = $array_address[0]["lastname"];
            $new_address->company = $campoEmpresaFinal;
            $new_address->address1 = $array_shop_data["shop_direccion"];
            $new_address->address2 = $array_shop_data["shop_codigo"] . '|' . $array_shop_data["shop_nombre"];
            $new_address->postcode = $array_shop_data["shop_cp"];
            $new_address->city = $array_shop_data["shop_poblacion"];
            //$new_address->other = $array_shop_data["shop_provincia"];
            // $new_address->phone = $array_shop_data["shop_telefono"];
            $new_address->phone = $array_address[0]["phone"];
            $new_address->phone_mobile = $array_address[0]["phone_mobile"];

            $new_address->date_add = date("Y-m-d H:i:s");
            $new_address->date_upd = date("Y-m-d H:i:s");
            $new_address->dni = $array_address[0]['dni'];
            // La marcamos como borrada para que "no entre en el circuito"
            $new_address->deleted = 1;

            if ($new_address->add()) {

                $id_nueva = $new_address->id;
                //Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'address SET firstname="' . $array_shop_data["shop_alias"] . '", lastname="' . $array_shop_data["shop_nombre"] . '" WHERE id_address = "' . $id_nueva . '"');
                //nacexutils::writeNacexLog("UPDATE setNacexShopAddressinBD :: UPDATE " . _DB_PREFIX_ . "address SET firstname=" . $array_shop_data["shop_alias"] . ", lastname=" . $array_shop_data["shop_nombre"] . " WHERE id_address = " . $id_nueva);
                // Y sobreescribimos con el nuevo id_address el id_address_delivery en ORDERS y CART
                Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'orders SET id_address_delivery="' . $id_nueva . '" WHERE id_order = "' . $id_order . '"');
                nacexutils::writeNacexLog("UPDATE setNacexShopAddressinBD :: UPDATE " . _DB_PREFIX_ . "orders SET id_address_delivery=" . $id_nueva . " WHERE id_order = " . $id_order);
                Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'cart SET id_address_delivery="' . $id_nueva . '" WHERE id_cart = "' . $id_cart . '"');
                nacexutils::writeNacexLog("UPDATE setNacexShopAddressinBD :: UPDATE " . _DB_PREFIX_ . "cart SET id_address_delivery=" . $id_nueva . " WHERE id_cart = " . $id_cart);
            }
        }

        nacexutils::writeNacexLog("FIN setNacexShopAddressinBD :: id_order: " . $id_order);
        nacexutils::writeNacexLog("-----");
    }

    public static function getDatosExpedicionNacexShop($id_order)
    {
        return Db::getInstance()->ExecuteS('SELECT shop_codigo, shop_alias, shop_nombre, shop_direccion, shop_cp, shop_poblacion, shop_provincia, shop_telefono  FROM ' . _DB_PREFIX_ . 'nacex_expediciones WHERE id_envio_order = "' . $id_order . '"');
    }

    public static function getDatosExpedicionNacex($id_order)
    {
        return Db::getInstance()->ExecuteS('SELECT agcli, fecha_alta, ref, exp_cod, ag_cod_num_exp, color, ent_ruta, ent_cod, ent_nom, ent_tlf, serv, hora_entrega, barcode, fecha_objetivo, cambios, bultos, shop_codigo, shop_alias, shop_nombre, shop_direccion, shop_cp, shop_poblacion, shop_provincia, shop_telefono, ret, estado FROM ' . _DB_PREFIX_ . 'nacex_expediciones WHERE fecha_baja IS null AND id_envio_order = "' . $id_order . '" ORDER BY fecha_alta desc');
    }

    public static function getDatosCartNacexShop($id_cart)
    {
        nacexutils::writeNacexLog("----");
        nacexutils::writeNacexLog("INI getDatosCartNacexShop :: id_cart:" . $id_cart);
        $array = Db::getInstance()->ExecuteS('SELECT ncx FROM ' . _DB_PREFIX_ . 'cart WHERE id_cart = "' . $id_cart . '"');
        // Devuelve : 254|0811-00|BARCELONA|P.COLON, 22|08002|BARCELONA|BARCELONA|654659897
        nacexutils::writeNacexLog("getDatosCartNacexShop :: obtenidos datos nacexshop :" . $array[0]['ncx']);
        return nacexutils::explodeShopData($array[0]['ncx']);
    }

    public static function getAddressById($id_address)
    {
        return Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'address WHERE id_address = "' . $id_address . '"');
    }

    public static function getAddressInvoiceByOrder($id_order)
    {
        return Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'address WHERE id_address IN (select id_address_invoice from ' . _DB_PREFIX_ . 'orders where id_order = "' . $id_order . '")');
    }

    public static function getCarrierName($id_carrier)
    {
        $ret = Db::getInstance()->ExecuteS('SELECT name FROM ' . _DB_PREFIX_ . 'carrier WHERE id_carrier=' . $id_carrier);
        return @$ret[0]['name'];
    }

    public static function getActiveCarriers()
    {
        $ret = Db::getInstance()->ExecuteS('SELECT id_carrier FROM ' . _DB_PREFIX_ . 'carrier WHERE active=1 AND deleted=0 AND ncx IS NOT NULL');
        return $ret;
    }

    public static function getCarrierById($id_carrier)
    {
        $query = "SELECT * 
				  FROM " . _DB_PREFIX_ . "carrier
				  where active=1 
				  and deleted = 0
				  and (upper(ncx) IN ('NACEX','NACEXG') || upper(ncx) IN ('NACEXSHOP','NACEXSHOPG'))
				  and id_carrier = " . $id_carrier;

        return $datoscarrier = Db::getInstance()->ExecuteS($query);
    }

    /** Cogemos el campo TIP_SERV del carrier de nacex **/
    public static function getCarrierByServ($tip_serv)
    {
        $query = "SELECT *
				  FROM " . _DB_PREFIX_ . "carrier
				  where tip_serv = " . $tip_serv;

        return $datoscarrier = Db::getInstance()->ExecuteS($query);
    }

    /** Get carrier applied taxes **/
    public static function getCarrierTaxesById($id_carrier, $shop_id)
    {
        $query = "SELECT rate 
				  FROM " . _DB_PREFIX_ . "tax
				  WHERE id_tax = (
                    SELECT DISTINCT id_tax
                    FROM " . _DB_PREFIX_ . "tax_rule
                    WHERE id_tax_rules_group = (
                        SELECT id_tax_rules_group 
                        FROM " . _DB_PREFIX_ . "carrier_tax_rules_group_shop
                        WHERE id_carrier = " . $id_carrier . " AND id_shop = " . $shop_id . "
                    )
                  )";

        return Db::getInstance()->ExecuteS($query);
    }

    /** Get carrier applied taxes **/

    public static function getDatosExpedicion($id_pedido, $exp_cod = null)
    {
        $query = "SELECT id_envio_order, agcli, fecha_alta, ref,
						 exp_cod, ag_cod_num_exp, color, ent_ruta, 
						 ent_cod, ent_nom, ent_tlf, serv_cod,
						 serv,  hora_entrega, barcode, fecha_objetivo, 
						 cambios, bultos, shop_codigo, shop_alias,
						 shop_nombre, shop_direccion, shop_cp, shop_poblacion,
						 shop_provincia, shop_telefono, ret, estado,
						 fecha_estado, imp_ree
				  FROM " . _DB_PREFIX_ . "nacex_expediciones
				  where id_envio_order = " . $id_pedido;
        if (!is_null($exp_cod) && $exp_cod != '') $query .= " AND exp_cod = $exp_cod";

        return Db::getInstance()->ExecuteS($query);
    }

    public static function getDatosPedido($id_order)
    {
        return Db::getInstance()->ExecuteS('SELECT o.id_order,o.reference,o.module,u.email,a.alias,a.firstname,
				a.lastname,a.company,a.address1,a.address2,a.postcode,a.city,a.id_state,a.phone,a.other,a.id_state,a.phone_mobile,z.iso_code,c.ncx,o.id_carrier,
                o.id_cart,o.id_address_delivery,
				case when o.total_paid_real > 0 
					then o.total_paid_real
				else
					o.total_paid
				end as total_paid_real 
				FROM ' . _DB_PREFIX_ . 'orders AS o
				JOIN ' . _DB_PREFIX_ . 'customer AS u
				JOIN ' . _DB_PREFIX_ . 'cart AS c
				JOIN ' . _DB_PREFIX_ . 'address a
				JOIN ' . _DB_PREFIX_ . 'country AS z
				WHERE o.id_order = "' . $id_order . '"
				AND u.id_customer = o.id_customer
				AND c.id_cart = o.id_cart
				AND a.id_address = o.id_address_delivery
				AND a.id_country = z.id_country');
    }

    //public static function cancelarExpedicion($id_order)
    public static function cancelarExpedicion($id_order, $cod_exp)
    {
        nacexutils::writeNacexLog("----");
        nacexutils::writeNacexLog("INI cancelarExpedicion :: id_order: " . $id_order . " - cod_exp: " . $cod_exp);

        Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'nacex_expediciones SET
				fecha_baja = "' . date('Y-m-d H:i:s') . '",
				estado = "BAJA",
				fecha_estado="' . date('Y-m-d H:i:s') . '"
				WHERE exp_cod = "' . $cod_exp . '"');

        //Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'orders SET shipping_number=null WHERE id_order = "' . $id_order . '"');

        nacexutils::writeNacexLog("UPDATE cancelarExpedicion :: Updateada expedicion en nacex_expediciones");
        nacexutils::writeNacexLog("----");
        nacexutils::writeNacexLog("FIN cancelarExpedicion :: id_order: " . $id_order . " - cod_exp: " . $cod_exp);
    }

    public static function createTablesIfNotExists()
    {
        nacexutils::writeNacexLog("----");
        nacexutils::writeNacexLog("INI createTablesIfNotExists");

        // Creamos la tabla para las expediciones
        $query = "CREATE TABLE IF NOT EXISTS " . _DB_PREFIX_ . "nacex_expediciones (
			id_envio_order int(11) NOT NULL,
			agcli varchar(10),
			fecha_alta datetime NOT NULL,
			fecha_baja datetime,
			ref varchar(20),
			exp_cod varchar(255),
			ag_cod_num_exp varchar(255),
			color varchar(255),
			ent_ruta varchar(255),
			ent_cod varchar(255),
			ent_nom varchar(255),
			ent_tlf varchar(255),
			serv_cod varchar(2),
			serv varchar(255),
			hora_entrega varchar(255),
			barcode varchar(255),
			fecha_objetivo varchar(255),
			cambios varchar(255),
			bultos varchar(3),			 
			shop_codigo 	varchar(6),
			shop_alias 	varchar(20),
			shop_nombre 	varchar(60),
			shop_direccion 	varchar(60),			
			shop_cp 	varchar(7),
			shop_poblacion varchar(60),
			shop_provincia 	varchar(60),
			shop_telefono 	varchar(60),
			ret 	varchar(2),
			estado varchar(20),
			fecha_estado datetime,
			imp_ree decimal(8,3),
		PRIMARY KEY (`id_envio_order`)
		) ENGINE=" . _MYSQL_ENGINE_ . " DEFAULT CHARSET=utf8";

        if (! Db::getInstance()->Execute($query)) {
            nacexutils::writeNacexLog("createTablesIfNotExists :: Error al crear tabla nacex_expediciones");
            nacexutils::createColumnsNacexExpediciones();
            return false;
        }

        // Creamos la tabla para el historico de expediciones
        $query = "CREATE TABLE IF NOT EXISTS " . _DB_PREFIX_ . "nacex_expediciones_his (
			id_envio_order int(11) NOT NULL,
			agcli varchar(10),
			fecha_alta datetime NOT NULL,
			fecha_baja datetime,
			ref varchar(20),
			exp_cod varchar(255),
			ag_cod_num_exp varchar(255),
			color varchar(255),
			ent_ruta varchar(255),
			ent_cod varchar(255),
			ent_nom varchar(255),
			ent_tlf varchar(255),
			serv_cod varchar(2),
			serv varchar(255),
			hora_entrega varchar(255),
			barcode varchar(255),
			fecha_objetivo varchar(255),
			cambios varchar(255),
			bultos varchar(3),			 
			shop_codigo 	varchar(6),
			shop_alias 	varchar(20),
			shop_nombre 	varchar(60),
			shop_direccion 	varchar(60),			
			shop_cp 	varchar(7),
			shop_poblacion varchar(60),
			shop_provincia 	varchar(60),
			shop_telefono 	varchar(60),
			ret 	varchar(2),
			estado varchar(20),
			fecha_estado datetime,
			imp_ree decimal(8,3),
		PRIMARY KEY (`id_envio_order`,`ag_cod_num_exp`)
		) ENGINE=" . _MYSQL_ENGINE_ . " DEFAULT CHARSET=utf8";

        if (! Db::getInstance()->Execute($query)) {
            nacexutils::writeNacexLog("createTablesIfNotExists :: Error al crear tabla nacex_expediciones_his");
            return false;
        }

        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "cart LIKE 'ncx'");
        if (Db::getInstance()->Affected_Rows() == 0) {

            // Añadimos campo adicional Nacex, en CART
            $query = "ALTER TABLE " . _DB_PREFIX_ . "cart ADD COLUMN ncx varchar (350)";
            try {
                Db::getInstance()->Execute($query);
            } catch (Exception $e) {
                nacexutils::writeNacexLog("createTablesIfNotExists :: Error al alter table [ncx] en " . _DB_PREFIX_ . "cart");
            }
        }
        // Forzamos a aumentar tamaño en este campo ncx de Cart para versiones anteriores con menor tamaño.
        // En este campo guardamos info NacexShop
        $query = "ALTER TABLE " . _DB_PREFIX_ . "cart MODIFY ncx varchar (350)";
        Db::getInstance()->Execute($query);

        /* VERSIONES ANTERIORES */
        // Añadimos campos adicionales

        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'agcli'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN agcli varchar (10)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [agcli][varchar(10)]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }

        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'bultos'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN bultos varchar (3)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [bultos][varchar(3)]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }

        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'shop_codigo'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN shop_codigo varchar (6)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [shop_codigo][varchar(6)]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }

        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'shop_alias'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN shop_alias varchar (20)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [shop_alias][varchar(20)]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }

        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'shop_nombre'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN shop_nombre varchar (60)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [shop_nombre][varchar(60)]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }

        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'shop_direccion'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN shop_direccion varchar (60)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [shop_direccion][varchar(60)]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }

        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'shop_cp'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN shop_cp varchar (7)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [shop_cp][varchar(7)]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }

        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'shop_poblacion'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN shop_poblacion varchar (60)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [shop_poblacion][varchar(60)]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }

        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'shop_provincia'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN shop_provincia varchar (60)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [shop_provincia][varchar(60)]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }

        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'shop_telefono'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN shop_telefono varchar (60)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [shop_telefono][varchar(60)]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }

        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'ret'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN ret varchar (2)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [ret][varchar(2)]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }

        // Creamos columna ncx en Carrier
        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "carrier LIKE 'ncx'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "carrier ADD COLUMN ncx varchar (50)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [ncx][varchar(50)]en " . _DB_PREFIX_ . "carrier");
            } catch (Exception $e) {}
        }

        // Creamos campo serv_cod para documentacion nacex c@mbio
        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'serv_cod'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN serv_cod varchar (2)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [serv_cod][varchar(2)]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }

        // Creamos campo estado para documentacion nacex c@mbio
        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'estado'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN estado varchar (20)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [estado][varchar(20)]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }

        // Creamos campo estado para documentacion nacex c@mbio
        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'fecha_estado'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN fecha_estado datetime";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [fecha_estado][datetime]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }
        // Añadimos columna en la tabla carrier para guardar el id del servicio nacex correspondiente a cada carrier.
        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "carrier LIKE 'tip_serv'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "carrier ADD COLUMN tip_serv varchar (2)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [tip_serv][varchar(2)]en " . _DB_PREFIX_ . "carrier");
            } catch (Exception $e) {}
        }

        // Creamos campo imp_ree en tabla nacex_expediciones
        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones LIKE 'imp_ree'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD COLUMN imp_ree decimal(8,3)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [imp_ree][decimal(5,3)]en " . _DB_PREFIX_ . "nacex_expediciones");
            } catch (Exception $e) {}
        }

        // Creamos campo imp_ree en tabla nacex_expediciones_his
        Db::getInstance()->Execute("SHOW COLUMNS FROM " . _DB_PREFIX_ . "nacex_expediciones_his LIKE 'imp_ree'");
        if (Db::getInstance()->Affected_Rows() == 0) {
            $query = "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones_his ADD COLUMN imp_ree decimal(8,3)";
            try {
                Db::getInstance()->Execute($query);
                nacexutils::writeNacexLog("createTablesIfNotExists :: Alter table [imp_ree][decimal(5,3)]en " . _DB_PREFIX_ . "nacex_expediciones_his");
            } catch (Exception $e) {}
        }


        // update V2.2.0.10
        $existe_constrain = Db::getInstance()->ExecuteS("select CONSTRAINT_NAME
                                   from information_schema.KEY_COLUMN_USAGE
                                   where TABLE_NAME = '" . _DB_PREFIX_ . "nacex_expediciones' and 
                                   CONSTRAINT_NAME ='UC_NCX_expedicion'
                                   limit 1");

        if (! $existe_constrain) {
            try {
                Db::getInstance ()->Execute ( "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones DROP PRIMARY KEY ");
                Db::getInstance ()->Execute ( "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones ADD CONSTRAINT UC_NCX_expedicion UNIQUE (id_envio_order,exp_cod) ");

                nacexutils::writeNacexLog("createTablesIfNotExists : update V2.1.0.3");
            } catch ( Exception $e ) {
                nacexutils::writeNacexLog("ERROR createTablesIfNotExists : update V2.1.0.3");
            }
        }else{
            //update V2.1.0.11
            try {
                Db::getInstance ()->Execute ( "ALTER TABLE " . _DB_PREFIX_ . "nacex_expediciones DROP PRIMARY KEY ");
            } catch ( Exception $e ) {	   }
        }


        nacexutils::writeNacexLog("FIN createTablesIfNotExists");
        nacexutils::writeNacexLog("----");
    }

    public static function getDetallepedido($idorder)
    {
        $sql = 'SELECT o.id_order,o.module,u.email,a.firstname,
			a.lastname,a.address1,a.postcode,a.city,a.other,a.id_state,a.phone,a.phone_mobile,z.iso_code,
			case when o.total_paid_real > 0 
			then o.total_paid_real
			else
			o.total_paid
			end as total_paid_real
			FROM ' . _DB_PREFIX_ . 'orders AS o
			JOIN ' . _DB_PREFIX_ . 'customer AS u
			JOIN ' . _DB_PREFIX_ . 'address a
			JOIN ' . _DB_PREFIX_ . 'country AS z
			WHERE o.id_order = "' . $idorder . '"
			AND u.id_customer = o.id_customer
			AND a.id_address = o.id_address_delivery
			AND a.id_country = z.id_country';

        $result = Db::getInstance()->ExecuteS($sql);

        return $result;
    }
    public static function DeleteTables()
    {
        nacexutils::writeNacexLog("----");
        nacexutils::writeNacexLog("INI DropTables");
// Borramos la tabla para las expediciones
        $query = "DROP TABLE " . _DB_PREFIX_ . "nacex_expediciones";

        if (! Db::getInstance()->Execute($query)) {
            nacexutils::writeNacexLog("DropTables :: Error al borrar tabla nacex_expediciones");
            return false;
        }
        $query = "DROP TABLE " . _DB_PREFIX_ . "nacex_expediciones_his";

        if (! Db::getInstance()->Execute($query)) {
            nacexutils::writeNacexLog("DropTables :: Error al borrar tabla nacex_expediciones_his");
            return false;
        }
        nacexutils::writeNacexLog("FIN DropTables");
        nacexutils::writeNacexLog("----");
        return true;
    }
    public static function DeleteConfiguration()
    {
        nacexutils::writeNacexLog("----");
        nacexutils::writeNacexLog("INI DeleteConfiguration");
// Borramos la configuración
        $query = "DELETE from " . _DB_PREFIX_ . "configuration WHERE name LIKE 'NACEX%'";
        if (! Db::getInstance()->Execute($query)) {
            nacexutils::writeNacexLog("DeleteConfiguration :: Error al borrar la configuración.");
            return false;
        }
        nacexutils::writeNacexLog("FIN DeleteConfiguration");
        nacexutils::writeNacexLog("----");
        return true;
    }

    /*** Añadimos las zonas Nacex y verificamos que se muestre el campo de Provincia en el checkout ***/
    public static function initNcxZones()
    {
        $zones = array('NCX - España peninsular', 'NCX - Baleares', 'NCX - Canarias', 'NCX - Ceuta y Melilla',
            'NCX - Portugal', 'NCX - Internacional Zona 1 - 2', 'NCX - Internacional Zona 3 - 5');

        nacexutils::writeNacexLog("----");
        nacexutils::writeNacexLog("INI initNcxZones");

        //Tenemos que añadir las zonas a ps_zone_shop

        $id_code_carrier = array();
        $code_carrier = Db::getInstance()->ExecuteS('SELECT id_carrier,name FROM ' . _DB_PREFIX_ . "carrier WHERE name LIKE 'NACEX%'");
        /* id => codigo */
        foreach ($code_carrier as $code) {
            $cod = explode('_', $code['name'])[1];
            if ($cod != 'std' && $cod != 'shp')
                $id_code_carrier[$code['id_carrier']] = $cod;

            /*nacexutils::writeNacexLog("Limpiamos la tabla " . _DB_PREFIX_ . "carrier_zone de las zonas asignadas que no corresponden a Nacex.");
            // Limpiar las asignaciones de las otras zonas a los transportistas
            $delete = 'DELETE FROM ' . _DB_PREFIX_ . 'carrier_zone WHERE id_carrier = ' . $code['id_carrier'];
            Db::getInstance()->Execute($delete);
            nacexutils::writeNacexLog("¡Limpiada tabla!");
            nacexutils::writeNacexLog("----");*/

            nacexutils::writeNacexLog("Asignamos los rangos de peso y sus precios");
            $rangeWeight = new RangeWeight();
            $rangeWeight->id_carrier = $code['id_carrier'];
            $rangeWeight->delimiter1 = '0';
            $rangeWeight->delimiter2 = '1000000000';
            $rangeWeight->add();
        }

        foreach ($zones as $zone) {

            // Verificamos que no están creadas las zonas
            nacexutils::writeNacexLog("Comprobamos que no exista la zona");
            $select = Db::getInstance()->ExecuteS("SELECT id_zone FROM " . _DB_PREFIX_ . "zone WHERE name LIKE '" . $zone . "'");
            if (sizeof($select) == 0) {  // Si no hay ninguna creada, las creamos
                nacexutils::writeNacexLog("Creamos zona:: " . $zone);
                $insert = 'INSERT INTO ' . _DB_PREFIX_ . "zone (name,active) VALUES ('" . $zone . "',1)";
                if (!Db::getInstance()->Execute($insert)) {
                    nacexutils::writeNacexLog("initZones :: Error al crear la zona " . $zone);
                    return false;
                }
                $select = Db::getInstance()->ExecuteS("SELECT id_zone FROM " . _DB_PREFIX_ . "zone WHERE name LIKE '" . $zone . "'");

                // Lo trasladamos de fuera a esta posición para que no sobreescriba lo que el cliente pudiera tener por defecto
                self::asignarZona($zone,$id_code_carrier,$select);

                // Insertamos en la tabla _zone_shop la zona creada
                nacexutils::writeNacexLog("initZones :: ID_ZONA " . $select);
                //$insert_zone_shop = 'INSERT INTO ' . _DB_PREFIX_ . "zone_shop (name,active) VALUES ('" . $zone . "',1)";
//                if (!Db::getInstance()->Execute($insert_zone_shop)) {
//
//                }
            }
        }
        nacexutils::writeNacexLog("FIN initNcxZones");
        nacexutils::writeNacexLog("----");

        return true;
    }

    private static function asignarZona($zone,$id_code_carrier,$select) {

        nacexutils::writeNacexLog("----");
        nacexutils::writeNacexLog("INI asignarZona");
        $iva = 21;  // Está configurado en PS
        $shp = ['31','28','90'];
        $int = ['G','H'];

        // Hacemos consulta del IVA y de la tienda
        $id_tax_select =  Db::getInstance()->ExecuteS("SELECT id_tax_rules_group FROM " . _DB_PREFIX_ . "tax_rules_group WHERE name LIKE '%".$iva."%' AND active = 1");
        $id_tax = $id_tax_select[0]['id_tax_rules_group'];
        $id_tax_shop_select =  Db::getInstance()->ExecuteS("SELECT id_shop FROM " . _DB_PREFIX_ . "tax_rules_group_shop WHERE id_tax_rules_group = '".$id_tax."'");
        $id_tax_shop = $id_tax_shop_select[0]['id_shop'];
        // Creamos los rangos de peso para nuestras zonas
        $sql = Db::getInstance()->ExecuteS("SELECT id_range_weight,id_carrier FROM " . _DB_PREFIX_ . "range_weight");
        foreach ($sql as $id => $val) {
            $weightRange[$val['id_range_weight']] = $val['id_carrier'];
        }

        $update = '';

        // Miramos para cada una de las zonas cambiar el país (en el caso de Peninsular) y las provincias específicas
        switch ($zone) {
            case 'NCX - España peninsular':
                // id_country = 6 => España
                $update .= 'UPDATE ' . _DB_PREFIX_ . "country SET id_zone = ". $select[0]['id_zone'] . " WHERE iso_code = 'ES';";
                $update .= 'UPDATE ' . _DB_PREFIX_ . "state SET id_zone = ". $select[0]['id_zone'] . " WHERE id_country = 6;";
                // Revisar id's de métodos para descartar los internacionales
                foreach ($id_code_carrier as $code_id => $code_val) {
                    if(!in_array($code_val,$int)) {
                        // Asignamos el IVA a los métodos
                        $update .= 'INSERT INTO ' . _DB_PREFIX_ . 'carrier_tax_rules_group_shop (id_carrier, id_tax_rules_group, id_shop) VALUES ('.$code_id.','.$id_tax.','.$id_tax_shop.');';

                        Db::getInstance()->insert(
                            'carrier_zone',
                            array('id_carrier' => $code_id,'id_zone' => $select[0]['id_zone']),
                            false,
                            false,
                            Db::INSERT,
                            true
                        );

                        Db::getInstance()->insert(
                            'delivery',
                            array('id_carrier' => $code_id, 'id_range_price' => NULL, 'id_range_weight' => array_search($code_id, $weightRange), 'id_zone' => $select[0]['id_zone'], 'price' => '0'),
                            true,
                            false,
                            Db::INSERT,
                            true
                        );
                    }
                }
                break;
            case 'NCX - Baleares':
                $update .= 'UPDATE ' . _DB_PREFIX_ . "state SET id_zone = ". $select[0]['id_zone'] . " WHERE iso_code = 'ES-PM';";
                // Revisar id's de métodos para descartar los internacionales
                foreach ($id_code_carrier as $code_id => $code_val) {
                    if(!in_array($code_val,$int)) {

                        Db::getInstance()->insert(
                            'carrier_zone',
                            array('id_carrier' => $code_id,'id_zone' => $select[0]['id_zone']),
                            false,
                            false,
                            Db::INSERT,
                            true
                        );

                        Db::getInstance()->insert(
                            'delivery',
                            array('id_carrier' => $code_id, 'id_range_price' => NULL, 'id_range_weight' => array_search($code_id, $weightRange), 'id_zone' => $select[0]['id_zone'], 'price' => '0'),
                            true,
                            false,
                            Db::INSERT,
                            true
                        );
                    }
                }
                break;
            case 'NCX - Canarias':
                $update .= 'UPDATE ' . _DB_PREFIX_ . "state SET id_zone = ". $select[0]['id_zone'] . " WHERE iso_code IN ('ES-GC','ES-TF');";
                // Revisar id's de métodos para descartar los internacionales
                foreach ($id_code_carrier as $code_id => $code_val) {
                    if(!in_array($code_val,$int)) {

                        Db::getInstance()->insert(
                            'carrier_zone',
                            array('id_carrier' => $code_id,'id_zone' => $select[0]['id_zone']),
                            false,
                            false,
                            Db::INSERT,
                            true
                        );

                        Db::getInstance()->insert(
                            'delivery',
                            array('id_carrier' => $code_id, 'id_range_price' => NULL, 'id_range_weight' => array_search($code_id, $weightRange), 'id_zone' => $select[0]['id_zone'], 'price' => '0'),
                            true,
                            false,
                            Db::INSERT,
                            true
                        );
                    }
                }
                break;
            case 'NCX - Ceuta y Melilla':
                $update .= 'UPDATE ' . _DB_PREFIX_ . "state SET id_zone = ". $select[0]['id_zone'] . " WHERE iso_code IN ('ES-CE','ES-ML');";
                // Revisar id's de métodos para descartar los internacionales
                foreach ($id_code_carrier as $code_id => $code_val) {
                    if(!in_array($code_val,$int)) {

                        Db::getInstance()->insert(
                            'carrier_zone',
                            array('id_carrier' => $code_id,'id_zone' => $select[0]['id_zone']),
                            false,
                            false,
                            Db::INSERT,
                            true
                        );

                        Db::getInstance()->insert(
                            'delivery',
                            array('id_carrier' => $code_id, 'id_range_price' => NULL, 'id_range_weight' => array_search($code_id, $weightRange), 'id_zone' => $select[0]['id_zone'], 'price' => '0'),
                            true,
                            false,
                            Db::INSERT,
                            true
                        );
                    }
                }
                break;
            case 'NCX - Portugal':
                $update .= 'UPDATE ' . _DB_PREFIX_ . "country SET id_zone = ". $select[0]['id_zone'] . " WHERE iso_code = 'PT';";

                // Revisar id's de métodos para descartar los shops y los internacionales
                foreach ($id_code_carrier as $code_id => $code_val) {
                    if(!in_array($code_val,$int) && !in_array($code_val,$shp)) {

                        // Asignamos el IVA a los métodos
                        $update .= 'INSERT INTO ' . _DB_PREFIX_ . 'carrier_tax_rules_group_shop (id_carrier, id_tax_rules_group, id_shop) VALUES ('.$code_id.','.$id_tax.','.$id_tax_shop.');';

                        Db::getInstance()->insert(
                            'carrier_zone',
                            array('id_carrier' => $code_id,'id_zone' => $select[0]['id_zone']),
                            false,
                            false,
                            Db::INSERT,
                            true
                        );

                        Db::getInstance()->insert(
                            'delivery',
                            array('id_carrier' => $code_id, 'id_range_price' => NULL, 'id_range_weight' => array_search($code_id, $weightRange), 'id_zone' => $select[0]['id_zone'], 'price' => '0'),
                            true,
                            false,
                            Db::INSERT,
                            true
                        );
                    }
                }
                break;
            case 'NCX - Internacional Zona 1 - 2':
                foreach (nacexDTO::INTERNACIONAL1 as $int1) {
                    $update .= 'UPDATE ' . _DB_PREFIX_ . "country SET id_zone = ". $select[0]['id_zone'] . " WHERE iso_code = '".$int1."';";

                    // Revisar id's de métodos para descartar los shops y los internacionales
                    foreach ($id_code_carrier as $code_id => $code_val) {
                        if(in_array($code_val,$int)) {
                            // Asignamos el IVA a los métodos
                            $update .= 'INSERT INTO ' . _DB_PREFIX_ . 'carrier_tax_rules_group_shop (id_carrier, id_tax_rules_group, id_shop) VALUES ('.$code_id.','.$id_tax.','.$id_tax_shop.');';

                            Db::getInstance()->insert(
                                'carrier_zone',
                                array('id_carrier' => $code_id,'id_zone' => $select[0]['id_zone']),
                                false,
                                false,
                                Db::INSERT,
                                true
                            );

                            Db::getInstance()->insert(
                                'delivery',
                                array('id_carrier' => $code_id, 'id_range_price' => NULL, 'id_range_weight' => array_search($code_id, $weightRange), 'id_zone' => $select[0]['id_zone'], 'price' => '0'),
                                true,
                                false,
                                Db::INSERT,
                                true
                            );
                        }
                    }
                }
                break;
            case 'NCX - Internacional Zona 3 - 5':
                foreach (nacexDTO::INTERNACIONAL2 as $int3) {
                    $update .= 'UPDATE ' . _DB_PREFIX_ . "country SET id_zone = ". $select[0]['id_zone'] . " WHERE iso_code = '".$int3."';";

                    // Revisar id's de métodos para descartar los shops y los internacionales
                    foreach ($id_code_carrier as $code_id => $code_val) {
                        if(in_array($code_val,$int)) {
                            // Asignamos el IVA a los métodos
                            $update .= 'INSERT INTO ' . _DB_PREFIX_ . 'carrier_tax_rules_group_shop (id_carrier, id_tax_rules_group, id_shop) VALUES ('.$code_id.','.$id_tax.','.$id_tax_shop.');';

                            Db::getInstance()->insert(
                                'carrier_zone',
                                array('id_carrier' => $code_id,'id_zone' => $select[0]['id_zone']),
                                false,
                                false,
                                Db::INSERT,
                                true
                            );

                            Db::getInstance()->insert(
                                'delivery',
                                array('id_carrier' => $code_id, 'id_range_price' => NULL, 'id_range_weight' => array_search($code_id, $weightRange), 'id_zone' => $select[0]['id_zone'], 'price' => '0'),
                                true,
                                false,
                                Db::INSERT,
                                true
                            );
                        }
                    }
                }
                break;
        }

        nacexutils::writeNacexLog("Asignamos la zona con países y regiones que correspondientes.");
        nacexutils::writeNacexLog("Consulta a ejecutar::");
        nacexutils::writeNacexLog($update);

        Db::getInstance()->Execute($update);

        nacexutils::writeNacexLog("¡Consulta realizada!");

        nacexutils::writeNacexLog("FIN asignarZona");
        nacexutils::writeNacexLog("----");
    }

    public static function deleteNcxZones() {
        nacexutils::writeNacexLog("----");
        nacexutils::writeNacexLog("INI deleteNcxZones");

        $code_carrier = Db::getInstance()->ExecuteS('SELECT id_carrier FROM ' . _DB_PREFIX_ . "carrier WHERE ncx != ''");
        $delete = '';

        foreach ($code_carrier as $code) {
            nacexutils::writeNacexLog("Eliminando datos de la tabla " . _DB_PREFIX_ . "carrier_group");
            $delete .= 'DELETE FROM ' . _DB_PREFIX_ . 'carrier_group WHERE id_carrier = '.$code['id_carrier'].';';

            nacexutils::writeNacexLog("Eliminando datos de la tabla " . _DB_PREFIX_ . "carrier_lang");
            $delete .= 'DELETE FROM ' . _DB_PREFIX_ . 'carrier_lang WHERE id_carrier = '.$code['id_carrier'].';';

            nacexutils::writeNacexLog("Eliminando datos de la tabla " . _DB_PREFIX_ . "carrier_shop");
            $delete .= 'DELETE FROM ' . _DB_PREFIX_ . 'carrier_shop WHERE id_carrier = '.$code['id_carrier'].';';

            nacexutils::writeNacexLog("Eliminando datos de la tabla " . _DB_PREFIX_ . "carrier_tax_rules_group_shop");
            $delete .= 'DELETE FROM ' . _DB_PREFIX_ . 'carrier_tax_rules_group_shop WHERE id_carrier = '.$code['id_carrier'].';';

            nacexutils::writeNacexLog("Eliminando datos de la tabla " . _DB_PREFIX_ . "carrier_zone");
            $delete .= 'DELETE FROM ' . _DB_PREFIX_ . 'carrier_zone WHERE id_carrier = '.$code['id_carrier'].';';

            nacexutils::writeNacexLog("Eliminando datos de la tabla " . _DB_PREFIX_ . "delivery");
            $delete .= 'DELETE FROM ' . _DB_PREFIX_ . 'delivery WHERE id_carrier = '.$code['id_carrier'].';';
            //$delete .= 'DELETE FROM ' . _DB_PREFIX_ . 'range_price WHERE id_carrier = '.$code['id_carrier'].';';

            nacexutils::writeNacexLog("Eliminando datos de la tabla " . _DB_PREFIX_ . "range_weight");
            $delete .= 'DELETE FROM ' . _DB_PREFIX_ . 'range_weight WHERE id_carrier = '.$code['id_carrier'].';';
        }

        nacexutils::writeNacexLog("------");
        nacexutils::writeNacexLog("Borrando zonas...");
        $delete .= 'DELETE FROM ' . _DB_PREFIX_ . "zone WHERE name LIKE 'NCX - %'";

        if (! Db::getInstance()->Execute($delete)) {
            nacexutils::writeNacexLog("deleteNcxZones :: Error al desinstalar los datos de las tablas y las zonas.");
            return false;
        }

        nacexutils::writeNacexLog("deleteNcxZones:: consulta 1 realizada");
        nacexutils::writeNacexLog($delete);

        // Tenemos que borrar la asignación de las nuevas zonas creadas a los carriers

        // Dejamos asignados los países a las zonas que tocan (Europa)
        /*$update = 'UPDATE ' . _DB_PREFIX_ . "country SET id_zone = 1 WHERE iso_code = 'ES';";
        $update .= 'UPDATE ' . _DB_PREFIX_ . "state SET id_zone = 1 WHERE id_country = 6";*/

        $paises = array_merge(nacexDTO::NACIONAL,nacexDTO::INTERNACIONAL1,nacexDTO::INTERNACIONAL2);
        $noEU = ['AD','GI','NO','CH'];
        $update = '';
        foreach ($paises as $pais) {
            $idZone = in_array($pais,$noEU) ? 7 : 1;

            $update .= 'UPDATE ' . _DB_PREFIX_ . "country SET id_zone = '".$idZone."' WHERE iso_code = '".$pais."';";

            if($pais == 'ES')
                $update .= 'UPDATE ' . _DB_PREFIX_ . "state SET id_zone = '".$idZone."' WHERE id_country = (SELECT id_country FROM " . _DB_PREFIX_ . "country WHERE iso_code = '".$pais."');";
        }

        nacexutils::writeNacexLog("Reestablecemos zonas originales de Prestashop");
        Db::getInstance()->Execute($update);

        nacexutils::writeNacexLog("FIN deleteNcxZones");
        nacexutils::writeNacexLog("----");

        return true;
    }

    public static function actualizaEstadoPedido($order_id,$tipo) {
        $textlog = '';
        $configType = '';
        if($tipo == 'd') {
            $textlog = 'Documentar la expedición';
            $configType = 'GENERAR';
        } elseif ($tipo == 'i') {
            $textlog = 'Imprmir la etiqueta';
            $configType = 'IMPRIMIR';
        } elseif ($tipo == 'c') {
            $textlog = 'Cancelar la expedición';
            $configType = 'CANCELAR';
        } elseif ($tipo == 'o') {
            $textlog = 'finalizar Expedición estado OK';
            $configType = 'OK';
        }

            // Cambiamos el estado del pedido al Imprimir la etiqueta y al Documentar expedición (siempre va a haber una opción seleccionada)
            $configOrderStatus = Configuration::get('NACEX_CAMBIAR_ESTADO_' . $configType);
            if ($configOrderStatus != '') {
                nacexutils::writeNacexLog("order :: Cambiamos el estado del pedido al " . $textlog);
                $estadoNoCambia = Configuration::get('NACEX_NO_CAMBIAR_ESTADO_A_OK');
                self::updateOrderStatus($order_id, $configOrderStatus, $estadoNoCambia);

                // Si actualizar pedido es diferente de N y la opción de enviar email informando al usuario está habilitada
                /*if($this->envPed) {
                    nacexutils::writeNacexLog("order :: Enviamos email para informar del cambio de estado");
                    $this->email->sendUpdateOrderEmail($order_id);
                }*/
            }
    }

    private static function updateOrderStatus($orderId, $configOrderStatus, $estadoNoCambia)
    {
        $new_history = new OrderHistory();
        $new_history->id_order = (int)$orderId;

        $order = new Order($orderId);
        $OrderStatusActual = $order->getCurrentState();

        // Obtener el listado de estados del pedido y comprobar que no se cambie si ya existia ese estado anteriormente:
        $estados = $order->getHistory( $order->id_lang);
        foreach ($estados as $estado) {
            if ($estado['id_order_state'] == (int)$configOrderStatus) {
                $estadoEncontrado = true;
                break;
            }
        }
        $noCambiarEstado = (!in_array($OrderStatusActual, explode('|', $estadoNoCambia))) ? false : true;

        if (!$estadoEncontrado) {
            if ($OrderStatusActual != $configOrderStatus && !$noCambiarEstado) {
                nacexutils::writeNacexLog("updateOrderStatus :: Estado actual del pedido: " . $OrderStatusActual);
                nacexutils::writeNacexLog("updateOrderStatus :: Cambia el estado a " . (int)$configOrderStatus . " ya que es diferente al actual");
                $new_history->changeIdOrderState((int)$configOrderStatus, (int)($orderId));

                //$new_history->add(true);
                /* Envío de emails al actualizar el pedido */
                $new_history->addWithemail(); // Para enviar el email
                $new_history->save();
            }
        }
    }

    private function getShippingExternal()
    {
        if (version_compare(_PS_VERSION_, '1.7.8.2', '>=')) return 1;
        else return 0;
    }

    public static function getGestionAgencia($datosexpedicion, $canPrint)
    {

        $respuestaGetEstadoExpedicion = null;
        $estadosComprobacion = ['INCIDENCIA EXPEDICION', 'INCIDENCIA', 'TRANSITO', 'REPARTO', 'PENDIENTE', 'PENDIENTE DE INTEGRA', ''];

        if (in_array($datosexpedicion['estado'], $estadosComprobacion)) {
            $respuestaGetEstadoExpedicion = nacexWS::ws_getEstadoExpedicion($datosexpedicion);
            $getDatosWSExpedicion = nacexWS::ws_getDatosWSExpedicion($datosexpedicion["exp_cod"]);
        } else {
            $respuestaGetEstadoExpedicion = $datosexpedicion;
            $getDatosWSExpedicion = null;
        }

        /*
         * Valores para [estado_code]
         * Estados marcados que no admiten gestión por parte del usuario (anulación o impresión de etiqueta
         *
         * Recogida
         * Estado_code Estado Interno
         * 10 SOLICITADO SOL
         * 11 PENDIENTE PEND
         * 12 PENDIENTE LEIDA
         * 13 RECHAZADA RECHAZA
         * 14 PENDIENTE CONFIRM
         * 15 ASIGNADA A MENSAJERO PARA RECOGER ASIGNADA
         * 16 RECOGIDA CON OK
         * 17 INCIDENCIA RECOGIDA SIN OK
         * 18 (no se envía este estado) ELIMINA
         *
         * Expedición
         * Estado_code Estado Interno
         * 1 RECOGIDO RECOG.
         * 2 TRANSITO TRANSITO
         * 3 REPARTO REPARTO
         * 4 OK OK
         * Ver Código incidencia INCIDENCIA SOL SIN OK (ver incidencias, cierre n/s) SOL N OK
         * Ver Código incidencia SOL SIN OK ANULADA
         * 9 ANULADA ANULADA
         *
         * Estado expedicion 5614 => cuando se ha pistoleado y no se puede modificar el estado
         *
         */
        try {
            $gestionAgencia = !(is_null($respuestaGetEstadoExpedicion) && empty($respuestaGetEstadoExpedicion) && is_null($getDatosWSExpedicion)) ?
                ((isset($respuestaGetEstadoExpedicion["estado_code"]) && !in_array($respuestaGetEstadoExpedicion["estado_code"], array("16", "1", "2", "3", "4"))) ||
                    $respuestaGetEstadoExpedicion["estado"] == "ANULADA" || $respuestaGetEstadoExpedicion["estado"] == "BAJA" ||
                    (isset($getDatosWSExpedicion[2]) && $getDatosWSExpedicion[2] == "5611") || !$canPrint) : false;
        } catch (Exception $e) { // no existe estado previo
            $gestionAgencia = false;
        }

        return $gestionAgencia;
    }
}

?>