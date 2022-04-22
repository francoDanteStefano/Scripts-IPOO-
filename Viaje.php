<?php

class Viaje 
{
    /**Variables instancia de la clase
     * int $codigo
     * string $destino
     * int $capMax
     * array $arrayObjPasajeros
     */
    private $codigo;
    private $destino;
    private $capMax;
    private $arrayObjPasajeros;


    /*****************************************************************/
    /*************************** GETTER ******************************/
    /*****************************************************************/ 


    /**
     * Obtiene el valor de codigo
     */ 
    public function getCodigo(){
        return $this->codigo;
    }

    /**
     * Obtiene el valor de destino
     */ 
    public function getDestino(){
        return $this->destino;
    }

    /**
     * Obtiene el valor de capMax
     */ 
    public function getCapMax(){
        return $this->capMax;
    }

    /**
     * Obtiene el valor de nombre dentro del array pasajerosViaje
     */ 
    public function getArrayObjPasajeros(){
        return $this->arrayObjPasajeros;
    }
    /**
     * Obtiene el valor del objeto ResponsableV
     */ 
    public function getObjResponsableV(){
        return $this->objResponsableV;
    }


    /*****************************************************************/
    /*************************** SETTER ******************************/
    /*****************************************************************/
    
     
    /**
     * Establecer el valor de codigo
     * @param int $codigo
     * @return self
     */ 
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    /**
     * Establecer el valor de destino
     * @param string $destino
     * @return self
     */ 
    public function setDestino($destino){
        $this->destino = $destino;
    }

    /**
     * Establecer el valor de capMax
     * @param int $capMax
     * @return self
     */ 
    public function setCapMax($capMax){
        $this->capMax = $capMax;
    }

    /**
     * Establece el valor de nombre dentro del array pasajerosViaje
     * @param array $pasajerosViaje
     * @return self
     */ 
    public function setArrayObjPasajeros($arrayObjPasajeros){
        $this->arrayObjPasajeros = $arrayObjPasajeros;
    }

    /**
     * Establece el valor del objeto ResponsableV
     * @param array $pasajerosViaje
     * @return self
     */ 
    public function setObjResponsableV($objResponsableV){
        $this->objResponsableV = $objResponsableV;
    }
    
    
    /*****************************************************************/
    /*************************** FUNCIONES ***************************/
    /*****************************************************************/
    
    
    /**
     * Método constructor de la clase Viaje, tiene por parametro los 
     * valores que se le asignan a las variables de la clase
     * @param int $codigo
     * @param int $capMax
     * @param array $pasajerosViaje
     * @param string $destino
     * @param object $objResponsableV
     */
    public function __construct($codigo, $destino, $capMax, $arrayObjPasajeros, $objResponsableV){   
        $this->codigo = $codigo;
        $this->destino = $destino;
        $this->capMax = $capMax;
        $this->arrayObjPasajeros = $arrayObjPasajeros;
        $this->objResponsableV = $objResponsableV;
    }

    /**
     * Método que recibe por parametro un entero y un dato 
     * y modifica la informacion del viaje.
     * @param int $opcion
     * @param string $dato
     */
    public function modificarViaje($opcion, $dato){
        switch ($opcion){
            case 1:
                $this->setCodigo($dato);
                break;
            case 2:
                $this->setDestino($dato);
                break;
            case 3:
                $this->setCapMax($dato);
                break;
        }
    }

    /**
     * Método que recibe por parametro un entero y un dato 
     * y modifica los datos del objeto ResponsableV.
     * @param int $opcion
     * @param string $dato
     */
    public function modificarRespon($opcion, $dato){
        switch ($opcion){
            case 1:
                $this->objResponsableV->setNombre($dato);
                break;
            case 2:
                $this->objResponsableV->setApellido($dato);
                break;
            case 3:
                $this->objResponsableV->setNroLicencia($dato);
                break;
            case 4:
                $this->objResponsableV->setNroEmpleado($dato);
                break;
        }
    }
    
    /**
     * Esta función solicita los datos datos para crear un objeto Pasajero y lo retorna.
     * @param int $dni
     * @return boolean 
     */
    public function existePasajero ($dni){
        $coleccion = $this->getArrayObjPasajeros();
        $existe = false;
        foreach ($coleccion as $pasajero){
            $docPasajero = $pasajero->getNroDocumento();
            if ($dni == $docPasajero){
                $existe = true;
            }
        }
        return $existe;
    }

    /** Método que convierte la coleccion de los objetos 
     * pasajeros en una cadena de caracteres. 
     * @return string
     */
    public function pasajerosToString(){
        $coleccion = $this->getArrayObjPasajeros();
        $string = "";
        foreach ($coleccion as $pasajero){
            $string .= $pasajero;
        }
        return $string;
    }

    /** Método que muestra por pantalla una instancia de Viaje 
     * @return string
     */
    public function __toString(){
        return "*************************************************"."\n".
               "Código de viaje: ".$this->getCodigo()."\n".
               "Destino: ".$this->getDestino()."\n".
               "Capacidad máxima de pasajeros: ".$this->getCapMax()."\n".
               "Pasajeros: "."\n".$this->pasajerosToString()."\n".
               "*************************************************"."\n";
    } 
}
?>