<?php
 /*  
 * Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. 
 */
include "Viaje.php";
include "Pasajero.php";
include "ResponsableV.php";


/**********************************************************************************/
/*********************************** FUNCIONES ************************************/
/**********************************************************************************/


/**
 * Este módulo muestra por pantalla el menú y retorna la opción elegida por el usuario
 * @return int 
 */
function seleccionarOpcion(){
    separador();
    echo "\n"."MENU DE OPCIONES"."\n";
    echo "1) Agregar pasajeros"."\n";
    echo "2) Eliminar un pasajero"."\n";
    echo "3) Modificar un pasajero"."\n";
    echo "4) Modificar información del viaje"."\n";
    echo "5) Mostrar información del viaje"."\n";
    echo "6) Modificar el responsable del vuelo"."\n";
    echo "7) Salir"."\n";
    echo "Opción: ";
    $menu = trim(fgets(STDIN));
    echo "\n";
    return $menu;
}

/**
 * Esta función permite crear una cantidad determinada de nuevos objetos Viaje, 
 * los almacena en un array y lo retorna.
 * @param int $cant
 * @return array
 */
function acumViajes ($cant){
    $objViajes = [];
    for ($i = 0; $i < $cant; $i ++){
        echo "Ingrese el código del viaje n°".($i + 1).": "."\n";
        $cod = trim(fgets(STDIN));
        echo "Ingrese el destino del viaje n°".($i + 1).": "."\n";
        $dest = trim(fgets(STDIN));
        echo "Ingrese la capacidad máxima pasajeros del viaje n°".($i + 1).":"."\n";
        $capMax = trim(fgets(STDIN));
        echo "Ingrese la cantidad de personas del viaje n°".($i + 1).":"."\n";
        $viajantes = trim(fgets(STDIN)); 
        $arrayPasajeros = agregarPasajeros($capMax,$objViajes,$viajantes);
        $objViajes[$i] = new Viaje ($cod, $dest, $capMax, $arrayPasajeros);
      
        echo "La capacidad es limitada, debe ingresar hasta un máximo de ".$capMax." pasajeros";
        
    }
    return $objViajes;
}

/**
 * Función que verifica si un viaje existe, toma por parametros la colección de viajes
 * y el código del viaje. Si lo encuentra retorna true, false caso contrario.
 * @param array $arrayViajes
 * @param int $codigoViaje
 * @return boolean
 */
function existeViaje($arrayViajes, $codigoViaje){
    $dimension = count($arrayViajes);
    $buscarCodigo = false;
    $i = 0;
    while (!$buscarCodigo && ($i < $dimension)){
        if (strtolower($arrayViajes[$i]->getCodigo()) == strtolower($codigoViaje)){
            $buscarCodigo = true;
        }else{
            $i ++;
        }
    }
    return $buscarCodigo;
}

/**
 * Función que busca la posición de un viaje, toma por parametros el código del mismo
 * y la colección de viajes. Si lo encuentra retorna la posición, null caso contrario.
 * @param array $arrayViajes
 * @param int $codigoViaje
 * @return int
 */
function buscarViaje($arrayViajes, $codigoViaje){
    $dimension = count($arrayViajes);
    $buscarCodigo = false;
    $i = 0;
    while(!$buscarCodigo && ($i < $dimension)){
        if(strtolower($arrayViajes[$i]->getCodigo()) == strtolower($codigoViaje)){
            $buscarCodigo = true;
        }else{
            $i ++;
        }
    }
    if(!$buscarCodigo){
        $i = null;
    }
    return $i;
}

/**
 * Esta función solicita los datos datos para crear un objeto Pasajero y lo retorna.
 * @return object 
 */
function nuevoPasajero ($objViaje){
    do{
        echo "Introduzca el nombre: ";
        $nombre = trim(fgets(STDIN));
        echo "Introduzca el apellido: ";
        $apellido = trim(fgets(STDIN));
        echo "Introduzca el nro de documento: ";
        $nroDoc = trim(fgets(STDIN));
        echo "Introduzca el teléfono: ";
        $telefono = trim(fgets(STDIN));
        $existe = $objViaje->existePasajero($nroDoc);
        if ($existe){
            echo "Ese pasajero ya esta cargado, introduzca otro pasajero:"."\n";
        }
    }while($existe);
    $pasajero = new Pasajero($nombre, $apellido, $nroDoc, $telefono);
    return $pasajero;
}

/**
 * Función que agrega pasajeros creados a la colección de pasajeros, si no supera 
 * la cantidad máxima de pasajeros.
 * @param int $limite
 * @param array $arrayPasajeros
 * @param object $objetoViaje
 * @return array
 */
