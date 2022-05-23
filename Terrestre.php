<?php

class Terrestre extends Viaje 
{
    
    /**************************************/
    /************** FUNCIONES *************/
    /**************************************/
    
    public function __construct($codigo, $destino, $capMax, $importeAsiento, $tipoAsiento, $arrayObjPasajeros, $objResponsableV){
        parent::__construct($codigo, $destino, $capMax, $importeAsiento, $tipoAsiento, $arrayObjPasajeros, $objResponsableV);
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
            $importeTot = ($tipoAsiento == 1) ? ($importe * 1.25) : $importe; // 1 Representa el asiento de tipo Cama
        }
        return $importeTot;
    }

    public function __toString(){
        $string = parent::__toString();
        return $string;
    }
}
?>