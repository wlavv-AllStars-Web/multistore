<?php

/*
 * mexpositop 2017
 */

include_once dirname(__FILE__) ."/AdminConfig.php";
include_once dirname(__FILE__) . "/nacexutils.php";
include_once dirname(__FILE__) . "/LBnewService.php";


class nacexDTO {

    public $id_carrier;
    static $URL_PRO_Applets = "www.nacex.es/applets";
    static $_http = "http://";
    static $_https = "https://";
    private $SERV_SEP = " - ";

    static $url_ws = "https://pda.nacex.com/nacex_ws";
    static $url_iona = "https://iona.nacex.com:8000/";
    static $url_seguimiento = "https://www.nacex.es";
    static $comentarios_cliente = 'delivery_message';

    const _new_services_filename = 'addedServicios.csv';
    const _path_new_services = _PS_MODULE_DIR_ . 'nacex/files/';

    private $SERVICIOS = array(
        "01" => array("nombre" => "NACEX 10:00H o ISLAS AZORES Y MADEIRA",
            "descripcion" => "Garantia de entrega antes de las 10:00H del dia siguiente laborable.Tambien, Servicio aereo con garantía de entrega en un plazo de 2 y 5 dias."),
        "02" => array("nombre" => "NACEX 12:00H",
            "descripcion" => "Garantia de entrega antes de las 12:00H del día siguiente laborable."),
        "04" => array("nombre" => "PLUS BAG",
            "descripcion" => "Garantia de entrega en 24/48 horas en poblaciones con agencia NACEX."),
        "08" => array("nombre" => "NACEX 19:00H",
            "descripcion" => "Garantia de entrega antes de las 19:00h del dia siguiente laborable"),
        "09" => array("nombre" => "PUENTE URBANO",
            "descripcion" => "Servicio con garantía de entrega en Ambito urbano con varias frecuencias"),
        "11" => array("nombre" => "NACEX 08:30H",
            "descripcion" => "Garantia de entrega antes de las 8:30h en día siguiente laborable"),
        "20" => array("nombre" => "NACEX MALLORCA MARÍTIMO",
            "descripcion" => "Servicio entre Peninsula y Mallorca, garantia de entrega 1-3 dias."),
        "21" => array("nombre" => "NACEX SABADO",
            "descripcion" => "Entregas en sabados de 9:00 h. a 13:00 h."),
        "22" => array("nombre" => "CANARIAS MARITIMO",
            "descripcion" => "Servicio interinsular maritimo entre 24 y 72 h."),
        "26" => array("nombre" => "PLUS PACK",
            "descripcion" => "Envios masivos monobulto a destinos peninsulares"),
        "27" => array("nombre" => "E-NACEX",
            "descripcion" => "Entregas de pedidos originados por e-commerce "),
        "24" => array("nombre" => "CANARIAS 24 HORAS",
            "descripcion" => "Servicio aereo con garantía de entrega en un plazo de 24 horas."),
        "48" => array("nombre" => "CANARIAS 48 HORAS",
            "descripcion" => "Servicio aereo con garantía de entrega en un plazo de 48 horas.")
    );
    private $SERVICIOS_INT = array(
        "G" => array("nombre" => "EURONACEX ECONOMY",
            "descripcion" => "Servicio terrestre desde la península con tarifa especial al resto de Europa para envíos monobulto."),
        "H" => array("nombre" => "PLUSPACK EUROPE",
            "descripcion" => "Monobulto hasta 20 kg desde PenInsula a los principales paises europeos")
    );
    private $SERVICIOS_NACEX_SHOP = array(
        /*"28" => array("nombre" => "PREMIUM",
            "descripcion" => "Entrega en puntos Nacex.shop a partir de las 10:00h del dia siguiente laborable"),*/
        "31" => array("nombre" => "E-NACEXSHOP",
            "descripcion" => "Entrega en puntos Nacex.shop para clientes con plataforma e-commerce")/*,
        "90" => array("nombre" => "NACEX.SHOP",
            "descripcion" => "NACEX.SHOP")*/
    );
    private $SEGUROS = array(
        "N" => array("nombre" => "Sin seguro",
            "descripcion" => "Sin seguro"),
        "A" => array("nombre" => "Seguro general",
            "descripcion" => "Seguro general"),
        "B" => array("nombre" => "Joyeria",
            "descripcion" => "Joyería"),
        "C" => array("nombre" => "Telefonia",
            "descripcion" => "Telefonia"),
        "D" => array("nombre" => "Varios",
            "descripcion" => "Varios"),
        "E" => array("nombre" => "Armas",
            "descripcion" => "Armas"),
        "F" => array("nombre" => "Loterías",
            "descripcion" => "Loterías")
    );
    private $CONTENIDOS = array('OTROS', 'ARMAS (DOCUMENTACION NECESARIA)', 'DOCUMENTS/DOCUMENTOS', 'MUESTRAS BIOLOGICAS',
        'ALIMENTOS / PREP. ALIMENTICIOS / PROD. DIETETICOS / VINOS', 'APARATOS MUSICA / VIDEOJUEGOS / DISCOS COMPACTOS',
        'CONFECCIONES / TEXTILES / CALZADO', 'EFECTOS PERSONALES', 'ETILOMETRO', 'JOYERIA / BISUTERIA / RELOJES',
        'MANUF. MADERA / MANUF. ALUMINIO / MANUF. PLASTICO', 'MAT. INFORMATICO / MAT. ELECTRONICO / MAT. TELEFONICO',
        'MAT. MEDICO / MAT. ORTOPEDICO / REACTIVOS', 'MAT. PAPELERIA / BOLIGRAFOS', 'MAT. PUBLICITARIO / CALENDARIOS',
        'MEDICAMENTOS', 'MERCANCIA PELIGROSA', 'PROD. PARAFARMACIA / COSMETICOS / APOSITOS (VENDAS,GASAS)',
        'REPUESTOS MAQUINARIA / OTROS REPUESTOS', 'TARJETA CON TIRA MAGNETICA');
    /*
      private $DESTINOS = array(
      "TOD"   => array(	"nombre" => "Qualquier destino"),
      "EPA" 	=> array(	"nombre" => "Esp/Port/And"),
      "PEN" 	=> array(	"nombre" => "Peninsular")
      );
     */

