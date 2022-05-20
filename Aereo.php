<?php

class Aereo extends Viaje 
{
    private $numVuelo;
    private $nombreAero;
    private $escalas;

    /**************************************/
    /**************** SET *****************/
    /**************************************/

    /**
         * Establece el valor de numVuelo
         */ 
        public function setNumVuelo($numVuelo){
            $this->numVuelo = $numVuelo;
        }

        /**
         * Establece el valor de nombreAero
         */ 
        public function setNombreAero($nombreAero){
            $this->nombreAero = $nombreAero;
        }

        /**
         * Establece el valor de escalas
         */ 
        public function setEscalas($escalas){
            $this->escalas = $escalas;
        }

    /**************************************/
    /**************** GET *****************/
    /**************************************/

    /**
         * Obtiene el valor de numVuelo
         */ 
        public function getNumVuelo(){
            return $this->numVuelo;
        }

        /**
         * Obtiene el valor de nombreAero
         */ 
        public function getNombreAero(){
            return $this->nombreAero;
        }

        /**
         * Obtiene el valor de escalas
         */ 
        public function getEscalas(){
            return $this->escalas;
        }
    
    /**************************************/
    /************** FUNCIONES *************/
    /**************************************/

    public function __construct($codigo, $destino, $capMax, $importeAsiento, $tipoAsiento, 
    $arrayObjPasajeros, $objResponsableV, $numVuelo, $nombreAero, $escalas){
        
        $this->numVuelo = $numVuelo;
        $this->nombreAero = $nombreAero;
        $this->escalas = $escalas;
        parent::__construct($codigo,$destino,$capMax, $importeAsiento, $tipoAsiento, $arrayObjPasajeros, $objResponsableV);
    }

    /**
     * Función que vende un pasaje, de ser posible, y retorna el importe del mismo
     * @param object
     * @return int
     */
    public function venderPasaje($objPasajero){
        $importe = parent::venderPasaje($objPasajero);
        if($importe != null){
            $tipoAsiento = $this->getTipoAsiento();
            if (($tipoAsiento == 1) && ($this->getEscalas() > 0) ){
                $importe = $importe * 1.6;      // Primera clase con escalas (incremento del 60% sobre el importe de viaje)
            }else if (($tipoAsiento == 1) && ($this->getEscalas() == 0)){
                $importe = $importe * 1.4;      // Primera clase sin escalas (incremento del 40% sobre el importe de viaje)
            }else if (($tipoAsiento != 1) && ($this->getEscalas() > 0)){
                $importe = $importe * 1.2;      // Clase regular con escalas (incremento del 20% sobre el importe de viaje) 
            }
        }
        return $importe;
    }
    public function __toString(){
        $string = parent::__toString();
        $string .= "\n Numero de vuelo: ".$this->getNumVuelo().
                "\n Nombre de la aerolinea: ".$this->getNombreAero().
                "\n Cantidad de escalas: ".$this->getEscalas();
        return $string;
    }
}
?>