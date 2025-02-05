<?php
//SET ENVIRONMENT
include('../../config/config.inc.php');
include('../../init.php');
session_start();

class CPuntoNacexShop
{

    private $codigo;
    private $alias;
    private $nombre;
    private $direccion;
    private $cp;
    private $poblacion;
	private $provincia;
	private $telefono;

	
	public function getCodigo(){
		return $this->codigo;
	}
	public function setCodigo($codigo){
		$this->codigo = $codigo;
	}
	
	public function getAlias(){
		return $this->alias;
	}
	public function setAlias($alias){
		$this->alias = $alias;
	}
	
	public function getNombre(){
		return $this->nombre;
	}
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function getDireccion(){
		return $this->direccion;
	}
	public function setDireccion($direccion){
		$this->direccion = $direccion;
	}
	public function getCp(){
		return $this->cp;
	}
	public function setCp($cp){
		$this->cp = $cp;
	}
	public function getPoblacion(){
		return $this->poblacion;
	}
	public function setPoblacion($poblacion){
		$this->poblacion = $poblacion;
	}
	public function getProvincia(){
		return $this->provincia;
	}

    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setDatosNXSH_Session($txt, $id_cart)
    {
        $datos = explode("|", $txt);

        $cpnx = new CPuntoNacexShop;
        $cpnx->setCodigo($datos[0]);
        $cpnx->setAlias($datos[1]);
        $cpnx->setNombre($datos[2]);
        $cpnx->setDireccion($datos[3]);
        $cpnx->setCp($datos[4]);
        $cpnx->setPoblacion($datos[5]);
        $cpnx->setProvincia($datos[6]);
        $cpnx->setTelefono($datos[7]);

        //$_SESSION['cpnd'] = $cpnx;
        if (isset($_COOKIE['opc_id_cart'])) $idCart = $_COOKIE['opc_id_cart'];
        else $idCart = $id_cart;

        $query = Db::getInstance()->ExecuteS('SELECT ncx FROM ' . _DB_PREFIX_ . 'cart WHERE id_cart = "' . $idCart . '"');

        // Guardamos sólo el ID del punto para poder recuperar los datos más tarde
        if (!is_null($query) || $query != '') Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . 'cart SET ncx="' . $datos[0] . '" WHERE id_cart = "' . $idCart . '"');
    }
	
	public function getDatosNXSH_Session()
    {

        $valor = "";

        //$cpnx = $cookie->__get('cpnd');
        $valor .= $this->getCodigo() . "|";
        $valor .= $this->getAlias() . "|";
        $valor .= $this->getNombre() . "|";
        $valor .= $this->getDireccion() . "|";
        $valor .= $this->getCp() . "|";
        $valor .= $this->getPoblacion() . "|";
        $valor .= $this->getProvincia() . "|";
        $valor .= $this->getTelefono();

        echo $valor;
    }

    public function unsetDatosNXSH_Session()
    {
        //unset($_SESSION['cpnd']);
    }

}

$txt = isset($_POST['txt']) ? $_POST['txt'] : '';
$id_cart = isset($_POST['cart']) ? $_POST['cart'] : '';
$method = isset($_POST['metodo_nacex']) ? $_POST['metodo_nacex'] : '';
$aux = new CPuntoNacexShop();

if ($method == "setSession") {
    $aux->setDatosNXSH_Session($txt, $id_cart);
} else if ($method == "getSession") {
    $aux->getDatosNXSH_Session();
} else if ($method == "unsetSession") {
    $aux->unsetDatosNXSH_Session();
}