    /**
     * Métodos de cálculo del coste de envío
     */
    private $CAL = array(
        ["value" => "flat_rate",    "label" => "Importe fijo"],
        ["value" => "web_service",  "label" => "Importe calculado por el WebService"],
        ["value" => "table_rates",  "label" => "Importe según zona y peso"]
    );
     
     
    /**
     * Modelos Etiquetadoras
     */
    private $MET = array(
        ["value" => "TECSV4_B", "label" => "TECSV4"],
        ["value" => "TECEV4_B", "label" => "TECEV4"],
        ["value" => "TECFV4_B", "label" => "TECFV4"],
        //["value" => "LASER_A6", "label" => "LASER A6"],
        //["value" => "LASER_A5", "label" => "LASER A5"],
        ["value" => "ZEBRA_B", "label" => "ZEBRA"],
        ["value" => "PDF_B", "label" => "LASER"]
    );

    const PROVINCIAS_ES = array(
        "ALAVA/ARABA" => array(
            "Codigo"        => "01"),
        "ALBACETE" => array(
            "Codigo"        => "02"),
        "ALICANTE/ALACANT" => array(
            "Codigo"        => "03"),
        "ALMERIA" => array(
            "Codigo"        => "04"),
        "AVILA" => array(
            "Codigo"        => "05"),
        "BADAJOZ" => array(
            "Codigo"        => "06"),
        "BALEARES" => array(
            "Codigo"        => "07"),
        "BARCELONA" => array(
            "Codigo"        => "08"),
        "BURGOS" => array(
            "Codigo"        => "09"),
        "CACERES" => array(
            "Codigo"        => "10"),
        "CADIZ" => array(
            "Codigo"        => "11"),
        "CASTELLON" => array(
            "Codigo"        => "12"),
        "CIUDAD REAL" => array(
            "Codigo"        => "13"),
        "CORDOBA" => array(
            "Codigo"        => "14"),
        "A CORUÑA" => array(
            "Codigo"        => "15"),
        "CUENCA" => array(
            "Codigo"        => "16"),
        "GIRONA" => array(
            "Codigo"        => "17"),
        "GRANADA" => array(
            "Codigo"        => "18"),
        "GUADALAJARA" => array(
            "Codigo"        => "19"),
        "GUIPUZCOA/GIPUZKOA" => array(
            "Codigo"        => "20"),
        "HUELVA" => array(
            "Codigo"        => "21"),
        "HUESCA" => array(
            "Codigo"        => "22"),
        "JAEN" => array(
            "Codigo"        => "23"),
        "LEON" => array(
            "Codigo"        => "24"),
        "LLEIDA" => array(
            "Codigo"        => "25"),
        "RIOJA, LA" => array(
            "Codigo"        => "26"),
        "LUGO" => array(
            "Codigo"        => "27"),
        "MADRID" => array(
            "Codigo"        => "28"),
        "MALAGA" => array(
            "Codigo"        => "29"),
        "MURCIA" => array(
            "Codigo"        => "30"),
        "NAVARRA" => array(
            "Codigo"        => "31"),
        "OURENSE" => array(
            "Codigo"        => "32"),
        "ASTURIAS" => array(
            "Codigo"        => "33"),
        "PALENCIA" => array(
            "Codigo"        => "34"),
        "PALMAS, LAS" => array(
            "Codigo"        => "35"),
        "PONTEVEDRA" => array(
            "Codigo"        => "36"),
        "SALAMANCA" => array(
            "Codigo"        => "37"),
        "SANTA CRUZ DE TENERIFE" => array(
            "Codigo"        => "38"),
        "CANTABRIA" => array(
            "Codigo"        => "39"),
        "SEGOVIA" => array(
            "Codigo"        => "40"),
        "SEVILLA" => array(
            "Codigo"        => "41"),
        "SORIA" => array(
            "Codigo"        => "42"),
        "TARRAGONA" => array(
            "Codigo"        => "43"),
        "TERUEL" => array(
            "Codigo"        => "44"),
        "TOLEDO" => array(
            "Codigo"        => "45"),
        "VALENCIA" => array(
            "Codigo"        => "46"),
        "VALLADOLID" => array(
            "Codigo"        => "47"),
        "VIZCAYA/BIZKAIA" => array(
            "Codigo"        => "48"),
        "ZAMORA" => array(
            "Codigo"        => "49"),
        "ZARAGOZA" => array(
            "Codigo" => "50"),
        "CEUTA" => array(
            "Codigo" => "51"),
        "MELILLA" => array(
            "Codigo" => "52")
    );
    public static $PREFIJO_REFERENCIA = "pedido_";

