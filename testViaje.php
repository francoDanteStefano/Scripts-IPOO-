<?php

include "Viaje.php";


/**
 * Este módulo muestra por pantalla el menú y retorna la opción elegida por el usuario
 * @return int 
 */
function seleccionarOpcion()
{
    // int $menu
    echo "\n"."MENU DE OPCIONES"."\n";
    echo "1) Agregar un pasajero"."\n";
    echo "2) Eliminar un pasajero"."\n";
    echo "3) Modificar un pasajero"."\n";
    echo "4) Modificar informacion del viaje"."\n";
    echo "5) Mostrar informacion del viaje"."\n";
    echo "6) Salir"."\n";
    echo "Opcion: ";
    $menu = trim(fgets(STDIN));
    echo "\n";
    return $menu;
}


/**
 * Este módulo crea un array con los pasajeros del viaje, tiene como parametro de entrada la 
 * cantidad de pasajeros y retorna el array con todos los pasajeros cargados.
 * @param int
 * @return array 
 */
function pasajeros($cantidad){
    $i= 0;
    $pasajeros[$i] = ["Nombre" => "",
    "Apellido" => "",
    "Nro documento" => ""];
    do
    {
        echo  "Nombre del pasajero n° ".($i+1).": "."\n";
        $nombre = trim(fgets(STDIN));
        $pasajeros[$i]["Nombre"] = $nombre;
        echo "Apellido del pasajero n° ".($i+1).": "."\n";
        $apellido = trim(fgets(STDIN));
        $pasajeros[$i]["Apellido"] = $apellido;
        echo "Documento del pasajero n° ".($i+1).": "."\n";
        $nroDoc = trim(fgets(STDIN));
        $pasajeros[$i]["Nro documento"] = $nroDoc;
        $i = $i+1;

    }while($i!=$cantidad);
    return $pasajeros;
}


function nuevoPasajero ()
{
    echo "Introduzca el nombre: ";
    $nombre = trim(fgets(STDIN));
    echo "Introduzca el apellido: ";
    $apellido = trim(fgets(STDIN));
    echo "Introduzca el nro de documento: ";
    $nroDocumento = trim(fgets(STDIN));
    $pasajero = ["Nombre" => $nombre,
                 "Apellido" => $apellido,
                 "Nro documento" => $nroDocumento];
    return $pasajero;
}


function agregarPasajero($objetoViaje)
{
    $cantidad = count($objetoViaje->getPasajerosViaje());
    if ($objetoViaje->getCantMax()>$cantidad){
        $pasajeroNuevo[$cantidad] = nuevoPasajero();
        array_push ($arrayPasajeros, $pasajeroNuevo[$cantidad]);
    }else{
        echo "No hay lugar para nuevos pasajeros."."\n";
    }
}


function eliminarPasajero($objetoViaje)
{
    $arrayPas = $objetoViaje->getPasajerosViaje();
    $i=0;
    $cant = count($arrayPas);
    echo "Digite el documento del pasajero: ";
    $documento = trim(fgets(STDIN));
    do{
        $encontro = true;
        if ($arrayPas[$i]["Nro documento"] == $documento){
            $encontro = false;
        }else{
            $i++;
        }
    }while ($encontro && $i<$cant);
    unset($arrayPas[$i]);
    sort($arrayPas);
    $objetoViaje->setPasajerosViaje ($arrayPas);
    print_r($arrayPas);
}


function modificarPasajero($objetoViaje)
{
    echo "Introduzca el documento del pasajero a modificar: "."\n";
    $doc = trim(fgets(STDIN));
    echo "Ingrese el dato a modificar (Nombre/Apellido/Documento): ";
    $modificacion = strtolower(trim(fgets(STDIN)));
    while ((($modificacion != "nombre")&&($modificacion != "apellido")&&($modificacion != "documento"))){
        echo "El dato ingresado no es correcto. Ingrese una opcion: Nombre, Apellido, Documento";
        $modificacion = trim(fgets(STDIN));
    }
    echo "Ingrese el dato: ";
    $dato = trim(fgets(STDIN));
    $objetoViaje->cambiarDatoPasajero($doc, $modificacion, $dato);
    echo "El pasajero ha sido modificado";
}

function modificarInfoViaje($objetoViaje)
{
    echo "Que desea modificar? (Codigo/Destino/Capacidad)"."\n";
    $datoAModificar = strtolower(trim(fgets(STDIN)));
    while (($datoAModificar<>"codigo")&&($datoAModificar<>"destino")&&($datoAModificar<>"capacidad")){
        echo "La opcion ingresada no es válida. Elija 1 (Codigo/Destino/Capacidad)";
        $datoAModificar = strtolower(trim(fgets(STDIN)));
    }
    if($datoAModificar=="codigo"){
        echo "Introduzca el nuevo código: ";
        $newCode = trim(fgets(STDIN));
        $objetoViaje->setCodigo($newCode);
    }elseif ($datoAModificar=="destino"){
        echo "Introduzca el nuevo destino: ";
        $newDest = trim(fgets(STDIN));
        $objetoViaje->setDestino($newDest);
    }elseif ($datoAModificar=="capacidad"){
        echo "Introduzca la capacidad máxima: ";
        $newCapMax = trim(fgets(STDIN));
        $objetoViaje->setCantMax($newCapMax);
    }
    echo $objetoViaje;
}
function separador()
{
    echo "****************************************************************************"."\n";
}
/**********************************************************************************/
/******************************* PROGRAMA PRINCIPAL *******************************/
/**********************************************************************************/

separador();
echo "Bienvenidos a la base de datos de viajes"."\n";
separador();
echo "Ingrese el codigo de viaje: "."\n";
$cod = trim(fgets(STDIN));
echo "Ingrese el destino: "."\n";
$dest = trim(fgets(STDIN));
echo "Ingrese la capacidad máxima pasajeros:"."\n";
$capMax = trim(fgets(STDIN));
echo "Ingrese la cantidad de personas que viajan:"."\n";
$viajante = trim(fgets(STDIN));
if($viajante <= $capMax){
    $arrayPasajeros = pasajeros($viajante);
    $objViaje = new Viaje ($cod, $dest, $capMax, $arrayPasajeros);
}else{
    echo "La capacidad es limitada, debe ingresar hasta un maximo de ".$capMax." pasajeros";
}
$menu = seleccionarOpcion();
separador();
do{
switch ($menu){
    case 1:
        separador();
        agregarPasajero($objViaje->getCantMax(), $objViaje->getPasajerosViaje());
        $menu = seleccionarOpcion();
        break;

    case 2:
        separador();
        eliminarPasajero($objViaje);
        $menu = seleccionarOpcion();
        break;

    case 3:
        separador();
        modificarPasajero($objViaje);
        $menu = seleccionarOpcion();
        break;
        
    case 4:
        separador();
        modificarInfoViaje($objViaje);
        $menu = seleccionarOpcion();
        break;

    case 5:
        separador();
        echo $objViaje;
        echo "Lista de pasajeros: ";
        print_r ($arrayPasajeros);
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