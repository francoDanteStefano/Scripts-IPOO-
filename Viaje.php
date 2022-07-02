<?php

class Viaje {
    /**Variables instancia de la clase Viaje
     * int $idViaje
     * string $destino
     * int $cantMaxPasajeros
     * array $colPasajeros
     * object $objEmpresa
     * object $objResponsableV
     * int $importe
     * int $tipoAsiento
     * int $idaYVuelta
     * string $mensajeError
     */
    private $idViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $colPasajeros;
    private $objEmpresa;
    private $objResponsableV;
    private $importe;
    private $tipoAsiento;
    private $idaYVuelta;
    private $mensajeError;

    
    /*****************************************************************/
    /*************************** GETTER ******************************/
    /*****************************************************************/ 

    /**
     * Obtiene int $codigo
     */ 
    public function getIdViaje(){
        return $this->idViaje;
    }

    /**
     * Obtiene el valor de destino
     */ 
    public function getDestino(){
        return $this->destino;
    }

    /**
     * Obtiene el valor de cantMaxPasajeros
     */ 
    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }

    /**
     * Obtiene el valor de objEmpresa
     */ 
    public function getObjEmpresa(){
        return $this->objEmpresa;
    }

    /**
     * Obtiene el valor de objResponsableV
     */ 
    public function getObjResponsableV(){
        return $this->objResponsableV;
    }

    /**
     * Obtiene el valor de importe
     */ 
    public function getImporte(){
        return $this->importe;
    }

    /**
     * Obtiene el valor de tipoAsiento
     */ 
    public function getTipoAsiento(){
        return $this->tipoAsiento;
    }

    /**
     * Obtiene el valor de idaYVuelta
     */ 
    public function getIdaYVuelta(){
        return $this->idaYVuelta;
    }

    /**
     * Obtiene el valor de mensajeError
     */ 
    public function getMensajeError(){
        return $this->mensajeError;
    }

    /**
     * Obtiene el valor de colPasajeros
     */ 
    public function getColPasajeros(){
        return $this->colPasajeros;
    }

    /*****************************************************************/
    /*************************** SETTER ******************************/
    /*****************************************************************/
     
    /**
     * Establece int $codigo
     */ 
    public function setIdViaje($idViaje){
        $this->idViaje = $idViaje;
    }

    /**
     * Establece el valor de destino
     */ 
    public function setDestino($destino){
        $this->destino = $destino;
    }

    /**
     * Establece el valor de cantMaxPasajeros
     */ 
    public function setCantMaxPasajeros($cantMaxPasajeros){
        $this->cantMaxPasajeros = $cantMaxPasajeros;
    }

    /**
     * Establece el valor de objEmpresa
     */ 
    public function setObjEmpresa($objEmpresa){
        $this->objEmpresa = $objEmpresa;
    }

    /**
     * Establece el valor de objResponsableV
     */ 
    public function setObjResponsableV($objResponsableV){
        $this->objResponsableV = $objResponsableV;
    }

    /**
     * Establece el valor de importe
     */ 
    public function setImporte($importe){
        $this->importe = $importe;
    }

    /**
     * Establece el valor de tipoAsiento
     */ 
    public function setTipoAsiento($tipoAsiento){
        $this->tipoAsiento = $tipoAsiento;
    }

    /**
     * Establece el valor de idaYVuelta
     */ 
    public function setIdaYVuelta($idaYVuelta){
        $this->idaYVuelta = $idaYVuelta;
    }

    /**
     * Establece el valor de mensajeError
     */ 
    public function setMensajeError($mensajeError){
        $this->mensajeError = $mensajeError;
    }
    
    /**
     * Establece el valor de colPasajeros
     */ 
    public function setColPasajeros($colPasajeros){
        $this->colPasajeros = $colPasajeros;
    }

    /*****************************************************************/
    /*************************** FUNCIONES ***************************/
    /*****************************************************************/
    
    /**
     * Módulo constructor de la clase Viaje
     */   
    public function __construct(){
        $this->idViaje = "";
        $this->destino = "";
        $this->cantMaxPasajeros = "";
        $this->colPasajeros = [];
        $this->objEmpresa = "";
        $this->objResponsableV = "";
        $this->importe = "";
        $this->tipoAsiento = "";
        $this->idaYVuelta = "";
    }

    /**
     * Módulo que setea los valores dados por parametros en las variables instancia de la clase
     * @param int $idViaje
     * @param string $destino
     * @param int $cantMaxPasajeros
     * @param object $objEmpresa
     * @param object $objResponsableV
     * @param int $importe
     * @param int $tipoAsiento
     * @param int $idaYVuelta
     */
    public function cargar($idViaje, $destino, $cantMaxPasajeros, $objEmpresa, $objResponsableV, $importe, $tipoAsiento, $idaYVuelta){
        $this->setIdViaje($idViaje);
        $this->setDestino($destino);
        $this->setCantMaxPasajeros($cantMaxPasajeros);
        $this->setObjEmpresa($objEmpresa);
        $this->setObjResponsableV($objResponsableV);
        $this->setImporte($importe);
        $this->setTipoAsiento($tipoAsiento);
        $this->setIdaYVuelta($idaYVuelta);
    }

    /**
	 * Módulo que inserta un viaje a la base de datos
	 * @return bool
	 */
    public function insertar(){
		$bd = new BaseDatos();
		$resp = false;
		$insertarEmpresa = "INSERT INTO viaje(vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte, tipoAsiento, idayvuelta) 
				            VALUES ('".$this->getDestino()."','".$this->getCantMaxPasajeros()."','".$this->getObjEmpresa()->getIdEmpresa()."',
                                    '".$this->getObjResponsableV()->getNumeroEmpleado()."','".$this->getImporte()."','".$this->getTipoAsiento()."',
                                    '".$this->getIdaYVuelta()."')";
		if($bd->iniciar()){
			if($bd->ejecutar($insertarEmpresa)){
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
	 * Módulo que modifica los datos del viaje en la base de datos
	 * @return bool
	 */
	public function modificar(){
	    $resp = false; 
	    $bd = new BaseDatos();
		$modificarViaje = "UPDATE viaje 
                           SET vdestino = '".$this->getDestino()."',
                           vcantmaxpasajeros = '".$this->getCantMaxPasajeros()."', 
                           idempresa = '".$this->getObjEmpresa()->getIdEmpresa()."',
                           rnumeroempleado = '".$this->getObjResponsableV()->getNumeroEmpleado()."', 
                           vimporte = '".$this->getImporte()."', tipoAsiento = '".$this->getTipoAsiento()."', 
                           idayvuelta = '".$this->getIdaYVuelta()."'";
		if($bd->iniciar()){
			if($bd->ejecutar($modificarViaje)){
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
	 * Módulo que elimina un viaje de la base de datos
	 * @return bool
	 */
	public function eliminar(){
		$bd = new BaseDatos();
		$resp = false;
		if($bd->iniciar()){
			$borrarViaje = "DELETE FROM Viaje WHERE idviaje = ".$this->getIdViaje();
			if($bd->ejecutar($borrarViaje)){
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
	 * Módulo que busca una empresa en la base de datos
	 * @return bool
	 */
    public function buscar($idViaje){
		$bd = new BaseDatos();
		$buscarViaje = "SELECT * FROM viaje WHERE idviaje = ".$idViaje;
		$resp = false;
		if($bd->iniciar()){
			if($bd->ejecutar($buscarViaje)){
				if($travel = $bd->registro()){	
                    $objResponsableV = new ResponsableV();
                    $objEmpresa = new Empresa();	
				    $objResponsableV->buscar($travel['rnumeroempleado']);
                    $objEmpresa->buscar($travel['idempresa']);
                    $this->setIdViaje($idViaje);
                    $this->setDestino($travel['vdestino']);
                    $this->setCantMaxPasajeros($travel['vcantmaxpasajeros']);
                    $this->setObjResponsableV($objResponsableV);
                    $this->setObjEmpresa($objEmpresa);
                    $this->setImporte($travel['vimporte']);
                    $this->setTipoAsiento($travel['tipoAsiento']);
                    $this->setIdaYVuelta($travel['idayvuelta']);
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
	 * Módulo que recibe una condicion por parametro, busca los viajes en la base de datos y los retorna en un array
	 * @param string
	 * @return array
	 */
	public function listar($condicion){
	    $colViaje = null;
		$bd = new BaseDatos();
		$listarViaje = "SELECT * FROM viaje ";
		if ($condicion != ""){
		    $listarViaje = $listarViaje." WHERE ".$condicion;
		}
		if($bd->iniciar()){
			if($bd->ejecutar($listarViaje)){				
				$colViaje = [];
				while($travel = $bd->registro()){
					$objViaje = new Viaje();
					$objViaje->buscar($travel['idviaje']);
					array_push($colViaje,$objViaje);
				}
		 	}else{
		 		$colViaje = $bd->getERROR();	
			}
		 }else{
		 	$colViaje = $bd->getERROR();
		 }	
		 return $colViaje;
	}

    /**
	 * Módulo que crea un array con los pasajeros del viaje, los setea y retorna true si se pudo
     * realizar o false caso contrario
	 * @return bool
	 */
    public function arrayObjPasajeros(){
        $bd = new BaseDatos();
        $resp = false;
        $condicion = "idviaje = ".$this->getIdViaje();
        if($bd->iniciar()){
            $objPasajero = new Pasajero();
            $coleccion = $objPasajero->listar($condicion);
            if(is_array($coleccion)){
                $this->setColPasajeros($coleccion);
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
	 * Módulo que verifica la disponibilidad de asientos en el viaje, retorna true si hay 
     * asientos disponibles o fasle caso contrario
	 * @return boolean
	 */
    public function asientosLibres(){
        $this->arrayObjPasajeros();
        $coleccion = $this->getColPasajeros();
        $vacancy = false;
        if (count($coleccion) > $this->getCantMaxPasajeros()){
            $vacancy = true;
        }
        return $vacancy;
    }

    /** Método que muestra por pantalla una instancia de Viaje en forma de cadena de caracteres
     * @return string
     */
    function __toString()
    {
        return "*************************************************\n".
               "Código de viaje: ".$this->getIdViaje()."\n".
               "Destino: ".$this->getDestino()."\n".
               "Capacidad máxima de pasajeros: ".$this->getCantMaxPasajeros()."\n".
               "Pasajeros: "."\n".$this->pasajerosToString()."\n".
               "Empresa: "."\n".$this->getObjEmpresa()."\n".
               "Responsable de viaje: "."\n".$this->getObjResponsableV()."\n".
               "Importe de asiento: "."\n".$this->getImporte()."\n".
               "Tipo de asiento: "."\n".$this->getTipoAsiento()."\n".
               "Ida y vuelta: "."\n".$this->getIdaYVuelta()."\n".
               "*************************************************\n";
    } 

    /** Método que convierte la colección de los objetos pasajeros en una cadena de caracteres. 
     * @return string
     */
    public function pasajerosToString(){
        $coleccion = $this->getColPasajeros();
        $string = "";
        foreach ($coleccion as $objPasajero){
            $string .= $objPasajero;
        }
        return $string;
    }  
}
?>