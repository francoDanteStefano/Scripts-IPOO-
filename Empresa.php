<?php

class Empresa{
    /**Variables instancia de la clase Empresa
     * int $idEmpresa
     * string $eNombre
     * string $eDireccion
     * string $mensajeError
     */
    private $idEmpresa;
    private $eNombre;
    private $eDireccion;
    private $mensajeError;
    
    
    /**************************************/
    /**************** SET *****************/
    /**************************************/
    
    /**
     * Establece el valor de mensajeError
     */ 
    public function setMensajeError($mensajeError){
        $this->mensajeError = $mensajeError;
    }

    /**
     * Establece el valor de eDireccion
     */ 
    public function setEDireccion($eDireccion){
        $this->eDireccion = $eDireccion;
    }

    /**
     * Establece el valor de eNombre
     */ 
    public function setENombre($eNombre){
        $this->eNombre = $eNombre;
    }

    /**
     * Establece el valor de idEmpresa
     */ 
    public function setIdEmpresa($idEmpresa){
        $this->idEmpresa = $idEmpresa;
    }
    
    /**************************************/
    /**************** GET *****************/
    /**************************************/
    
    /**
     * Obtiene el valor de idEmpresa
     */ 
    public function getIdEmpresa(){
        return $this->idEmpresa;
    }

    /**
     * Obtiene el valor de eNombre
     */ 
    public function getENombre(){
        return $this->eNombre;
    }

    /**
     * Obtiene el valor de eDireccion
     */ 
    public function getEDireccion(){
        return $this->eDireccion;
    }

    /**
     * Obtiene el valor de mensajeError
     */ 
    public function getMensajeError(){
        return $this->mensajeError;
    }
    
    /**************************************/
    /************** FUNCIONES *************/
    /**************************************/
    
    /**
     * Módulo constructor de la clase Empresa
     */
    public function __construct(){
        $this->idEmpresa = "";
        $this->eNombre = "";
        $this->eDireccion = "";
    }

    /**
     * Módulo que setea los valores dados por parametros en las variables instancia de la clase
     * @param int $idEmpresa
     * @param string $eNombre
     * @param string $eDireccion
     */
    public function cargar($idEmpresa, $eNombre, $eDireccion){
        $this->setIdEmpresa($idEmpresa);
        $this->setENombre($eNombre);
        $this->setEDireccion($eDireccion);
    }

    /**
	 * Módulo que inserta una empresa a la base de datos
	 * @return bool
	 */
    public function insertar(){
		$bd = new BaseDatos();
		$resp = false;
		$insertarEmpresa = "INSERT INTO empresa(enombre, edireccion) 
				            VALUES ('".$this->getENombre()."','".$this->getEDireccion()."')";
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
	 * Módulo que modifica los datos de una empresa en la base de datos
	 * @return bool
	 */
	public function modificar(){
	    $resp = false; 
	    $bd = new BaseDatos();
		$modificarEmpresa = "UPDATE empresa SET enombre = '".$this->getENombre()."', edireccion = '".$this->getEDireccion()."' WHERE idempresa = '".$this->getIdEmpresa()."'";
		if($bd->iniciar()){
			if($bd->ejecutar($modificarEmpresa)){
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
	 * Módulo que elimina una empresa de la base de datos
	 * @return bool
	 */
	public function eliminar(){
		$bd = new BaseDatos();
		$resp = false;
		if($bd->iniciar()){
			$borrarEmpresa = "DELETE FROM empresa WHERE idempresa = ".$this->getIdEmpresa();
			if($bd->ejecutar($borrarEmpresa)){
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
    public function buscar($idEmpresa){
		$bd = new BaseDatos();
		$buscarEmpresa = "SELECT * FROM empresa WHERE idempresa = ".$idEmpresa;
		$resp = false;
		if($bd->iniciar()){
			if($bd->ejecutar($buscarEmpresa)){
				if($pymes = $bd->registro()){					
				    $this->setIdEmpresa($idEmpresa);
					$this->setENombre($pymes['enombre']);
					$this->setEDireccion($pymes['edireccion']);
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
	 * Módulo que recibe una condicion por parametro, busca las empresas en la base de datos y los retorna en un array
	 * @param string
 	 * @return array
	 */
	public function listar($condicion){
	    $colEmpresas = null;
		$bd = new BaseDatos();
		$listarEmpresa = "SELECT * FROM empresa ";
		if ($condicion != ""){
		    $listarEmpresa .=' WHERE '.$condicion;
		}
		if($bd->iniciar()){
			if($bd->ejecutar($listarEmpresa)){				
				$colEmpresas = [];
				while($pymes = $bd->registro()){
					$objEmpresa = new Empresa();
					$objEmpresa->buscar($pymes['idempresa']);
					array_push($colEmpresas,$objEmpresa);
				}
		 	}else{
		 		$colEmpresas = false;
				$this->setMensajeError($bd->getERROR());	
			}
		 }else{
			$colEmpresas = false;
			$this->setMensajeError($bd->getERROR());
		 }	
		 return $colEmpresas;
	}

    /** Método que muestra por pantalla una instancia de Empresa en forma de cadena de caracteres
     * @return string
     */
    public function __toString(){
        return "| Empresa N°: | ".$this->getIdEmpresa()." |\n".
               "| Nombre:     | ".$this->getENombre()." |\n".
               "| Dirección:  | ".$this->getEDireccion()." |\n";
    }
}
?>