function agregarPasajeros($limite,$objetoViaje, $cantidad){
    $i = 0;
    if ($cantidad <= $limite){
        $cargar = true;
    }else{
        $cargar = false;
        echo "No hay lugar para nuevos pasajeros."."\n";
    }
    while ($cargar && $i <= $cantidad){
        $pasajeroNuevo[$i] = nuevoPasajero($objetoViaje);
    }
    return $pasajeroNuevo;
}

/**
 * Devuelve la posición del pasajero dentro de la colección que tiene el viaje.
 * @param object $objetoViaje
 * @param int $documento
 * @return int
 */
function buscarPasajero($objetoViaje){
    $arrayPas = $objetoViaje->getArrayObjPasajeros();
    $i = 0;
    $cant = count($arrayPas);
    echo "Escriba el número de documento del pasajero: ";
    $documento = trim(fgets(STDIN));
    do{
        $noEncuentra = true;
        if ($arrayPas[$i]->getNroDocumento() == $documento){
            $noEncuentra = false;
        }else{
            $i ++;
        }
    }while ($noEncuentra && $i<$cant);
    if($noEncuentra){
        $i = null;
    }
    return $i;
}


/**
 * Función que elimina un pasajero de la coleccion de pasajeros.
 * @param object $objetoViaje
 */
function eliminarPasajero($objetoViaje){
    $i = buscarPasajero($objetoViaje);
    $arrayPas = $objetoViaje->getArrayObjPasajeros();
    if ($i <> null){
        unset($arrayPas[$i]);
        sort($arrayPas);
        $objetoViaje->setArrayObjPasajeros ($arrayPas);
    }else{
        echo "El pasajero no esta cargado en el sistema";
    }
}

/**
 * Esta función modifica los datos de un pasajero
 * @param object $objetoViaje
 */
function modificarPasajero($objetoViaje)
{
    $arrayPas = $objetoViaje->getArrayObjPasajeros();
    $i = buscarPasajero($objetoViaje);
    if ($i <> null){
        do{
            echo "Ingrese 1, si desea modificar el nombre."."\n";
            echo "Ingrese 2, si desea modificar el apellido."."\n";
            echo "Ingrese 3, si desea modificar el teléfono."."\n";
            echo "Ingrese 4, si desea salir."."\n";
            $opcion = trim(fgets(STDIN));
            switch($opcion){
                case 1: 
                    echo "Escriba el nuevo nombre: "."\n";
                    $nombre = trim(fgets(STDIN));
                    $arrayPas[$i]->setNombre($nombre);
                    echo "Se ha modificado el nombre";
                    break;

                case 2: 
                    echo "Escriba el nuevo apellido: "."\n";
                    $apellido = trim(fgets(STDIN));
                    $arrayPas[$i]->setApellido($apellido);
                    echo "Se ha modificado el apellido";
                    break;

                case 3: 
                    echo "Escriba el nuevo teléfono: "."\n";
                    $telefono = trim(fgets(STDIN));
                    $arrayPas[$i]->setTelefono($telefono);
                    echo "Se ha modificado el teléfono";
                    break;
                    
                default:
                    echo "Debe introducir un numero del 1 al 4";
                    $opcion = trim(fgets(STDIN));
                    break;
            }
        }while($opcion < 4 || $opcion > 4);
    }else{
        echo "El pasajero no esta cargado en el sistema";
    }
}

/**
 * Esta función modifica los datos de un viaje.
 * @param object $objetoViaje
 */
function modificarInfoViaje($objetoViaje){
    echo "Ingrese 1, si desea modificar el código."."\n";
    echo "Ingrese 2, si desea modificar el destino."."\n";
    echo "Ingrese 3, si desea modificar la capacidad máxima de pasajeros."."\n";
    echo "Que desea modificar?"."\n";
    $opcion = trim(fgets(STDIN));
    echo "Introduzca el nuevo valor:"."\n";
    $dato = trim(fgets(STDIN));
    $objetoViaje->modificarViaje($opcion,$dato);
}
/**
 * Esta función modifica los datos del objeto ResponsableV.
 * @param object $objetoViaje
 */
function modificarResponsable($objetoViaje){
    echo "Ingrese 1, si desea modificar el nombre."."\n";
    echo "Ingrese 2, si desea modificar el apellido."."\n";
    echo "Ingrese 3, si desea modificar número de licencia."."\n";
    echo "Ingrese 4, si desea modificar número de empleado."."\n";
    do{
        echo "Que desea modificar?"."\n";
        $opcion = trim(fgets(STDIN));
        echo "Introduzca el nuevo valor:"."\n";
        $dato = trim(fgets(STDIN));
        $objetoViaje->modificarViaje($opcion,$dato);
        echo "Desea modificar otro dato?";
        $siNo = trim(fgets(STDIN));
    }while($siNo == "si");
    echo "Los nuevos datos del responsable son:".$objetoViaje->getResponsableV();
}

