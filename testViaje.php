<?php
 /*  
 * También se desea guardar la información de la persona responsable de realizar el viaje, para ello cree una clase ResponsableV 
 * que registre el número de empleado, número de licencia, nombre y apellido. La clase Viaje debe hacer referencia al responsable
 *  de realizar el viaje. Volver a implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero. 
 * Luego implementar la operación que agrega los pasajeros al viaje, solicitando por consola la información de los mismos. 
 * Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. De la misma forma cargue la información 
 * del responsable del viaje. */
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
    echo "1) Agregar un pasajero"."\n";
    echo "2) Eliminar un pasajero"."\n";
    echo "3) Modificar un pasajero"."\n";
    echo "4) Modificar información del viaje"."\n";
    echo "5) Mostrar información del viaje"."\n";
    echo "6) Salir"."\n";
    echo "Opción: ";
    $menu = trim(fgets(STDIN));
    echo "\n";
    return $menu;
}

/**
 * Esta función permite crear una cantidad determinada de 
 * nuevos objetos Viaje, los almacena en un array y lo retorna.
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
        if($viajantes <= $capMax){
            $arrayPasajeros = coleccionPasajeros($viajantes);
            $objViajes[$i] = new Viaje ($cod, $dest, $capMax, $arrayPasajeros);
        }else{
        echo "La capacidad es limitada, debe ingresar hasta un máximo de ".$capMax." pasajeros";
        }
    }
    return $objViajes;
}

/**
 * Función que verifica si un viaje existe, 
 * toma por parametros la colección de viajes y el código del viaje.
 * Si lo encuentra retorna true, false caso contrario.
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
 * Función que busca la posición de un viaje, 
 * toma por parametros el código del mismo y la colección de viajes.
 * Si lo encuentra retorna la posición, null caso contrario.
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
function nuevoPasajero (){
    echo "Introduzca el nombre: ";
    $nombre = trim(fgets(STDIN));
    echo "Introduzca el apellido: ";
    $apellido = trim(fgets(STDIN));
    echo "Introduzca el nro de documento: ";
    $nroDoc = trim(fgets(STDIN));
    echo "Introduzca el teléfono: ";
    $telefono = trim(fgets(STDIN));
    $pasajero = new Pasajero($nombre, $apellido, $nroDoc, $telefono);
    return $pasajero;
}

/**
 * Esta función permite crear una cantidad determinada de 
 * nuevos objetos Pasajero, los almacena en un array y lo retorna.
 * @param int $cantidad
 * @return array 
 */
function coleccionPasajeros($cantidad){
    $i = 0;
    $pasajeros = [];
    do{
        $pasajeros[$i] = nuevoPasajero();
        $i ++;
    }while($i <= $cantidad);
    return $pasajeros;
}

/**
 * Función que agrega un pasajero creado a la colección de pasajeros,
 * si no supera la cantidad máxima de pasajeros.
 * @param int $limite
 * @param array $arrayPasajeros
 * @param object $objetoViaje
 */
function agregarPasajero($limite, $arrayPasajeros, $objetoViaje){
    $cantidad = count($arrayPasajeros);
    if ($cantidad > $limite){
        $pasajeroNuevo[$cantidad] = nuevoPasajero();
        $objetoViaje->setPasajerosViaje (array_push ($arrayPasajeros, $pasajeroNuevo[$cantidad]));
    }else{
        echo "No hay lugar para nuevos pasajeros."."\n";
    }
}

/**
 * Devuelve la posición del pasajero dentro de la colección que tiene el viaje.
 * @param object $objetoViaje
 * @param int $documento
 * @return int
 */
function buscarPasajero($objetoViaje){
    $arrayPas = $objetoViaje->getPasajerosViaje();
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
    $arrayPas = $objetoViaje->getPasajerosViaje();
    if ($i <> null){
        unset($arrayPas[$i]);
        sort($arrayPas);
        $objetoViaje->setPasajerosViaje ($arrayPas);
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
    $arrayPas = $objetoViaje->getPasajerosViaje();
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
    echo "Que desea modificar?"."\n";
    echo "Ingrese 1, si desea modificar el código."."\n";
    echo "Ingrese 2, si desea modificar el destino."."\n";
    echo "Ingrese 3, si desea modificar la capacidad máxima de pasajeros."."\n";
    $opcion = trim(fgets(STDIN));
    if ($opcion == 1){
        echo "Ingrese el nuevo código:"."\n";
        $dato = trim(fgets(STDIN));
        $objetoViaje->modificarViaje($opcion,$dato);
    }elseif ($opcion == 2){
        echo "Ingrese el nuevo destino:"."\n";
        $dato = trim(fgets(STDIN));
        $objetoViaje->modificarViaje($opcion,$dato);
    }elseif ($opcion == 3){
        echo "Ingrese la nueva capacidad máxima:"."\n";
        $dato = trim(fgets(STDIN));
        $objetoViaje->modificarViaje($opcion,$dato);
    }else{
        echo "Usted no ha modificado ningún dato";
    }
}

function separador(){
    echo "****************************************************************************"."\n";
}


/**********************************************************************************/
/******************************* DATOS PRECARGADOS ********************************/
/**********************************************************************************/


//Arrays de pasajeros precargados
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

//Array de viajes precargados
$arrayViajes[0] = new Viaje(1,"Bs As",10,$pasajeros1);
$arrayViajes[1] = new Viaje(2,"Nqn",10,$pasajeros2);
$arrayViajes[2] = new Viaje(3,"Cba",10,$pasajeros3);


/**********************************************************************************/
/******************************* PROGRAMA PRINCIPAL *******************************/
/**********************************************************************************/


separador();
echo "Bienvenidos a la base de datos de viajes"."\n";
separador();
echo "Desea agregar un viaje?";
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
echo "Para ver o modificar un viaje, ingrese un número del 1 al ".$dimension.":";
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
        $arrayPasajeros = $arrayViajes[$posicionViaje]->getPasajerosViaje();
        agregarPasajero($capacidadMax, $arrayPasajeros, $arrayViajes[$posicionViaje]);
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

    default:
        echo "Debe introducir un número entre el 1 y el 6";
        $menu = seleccionarOpcion();
        break;
    }
} while ($menu < 6 || $menu > 6);
exit();
?>