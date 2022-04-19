<?php

class Pasajero
{
    /**Variables instancia de la clase
     * string $nombre
     * string $apellido
     * int $nroDocumento
     * int $telefono
     */
    private $nombre;
    private $apellido;
    private $nroDocumento;
    private $telefono;
    
    
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
     * Obtiene el valor de nroDocumento
     */ 
    public function getNroDocumento(){
        return $this->nroDocumento;
    }

    /**
     * Obtiene el valor de telefono
     */ 
    public function getTelefono(){
        return $this->telefono;
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
     * Establece el valor de nroDocumento
     */ 
    public function setNroDocumento($nroDocumento){
        $this->nroDocumento = $nroDocumento;
    }

    /**
     * Establece el valor de telefono
     */ 
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }


    /*****************************************************************/
    /*************************** FUNCIONES ***************************/
    /*****************************************************************/

    /**
     * Módulo constructor de la clase Pasajero, tiene por parametro los 
     * valores que se le asignan a las variables de la clase
     * @param string $nombre
     * @param string $apellido
     * @param int $nroDocumento
     * @param int $telefono
     */
    public function __construct($nombre, $apellido, $nroDocumento, $telefono){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->nroDocumento = $nroDocumento;
        $this->telefono = $telefono;
    }

    public function __toString(){
        return "*************************************************"."\n".
               "Pasajero: "."\n".
               "Nombre: ".$this->getNombre()."\n".
               "Apellido: ".$this->getApellido()."\n".
               "Numero de documento: ".$this->getNroDocumento()."\n".
               "Telefono: ".$this->getTelefono()."\n".
               "*************************************************"."\n";
    }
}
?>