    const NACIONAL = ['ES', 'PT', 'AD', 'GI'];
    //const INTERNACIONAL1 = ['FR', 'DE', 'IT', 'NL', 'UK', 'LU', 'BE'];
    const INTERNACIONAL1 = ['FR', 'DE', 'IT', 'NL', 'GB', 'LU', 'BE'];
    const INTERNACIONAL2 = ['AT', 'GR', 'SK', 'EE', 'FI', 'HU', 'IE', 'LV', 'LT', 'NO', 'PL', 'CZ', 'SE', 'CH'];

    /**
     * @return string
     */
    public function getPREFIJOREFERENCIA()
    {
        return $this->PREFIJO_REFERENCIA;
    }

    /**
     * @param string $PREFIJO_REFERENCIA
     */
    public function setPREFIJOREFERENCIA($PREFIJO_REFERENCIA)
    {
        $this->PREFIJO_REFERENCIA = $PREFIJO_REFERENCIA;
    }


    public function __construct()
    {

    }

    public function __destruct()
    {

    }

    public static function isNacexCarrier($id_carrier)
    {
        $datoscarrier = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier c WHERE c.id_carrier = "' . $id_carrier . '" AND ncx IN ("nacex","nacexG")');

        if (isset($datoscarrier) && isset($datoscarrier[0])) {
            nacexutils::writeNacexLog("isNacexCarrier :: [" . $id_carrier . "] => " . ($datoscarrier[0]['external_module_name'] == "nacex" && ($datoscarrier[0]['ncx'] == "nacex" || $datoscarrier[0]['ncx'] == "nacexG")));
            return $datoscarrier[0];
        } else {
            nacexutils::writeNacexLog("isNacexCarrier :: [" . $id_carrier . "] => false");
            return false;
        }
    }

