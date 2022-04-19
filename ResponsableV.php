<?php

class ResponsableV
{
    /**Variables instancia de la ResponsableV
     * string $nombre
     * string $apellido
     * int $nroLicencia
     * int $nroEmpleado
     */
    private $nombre; 
    private $apellido;
    private $nroLicencia;
    private $nroEmpleado;
    
    
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
     * Obtiene el valor de nroLicencia
     */ 
    public function getNroLicencia(){
        return $this->nroLicencia;
    }

    /**
     * Obtiene el valor de nroEmpleado
     */ 
    public function getNroEmpleado(){
        return $this->nroEmpleado;
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
     * Establece el valor de nroLicencia
     */ 
    public function setNroLicencia($nroLicencia){
        $this->nroLicencia = $nroLicencia;
    }

    /**
     * Establece el valor de nroEmpleado
     */ 
    public function setNroEmpleado($nroEmpleado){
        $this->nroEmpleado = $nroEmpleado;
    }
    
    
    /*****************************************************************/
    /*************************** FUNCIONES ***************************/
    /*****************************************************************/
    
    
    /**
     * Módulo constructor de la clase ResponsableV, tiene por parametro los 
     * valores que se le asignan a las variables de la clase
     * @param string $nombre
     * @param string $apellido
     * @param int $nroLicencia
     * @param int $nroEmpleado
     */
    public function __construct($nombre, $apellido, $nroLicencia, $nroEmpleado){   
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->nroLicencia = $nroLicencia;
        $this->nroEmpleado = $nroEmpleado;
    }

    public function __toString(){
        return "*************************************************"."\n".
               "Responsable del viaje"."\n".
               "Nombre: ".$this->getNombre()."\n".
               "Apellido: ".$this->getApellido()."\n".
               "Numero de licencia: ".$this->getNroLicencia()."\n".
               "Numero de empleado: ".$this->getNroEmpleado()."\n".
               "*************************************************"."\n";
    }
}
?>