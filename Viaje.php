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
    private $objResponsableV;


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
     * Esta función modifica los datos de un pasajero
     * @param object $objetoViaje
     */
    function modificarPasajero($dni, $opcion, $dato)
    {
        $arrayPas = $this->getArrayObjPasajeros();
        $i = $this->buscarPasajero($dni);
        if ($i <> null){
            switch($opcion){
                case 1: 
                    $arrayPas[$i]->setNombre($dato);
                    break;

                case 2: 
                    $arrayPas[$i]->setApellido($dato);
                    break;

                case 3: 
                    $arrayPas[$i]->setTelefono($dato);
                    break;
            }
            $modificado = true;
        }else{
            $modificado = false;
        }
        return $modificado;
    }

    /**
     * Devuelve la posición del pasajero dentro de la colección que tiene el viaje,
     * o null en caso que no exista.
     * @param int $documento
     * @return int
     */
    public function buscarPasajero($dni){
        $arrayPas = $this->getArrayObjPasajeros();
        $i = 0;
        $cant = count($arrayPas);
        do{
            $noEncuentra = true;
            if ($arrayPas[$i]->getNroDocumento() == $dni){
                $noEncuentra = false;
            }else{
                $i ++;
            }
        }while ($noEncuentra && $i<=$cant);
        if($noEncuentra){
            $i = null;
        }
        return $i;
    }

    /**
     * Método que agrega un pasajero a la coleccion de pasajeros, siempre 
     * y cuando no este previamente cargado. Luego retorna true si fue cargado,
     * false caso contrario.
     * @param string $limite
     * @param string $arrayPasajeros
     * @param int $objetoViaje
     * @param int $telefono
     * @return boolean
     */
    public function agregarPasajero($nombre, $apellido, $dni, $telefono){
        $coleccionPas = $this->getArrayObjPasajeros();
        $verficacion = $this->buscarPasajero($dni);
        if ($verficacion == null){
            $nuevoPasajero = new Pasajero($nombre,$apellido,$dni,$telefono);
            $this->setArrayObjPasajeros(array_push($coleccionPas,$nuevoPasajero));
            $agregado = true;
        }else{
            $agregado = false;
        }
        return $agregado;
    }

    /**
     * Función que elimina un pasajero de la coleccion de pasajeros y
     * retorna true si fue eliminado, false caso contrario.
     * @param int $dni
     * @return boolean
     */
    public function eliminarPasajero($dni){
        $posicion = $this->buscarPasajero($dni);
        $arrayPas = $this->getArrayObjPasajeros();
        if ($posicion <> null){
            unset($arrayPas[$posicion]);
            sort($arrayPas);
            $this->setArrayObjPasajeros ($arrayPas);
            $eliminado = true;
        }else{
            $eliminado = false;
        }
        return $eliminado;
    }

    /**
     * Función que recorre la coleccion de pasajeros y retorna el objeto Pasajero que se desea mostrar.
     * @param int $dni
     * @return object
     */
    public function mostrarPasajero($dni){
        $posicion = $this->buscarPasajero($dni);
        if ($posicion <> null){
            $objPasajero = $this->getArrayObjPasajeros()[$posicion];
        }else{
            $objPasajero = null;
        }
        return $objPasajero;
    }

    /** Método que convierte la coleccion de los objetos 
     * pasajeros en una cadena de caracteres. 
     * @return string
     */
    public function pasajerosToString(){
        $coleccion = $this->getArrayObjPasajeros();
        $string = "";
        foreach ($coleccion as $objPasajero){
            $string .= $objPasajero;
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