function separador(){
    echo "****************************************************************************"."\n";
}


/**********************************************************************************/
/******************************* DATOS PRECARGADOS ********************************/
/**********************************************************************************/


//Array de pasajeros 

//Viaje 1
$pasajeros1[0] = new Pasajero("Juan","Perez",123456789,2995123456);
$pasajeros1[1] = new Pasajero("Gabriel","Lopez",123789456,2995456123);
//Viaje 2
$pasajeros2[0] = new Pasajero("Juan","Perez",123456789,2995123456);
$pasajeros2[1] = new Pasajero("Gabriel","Lopez",123789456,2995456123);
//Viaje 3
$pasajeros3[0] = new Pasajero("Pedro","Perez",987654321,2995123456);
$pasajeros3[1] = new Pasajero("Juan","Lopez",102345678,2995123456);
$pasajeros3[2] = new Pasajero("Jose","Perez",876543210,2995123456);

//Responsable de viaje
$responsableV1 = new ResponsableV("John", "Smith", 321451, 9991);
$responsableV2= new ResponsableV("Michael", "Jonhson", 147276, 1377);
$responsableV3 = new ResponsableV("Cage", "Fefer", 786555, 4578);

//Array de viajes 
$arrayViajes[0] = new Viaje(1, "Bs As", 10, $pasajeros1, $responsableV1);
$arrayViajes[1] = new Viaje(2, "Nqn", 10, $pasajeros2, $responsableV2);
$arrayViajes[2] = new Viaje(3, "Cba", 10, $pasajeros3, $responsableV3);


/**********************************************************************************/
/******************************* PROGRAMA PRINCIPAL *******************************/
/**********************************************************************************/


separador();
echo "Bienvenidos a la base de datos de viajes"."\n";
separador();
echo "Desea agregar un viaje?"."\n";
$siNo = strtolower(trim(fgets(STDIN)));
while (($siNo <> "si") && ($siNo <> "no")){
    echo "Debe ingresar si o no: "."\n";
    $siNo = strtolower(trim(fgets(STDIN)));
}
if ($siNo == "si"){
    echo "Cuantos viajes que desea ingresar?"."\n";
    $cantViajes = trim(fgets(STDIN));
    array_merge ($arrayViajes, acumViajes($cantViajes));
}
$dimension = count($arrayViajes);
$i = 0;
echo "Para ver o modificar un viaje, ingrese un número del 1 al ".$dimension.":"."\n";
$codigo = trim(fgets(STDIN));
$existe = existeViaje($arrayViajes, $codigo);
while (!$existe && ($i < $dimension)){
    echo "El código ingresado no concuerda, ingreselo nuevamente:";
    $codigo = trim(fgets(STDIN));
    $existe = existeViaje($arrayViajes, $codigo);
    $i ++;
}
$posicionViaje = buscarViaje($arrayViajes, $codigo);
$menu = seleccionarOpcion();
separador();
do{
    switch ($menu){
        case 1:
            separador();
            $capacidadMax = $arrayViajes[$posicionViaje]->getCapMax();
            $arrayPasajeros = $arrayViajes[$posicionViaje]->getArrayObjPasajeros();
            echo "Cuantos pasajeros desea agregar?"."\n";
            $cantidad = trim(fgets(STDIN));
            $nuevosPasajeros = agregarPasajeros($capacidadMax, $arrayViajes[$posicionViaje], $cantidad);
            $arrayViajes[$posicionViaje]->setArrayObjPasajeros(array_merge($arrayPasajeros, $nuevosPasajeros));
            $menu = seleccionarOpcion();
            break;

        case 2:
            separador();
            eliminarPasajero($arrayViajes[$posicionViaje]);
            $menu = seleccionarOpcion();
            break;

        case 3:
            separador();
            modificarPasajero($arrayViajes[$posicionViaje]);
            $menu = seleccionarOpcion();
            break;
            
        case 4:
            separador();
            modificarInfoViaje($arrayViajes[$posicionViaje]);
            $menu = seleccionarOpcion();
            break;

        case 5:
            separador();
            echo $arrayViajes[$posicionViaje];
            echo "Lista de pasajeros: "."\n".$arrayViajes[$posicionViaje]->pasajerosToString();
            $menu = seleccionarOpcion();
            break; 
        case 6:
            separador();
            modificarResponsable($arrayViajes[$posicionViaje]);
            $menu = seleccionarOpcion();
            break; 

        default:
            echo "Debe introducir un número entre el 1 y el 7";
            $menu = seleccionarOpcion();
            break;
        }
} while ($menu < 7 || $menu > 7);
exit();
?>