<?php

class Viaje 
{
    /**Variables instancia de la clase
     * int $codigo
     * string $destino
     * int $cantMax
     * array $pasajerosViaje
     */
    private $codigo;
    private $destino;
    private $cantMax;
    private $pasajerosViaje;
    
    /**
     * Módulo constructor de la clase viaje, tiene por parametro los 
     * valores que se le asignan a las variables de la clase
     * @param int $codigo
     * @param int $cantMax
     * @param array $pasajerosViaje
     * @param string $destino
     */

    public function __construct($codigo, $destino, $cantMax, $pasajerosViaje)
    {   
        $this->codigo = $codigo;
        $this->destino = $destino;
        $this->cantMax = $cantMax;
        $this->pasajerosViaje = $pasajerosViaje;
    }


    /*****************************************************************/
    /*************************** GETTER ******************************/
    /*****************************************************************/ 


    /**
     * Obtiene el valor de codigo
     */ 
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Obtiene el valor de destino
     */ 
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Obtiene el valor de cantMax
     */ 
    public function getCantMax()
    {
        return $this->cantMax;
    }

    /**
     * Obtiene el valor de nombre dentro del array pasajerosViaje
     */ 
    public function getPasajerosViaje()
    {
        return $this->pasajerosViaje;
    }


    /*****************************************************************/
    /*************************** SETTER ******************************/
    /*****************************************************************/
    
     
    /**
     * Establecer el valor de codigo
     * @param int $codigo
     * @return self
     */ 
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Establecer el valor de destino
     * @param string $destino
     * @return self
     */ 
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Establecer el valor de cantMax
     * @param int $cantMax
     * @return self
     */ 
    public function setCantMax($cantMax)
    {
        $this->cantMax = $cantMax;

        return $this;
    }

    /**
     * Establece el valor de nombre dentro del array pasajerosViaje
     * @param array $pasajerosViaje
     * @return self
     */ 
    public function setPasajerosViaje($pasajerosViaje)
    {
        return $this->pasajerosViaje = $pasajerosViaje;
    }

    /**
     * Este modulo modifica los datos de un pasajero
     * @param int $documento
     * @param string $clave
     * @param string $dato
     */
    public function cambiarDatoPasajero($documento,$clave,$dato){
        $arrayPasajero = $this->getPasajerosViaje();
        $i = 0;
        $limite = count($arrayPasajero);
        do{
            $encontro = true;
            if($arrayPasajero[$i]["Nro documento"] == $documento){
                $encontro = false;
            }else{
            $i++;
            }
        }while($encontro && $i < $limite);
        if($encontro){
            echo "No se encontró el documento seleccionado";
        }else{
            $arrayPasajero[$i][$clave] = $dato;
            $this->setPasajerosViaje($arrayPasajero);
        }
    }


    /* Modulo que muestra por pantalla una instancia de Viaje 
     * return string
     */
    public function __toString()
    {
        return "Código de viaje: ".$this->getCodigo()."\n".
               "Destino: ".$this->getDestino()."\n".
               "Cantidad de pasajeros: ".$this->getCantMax()."\n".
               "Los pasajeros del viaje son: ".count($this->getPasajeros())."\n";
    }
}
?>