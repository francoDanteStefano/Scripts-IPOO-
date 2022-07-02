<?php

class Pasajero{
    /**
     * Variables instancia de la clase Pasajero
     * string $nombre
     * string $apellido
     * int $documento
     * int $telefono
     * array $colViajes
     */
    private $documento;
    private $nombre;
    private $apellido;
    private $telefono;
    private $objViaje;
	private $mensajeError;
    
    /*****************************************************************/
    /*************************** GETTER ******************************/
    /*****************************************************************/ 

    /**
     * Obtiene string $nombre
     */ 
    public function getDocumento(){
        return $this->documento;
    }

    /**
     * Obtiene el valor de nombre
     */ 
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * Obtiene el valor de Apellido
     */ 
    public function getApellido(){
        return $this->apellido;
    }

    /**
     * Obtiene el valor de telefono
     */ 
    public function getTelefono(){
        return $this->telefono;
    }

    /**
     * Obtiene el valor de colViajes
     */ 
    public function getObjViaje(){
        return $this->objViaje;
    }
    
	/**
	 * Obtiene el valor de mensajeError
	 */ 
	public function getMensajeError(){
		return $this->mensajeError;
	}

    /*****************************************************************/
    /*************************** SETTER ******************************/
    /*****************************************************************/ 
    
    /**
     * Establece string $nombre
     */ 
    public function setDocumento($documento){
        $this->documento = $documento;
    }

    /**
     * Establece el valor de nombre
     */ 
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    /**
     * Establece el valor de telefono
     */ 
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    /**
     * Establece el valor de apellido
     */ 
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    /**
     * Establece el valor de colViajes
     */ 
    public function setObjViaje($objViaje){
        $this->objViaje = $objViaje;
    }

	/**
	 * Establece el valor de mensajeError
	 */ 
	public function setMensajeError($mensajeError){
		$this->mensajeError = $mensajeError;
	}

    /*****************************************************************/
    /*************************** FUNCIONES ***************************/
    /*****************************************************************/
    
    /**
     * Módulo constructor de la clase Pasajero
     */
	public function __construct(){
		
		$this->documento = "";
		$this->nombre = "";
		$this->apellido = "";
		$this->telefono = "";
		$this->objViaje = "";
	}
	/**
	 * Módulo que setea los valores dados por parametros en las variables instancia de la clase
	 * @param string $nombre
 	 * @param string $apellido
	 * @param int $documento
	 * @param int $telefono
	 * @param object $objViaje
	 */
	public function cargar($documento, $nombre, $apellido, $telefono, $objViaje){		
		$this->setDocumento($documento);
		$this->setNombre($nombre);
		$this->setApellido($apellido);
		$this->setTelefono($telefono);
		$this->setObjViaje($objViaje);
    }

	/**
	 * Módulo que inserta un pasajero a la base de datos
	 * @return bool
	 */
    public function insertar(){
		$bd = new BaseDatos();
		$resp = false;
		$insertarPasajero = "INSERT INTO pasajero(pdocumento, papellido, pnombre,  ptelefono, idviaje) 
				     		 VALUES ('".$this->getDocumento()."','".$this->getApellido()."','".$this->getNombre()."','".$this->getObjViaje()->getIdViaje()."')";
		if($bd->iniciar()){
			if($bd->ejecutar($insertarPasajero)){
			    $resp = true;
			}else{
				$this->setMensajeError($bd->getERROR());	
			}
		}else{
			$this->setMensajeError($bd->getERROR());	
		}
		return $resp;
	}

	/**
	 * Módulo que modifica los datos de un pasajero en la base de datos
	 * @return bool
	 */
	public function modificar(){
	    $resp = false; 
	    $bd = new BaseDatos();
		$modificarPasajero = "UPDATE pasajero 
							  SET pdocumento = '".$this->getDocumento."', 
							      papellido = '".$this->getApellido()."', 
								  pnombre = '".$this->getNombre()."', 
								  ptelefono = '".$this->getTelefono()."', 
								  idviaje = '".$this->getObjViaje()->getIdViaje()."'
							  WHERE pdocumento = '".$this->getDocumento()."'";
		if($bd->iniciar()){
			if($bd->ejecutar($modificarPasajero)){
			    $resp = true;
			}else{
				$this->setMensajeError($bd->getERROR());
			}
		}else{
			$this->setMensajeError($bd->getERROR());
		}
		return $resp; 
	}

	/**
	 * Módulo que elimina un pasajero de la base de datos
	 * @return bool
	 */
	public function eliminar(){
		$bd = new BaseDatos();
		$resp = false;
		if($bd->iniciar()){
			$borrarPasajero = "DELETE FROM pasajero WHERE pdocumento = ".$this->getDocumento();
			if($bd->ejecutar($borrarPasajero)){
				$resp = true;
			}else{
				$this->setMensajeError($bd->getERROR());
			}
		}else{
			$this->setMensajeError($bd->getERROR());
		}
		return $resp; 
	}
	/**
	 * Módulo que busca un pasajero en la base de datos
	 * @return bool
	 */
    public function buscar($documento){
		$bd = new BaseDatos();
		$buscarPasajero = "SELECT * FROM pasajero WHERE pdocumento = ".$documento;
		$resp = false;
		if($bd->iniciar()){
			if($bd->ejecutar($buscarPasajero)){
				if($passenger = $bd->registro()){					
				    $this->setDocumento($documento);
					$this->setNombre($passenger['pnombre']);
					$this->setApellido($passenger['papellido']);
					$this->setTelefono($passenger['ptelefono']);
					$objViaje = new Viaje();
					$objViaje->buscar($passenger['idviaje']);
					$this->setObjViaje($objViaje);
					$resp = true;
				}				
		 	}else{
		 		$this->setMensajeError($bd->getERROR());
			}
		 }else{
			$this->setMensajeError($bd->getERROR());
		 }		
		 return $resp;
	}

    /**
	 * Módulo que recibe una condicion por parametro, busca los pasajeros en la base de datos y los retorna en un array
	 * @param string
	 * @return array
	 */
	public function listar($condicion){
	    $colPasajeros = null;
		$bd = new BaseDatos();
		$listarPasajero = "SELECT * FROM pasajero ";
		if ($condicion != ""){
		    $listarPasajero = $listarPasajero." WHERE ".$condicion;
		}
		if($bd->iniciar()){
			if($bd->ejecutar($listarPasajero)){				
				$colPasajeros = [];
				while($passenger = $bd->registro()){
					$objPasajero = new Pasajero();
					$objPasajero->buscar($passenger['pdocumento']);
					array_push($colPasajeros,$objPasajero);
				}
		 	}else{
		 		$colPasajeros = $bd->getERROR();	
			}
		 }else{
		 	$colPasajeros = $bd->getERROR();
		 }	
		 return $colPasajeros;
	}	

	/** Método que muestra por pantalla una instancia de Pasajero en forma de cadena de caracteres
     * @return string
     */
    public function __toString(){
        return "*************************************************"."\n".
               "Pasajero: "."\n".
               "Nombre: ".$this->getNombre()."\n".
               "Apellido: ".$this->getApellido()."\n".
               "Número de documento: ".$this->getDocumento()."\n".
               "Teléfono: ".$this->getTelefono()."\n".
               "Viaje: ".$this->getObjViaje()."\n".
               "*************************************************"."\n";
    }  
}
?>