    public static function isNacexShopCarrier($id_carrier)
    {
        $datoscarrier = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier c WHERE c.id_carrier = "' . $id_carrier . '" AND ncx IN ("nacexshop","nacexshopG")');

        // Comprobamos si los módulos externos se encuentran entre los shop
        $externalCarriers = explode('|', Configuration::get('NACEXSHOP_EXTERNAL_MODULES'));

        if (isset($datoscarrier) && isset($datoscarrier[0])) {
            nacexutils::writeNacexLog("isNacexShopCarrier :: [" . $id_carrier . "] => " . (($datoscarrier[0]['ncx'] == "nacexshop" || $datoscarrier[0]['ncx'] == "nacexshopG")));
            return $datoscarrier[0];
        } elseif (in_array($id_carrier, $externalCarriers)) {
            nacexutils::writeNacexLog("isNacexShopCarrier :: external[" . $id_carrier . "] => true");
            $car = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier c WHERE c.id_carrier = "' . $id_carrier . '"');
            //return new Carrier($id_carrier);
            return $car[0];
        } else {
            nacexutils::writeNacexLog("isNacexShopCarrier :: [" . $id_carrier . "] => false");
            return false;
        }
    }

    public static function isNacexIntCarrier($id_carrier) {
        $datoscarrier = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'carrier c WHERE c.id_carrier = "' . $id_carrier . '" AND ncx IN ("nacexint","nacexintG")');

