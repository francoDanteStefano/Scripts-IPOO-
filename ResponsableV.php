<?php

class ResponsableV{
    /**
     * Variables instancia de la clase ResponsableV
     * int $numeroLicencia
     * int $numeroEmpleado
     * string $nombre
     * string $apellido
     * string $mensajeError
     */
    private $numeroEmpleado; 
    private $numeroLicencia;
    private $nombre;
    private $apellido;
    private $mensajeError;
 
    
    /*****************************************************************/
    /*************************** GETTER ******************************/
    /*****************************************************************/
    
    
    /**
     * Obtiene el valor de nombre
     */ 
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * Obtiene el valor de apellido
     */ 
    public function getApellido(){
        return $this->apellido;
    }

    /**
     * Obtiene el valor de numeroLicencia
     */ 
    public function getNumeroLicencia(){
        return $this->numeroLicencia;
    }

    /**
     * Obtiene el valor de numeroEmpleado
     */ 
    public function getNumeroEmpleado(){
        return $this->numeroEmpleado;
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
     * Establece el valor de nombre
     */ 
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    /**
     * Establece el valor de apellido
     */ 
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    /**
     * Establece el valor de numeroEmpleado
     */ 
    public function setNumeroEmpleado($numeroEmpleado){
        $this->numeroEmpleado = $numeroEmpleado;
    }

    /**
     * Establece el valor de numeroLicencia
     */ 
    public function setNumeroLicencia($numeroLicencia){
        $this->numeroLicencia = $numeroLicencia;
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
     * Módulo constructor de la clase ResponsableV
     */
    public function __construct(){   
        $this->nombre = "";
        $this->apellido = "";
        $this->numeroLicencia = "";
        $this->numeroEmpleado = "";
    }

    /**
     * Módulo que setea los valores dados por parámetros en las variables instancia de la clase
     * @param string $nombre
     * @param string $apellido
     * @param int $numeroLicencia
     * @param int $numeroEmpleado
    */
    public function cargar($nombre, $apellido, $numeroLicencia, $numeroEmpleado){
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setNumeroLicencia($numeroLicencia);
        $this->setNumeroEmpleado($numeroEmpleado);
    }

    /**
	 * Módulo que inserta un responsable de viaje a la base de datos
	 * @return bool
	 */
    public function insertar(){
		$bd = new BaseDatos();
		$resp = false;
		$insertarResponsable = "INSERT INTO responsable(rnumerolicencia, rnombre, rapellido) 
				                VALUES (".$this->getNumeroLicencia().",
                                        '".$this->getNombre()."',
                                        '".$this->getApellido()."')";
		if($bd->iniciar()){
			if($bd->ejecutar($insertarResponsable)){
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
	 * Módulo que modifica los datos del responsable de viaje en la base de datos
	 * @return bool
	 */
	public function modificar(){
	    $resp = false; 
	    $bd = new BaseDatos();
		$modificarResponsable = "UPDATE responsable 
                                 SET rapellido = '".$this->getApellido()."',
                                     rnombre = '".$this->getNombre()."',
                                     rnumerolicencia = ".$this->getNumeroLicencia()."
                                 WHERE rnumeroempleado = ". $this->getNumeroEmpleado()."";
		if($bd->iniciar()){
			if($bd->ejecutar($modificarResponsable)){
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
	 * Módulo que elimina el responsable de viaje de la base de datos
	 * @return bool
	 */
	public function eliminar(){
		$bd = new BaseDatos();
		$resp = false;
		if($bd->iniciar()){
			$borrarResponsable = "DELETE FROM responsable 
                                  WHERE rnumeroempleado = ".$this->getNumeroEmpleado();
			if($bd->ejecutar($borrarResponsable)){
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
	 * Módulo que busca el responsable de viaje en la base de datos
	 * @return bool
	 */
    public function buscar($numeroEmpleado){
		$bd = new BaseDatos();
		$buscarResponsable = "SELECT * FROM responsable 
                              WHERE rnumeroempleado = ".$numeroEmpleado;
		$resp = false;
		if($bd->iniciar()){
			if($bd->ejecutar($buscarResponsable)){
				if($respon = $bd->registro()){					
				    $this->setNumeroEmpleado($numeroEmpleado);
					$this->setNombre($respon['rnombre']);
					$this->setApellido($respon['rapellido']);
					$this->setNumeroLicencia($respon['rnumerolicencia']);
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
	 * Módulo que recibe una condición por parámetro, busca los responsable de viaje en la base de datos y los retorna en un array
	 * @param string
	 * @return array
	 */
	public function listar($condicion){
	    $colResponsable = null;
		$bd = new BaseDatos();
		$listarResponsable = "SELECT * FROM responsable ";
		if ($condicion != ""){
		    $listarResponsable = $listarResponsable." WHERE ".$condicion;
		}
		if($bd->iniciar()){
			if($bd->ejecutar($listarResponsable)){				
				$colResponsable = [];
				while($respon = $bd->registro()){
					$objResponsable = new ResponsableV();
					$objResponsable->buscar($respon['rnumeroempleado']);
					array_push($colResponsable,$objResponsable);
				}
		 	}else{
		 		$colResponsable = $bd->getERROR();	
			}
		 }else{
		 	$colResponsable = $bd->getERROR();
		 }	
		 return $colResponsable;
	}
    
    /** Módulo que muestra por pantalla una instancia de ResponsableV en forma de cadena de caracteres
     * @return string
     */
    public function __toString(){
        return "|\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\|\n".
               "| Nombre             | ".$this->getNombre()." |\n".
               "| Apellido           | ".$this->getApellido()." |\n".
               "| Número de licencia | ".$this->getNumeroLicencia()." |\n".
               "| Número de empleado | ".$this->getNumeroEmpleado()." |\n".
               "|\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\|\n";
    }
}
?>