        if (isset($datoscarrier) && isset($datoscarrier[0])) {
            nacexutils::writeNacexLog("isNacexIntCarrier :: [" . $id_carrier . "] => " . ($datoscarrier[0]['external_module_name'] == "nacex" && ($datoscarrier[0]['ncx'] == "nacexint" || $datoscarrier[0]['ncx'] == "nacexintG")));
            return $datoscarrier[0];
        } else {
            nacexutils::writeNacexLog("isNacexIntCarrier :: [" . $id_carrier . "] => false");
            return false;
        }
    }

    public static function getNacexIdCarrier() {
        return Configuration::get('TRANSPORTISTA_NACEX') === false ? Configuration::get('NACEX_DEFAULT_TIP_SER') : Configuration::get('TRANSPORTISTA_NACEX');
    }

    public static function getNacexShopIdCarrier() {
        return Configuration::get('TRANSPORTISTA_NACEXSHOP') === false ? Configuration::get('NACEX_DEFAULT_TIP_NXSHOP_SER') : Configuration::get('TRANSPORTISTA_NACEXSHOP');
    }

    /* cogemos los transportistas internacionales */
    public static function getNacexIntIdCarrier() {
        return Configuration::get('TRANSPORTISTA_NACEXINT') === false ? Configuration::get('NACEX_DEFAULT_TIP_SER_INT') : Configuration::get('TRANSPORTISTA_NACEXINT');
    }

    public function getSeguros() {
        return $this->SEGUROS;
    }

    public function getContenidos()
    {
        return $this->CONTENIDOS;
    }

    public function getMetodosCalculo()
    {
        return $this->CAL;
    }

    public function getServiciosNacex()
    {
        $serviciosNacex = $this->SERVICIOS;
        // Añadiremos los servicios de que hay en el CSV donde los clientes pueden añadir los suyos
        $this->addNewServices($serviciosNacex, 'Std');

        return $serviciosNacex;
    }

    private function addNewServices(&$serviciosNacex, $tipo)
    {
        /** probar que el fichero no exista */
        $file = self::_path_new_services . self::_new_services_filename;
        if (file_exists($file)) {
            $handle = fopen($file, "r");
            while (!feof($handle) && $handle != false) {
                // codigo;nombre;tipo
                $line = explode(';', fgets($handle));

                // El trim es para eliminar el \n que hay al final
                if (isset($line[2]) && trim($line[2]) == $tipo) {
                    $serviciosNacex[$line[0]] = array(
                        "nombre" => $line[1],
                        "class" => 'csvNewEntry'
                    );
                }
            }
            fclose($handle);
        }
    }

    public function getNewServices($tipo)
    {
        /** probar que el fichero no exista */
        $file = self::_path_new_services . self::_new_services_filename;
        if (file_exists($file)) {
            $handle = fopen($file, "r");
            $list = array();
            while (!feof($handle)) {
                // codigo;nombre;tipo
                $line = explode(';', fgets($handle));

                // El trim es para eliminar el \n que hay al final
                if (isset($line[2]) && trim($line[2]) == $tipo) {
                    $list[$line[0]] = $line[1];

                    // Comprobamos que el servicio del CSV existe en BBDD
                    $this->checkNewServiceDB($line);
                }
            }
            fclose($handle);
            return $list;
        } else return false;
    }

    public function getServiciosNacexInt()
    {
        return $this->SERVICIOS_INT;
    }

    public function getServiciosNacexShop()
    {
        $serviciosNacex = $this->SERVICIOS_NACEX_SHOP;
        // Añadiremos los servicios de que hay en el CSV donde los clientes pueden añadir los suyos
        $this->addNewServices($serviciosNacex, 'Shp');

        return $serviciosNacex;
    }

    /** Comprobar que el nuevo servicio existe en BBDD **/
    private function checkNewServiceDB($service)
    {
        // Comprobamos que el servicio no sea el 44, que no se tiene que crear como transportista
        if ($service[0] != 44) {
            $carrier = nacexDAO::getCarrierByServ($service[0]);

            if (empty($carrier[0])) {
                $newService = new LBnewService();
                $servicio = substr_replace(implode(';', $service), "", -1);

                // Instalamos el nuevo servicio que está en CSV
                $newService->installNewService($servicio);
            }
        }
    }

    public function getAllServiciosNacex()
    {
        //Se hace de esta manera ya que array_merge() no devuelve lo esperado
        $aux = array();

        foreach ($this->SERVICIOS as $key => $servicio) {
            $aux[$key] = $servicio;
        }
        foreach ($this->SERVICIOS_NACEX_SHOP as $key => $servicio) {
            $aux[$key] = $servicio;
        }
        foreach ($this->SERVICIOS_INT as $key => $servicio) {
            $aux[$key] = $servicio;
        }
        return $aux;
    }

    public static function getModuleNacexName() {

        return nacexutils::_moduleName;
    }
    
    /* BASE URI PS 1.7 Options
            __PS_BASE_URI__;
            Tools::getHttpHost(true).__PS_BASE_URI__;
            $this->context->link->getPageLink('index',true);
            Context::getContext()->shop->getBaseURL(true);
    */
    public static function getPath() {
          return Context::getContext()->shop->getBaseURL(true)."modules/". nacexutils::_moduleName."/";
    }

    public function getServSeparador() {
        return $this->SERV_SEP;
    }

    /* public function getDestinos(){
      return $this->DESTINOS;
      } */


    public static function getURL_PRO_Applets() {

        $protocol = self::$_http;

        if (isset($_SERVER['HTTPS'])) {
            $protocol = self::$_https;
        } else {
            $protocol = self::$_http;
        }

        return $protocol . self::$URL_PRO_Applets;
    }

    public static function getHostURLImpresion() {
        $printHost= Configuration::get('NACEX_PRINT_IONA')=="" ?
	//	substr(Configuration::get('NACEX_PRINT_URL'), 0, strpos(Configuration::get('NACEX_PRINT_URL'), "/applets")):
	Configuration::get('NACEX_PRINT_URL'):
	Configuration::get('NACEX_PRINT_IONA');
    }

    public function getModelosEtiquetadoras() {
        return $this->MET;
    }

    /** Feedbacck Datos */
    public function dropDownFormOptions() {
        $datos = [
            "co" => 'Consulta operativa',
            "cc" => 'Consulta comercial',
            "ca" => 'Consulta agencia',
            "ien" => 'Incidencia envío',
            "iex" => 'Incidencia expedición',
            "imm2" => 'Incidencia módulo Prestashop 1.7',
            "dim" => 'Dudas instalación módulo',
            "dcm" => 'Dudas configuración módulo',
            "dg" => 'Dudas generales'
        ];

        return $datos;
    }
}

?>