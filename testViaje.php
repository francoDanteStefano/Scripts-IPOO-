<?php

/**
 * La empresa de transporte de pasajeros "Viaje Feliz" quiere registrar la informacion referente a sus viajes. De cada viaje se precisa
 * almacenar el codigo del mismo, destino, cantidad maxima de pasajeros y los pasajeros del viaje.
 * Realice la implementacion de la clase viaje e implemente los metodos necesaior para modificar los atributos de dicha clase (incluso 
 * los datos de los pasajeros). Utilice un array que almacene la informacion correspondiente a los pasajeros. Cada pasajero es un array
 * asociativo con las claves "nombre", "apellido" y "numero de documento". Implementar un script testViaje.php que cree una instancia
 * de la clase viaje y presente un menu que permita cargar la informacion del viaje, modificar y ver sus datos.
 * 
 * El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero. 
 * También se desea guardar la información de la persona responsable de realizar el viaje, para ello cree una clase ResponsableV 
 * que registre el número de empleado, número de licencia, nombre y apellido. La clase Viaje debe hacer referencia al responsable
 *  de realizar el viaje. Volver a implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero. 
 * Luego implementar la operación que agrega los pasajeros al viaje, solicitando por consola la información de los mismos. 
 * Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. De la misma forma cargue la información 
 * del responsable del viaje. */
include "Viaje.php";
include "Pasajero.php";
include "ResponsableV.php";


/**
 * Este módulo muestra por pantalla el menú y retorna la opción elegida por el usuario
 * @return int 
 */
function seleccionarOpcion(){
    // int $menu
    separador();
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

function acumViajes ($cant){
    $objViajes = [];
    for ($i=0; $i < $cant; $i++){
        echo "Ingrese el codigo del viaje n°".($i+1).": "."\n";
        $cod = trim(fgets(STDIN));
        echo "Ingrese el destino del viaje n°".($i+1).": "."\n";
        $dest = trim(fgets(STDIN));
        echo "Ingrese la capacidad máxima pasajeros del viaje n°".($i+1).":"."\n";
        $capMax = trim(fgets(STDIN));
        echo "Ingrese la cantidad de personas del viaje n°".($i+1).":"."\n";
        $viajantes = trim(fgets(STDIN));
        if($viajantes <= $capMax){
            $arrayPasajeros = pasajeros($viajantes);
            $objViajes[$i] = new Viaje ($cod, $dest, $capMax, $arrayPasajeros);
        }else{
        echo "La capacidad es limitada, debe ingresar hasta un maximo de ".$capMax." pasajeros";
        }
    }
    return $objViajes;
}


/**
 * Devuelve true si el viaje existe, false en caso contrario
 * @param array $arrayViajes
 * @param string $codigoViaje
 * @return boolean
 */
function existeViaje($arrayViajes, $codigoViaje){
    $dimension = count($arrayViajes);
    $buscarCodigo = true;
    $i=0;
    while ($buscarCodigo && ($i<$dimension)){
        if (strtolower($arrayViajes[$i]->getCodigo())==strtolower($codigoViaje)){
            $buscarCodigo = false;
        }else{
            $i++;
        }
    }
    return $buscarCodigo;
}

/**
 * Devuelve en que posicion del $arrayViajes se encuentra el codigo ingresado
 * @param array $arrayViajes
 * @param string $codigoViaje
 * @return int
 */
function buscarViaje($arrayViajes, $codigoViaje){
    $dimension = count($arrayViajes);
    $buscarCodigo = true;
    $i = 0;
    while($buscarCodigo && ($i < $dimension)){
        if(strtolower($arrayViajes[$i]->getCodigo()) == strtolower($codigoViaje)){
            $buscarCodigo = false;
        }else{
            $i++;
        }
    }
    return $i;
}

/**
 * Este módulo crea un array con los pasajeros del viaje, tiene como parametro de entrada la 
 * cantidad de pasajeros y retorna el array con todos los pasajeros cargados.
 * @param int
 * @return array 
 */
function pasajeros($cantidad){
    $i= 0;
    $pasajeros = [];
    do
    {
        echo  "Nombre del pasajero n° ".($i+1).": "."\n";
        $nombre = trim(fgets(STDIN));
        echo "Apellido del pasajero n° ".($i+1).": "."\n";
        $apellido = trim(fgets(STDIN));
        echo "Documento del pasajero n° ".($i+1).": "."\n";
        $nroDoc = trim(fgets(STDIN));
        echo "Telefono del pasajero n° ".($i+1).": "."\n";
        $telefono = trim(fgets(STDIN));
        $pasajeros[$i] = new Pasajero($nombre, $apellido, $nroDoc, $telefono);
        $i = $i+1;
    }while($i!=$cantidad);
    return $pasajeros;
}


function nuevoPasajero (){
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


function agregarPasajero($limite, $arrayPasajeros){
    $cantidad = count($arrayPasajeros);
    if ($limite>$cantidad){
        $pasajeroNuevo[$cantidad] = nuevoPasajero();
        array_push ($arrayPasajeros, $pasajeroNuevo[$cantidad]);
    }else{
        echo "No hay lugar para nuevos pasajeros."."\n";
    }
}


function eliminarPasajero($objetoViaje){
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


function modificarPasajero($objetoViaje){
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

function modificarInfoViaje($objetoViaje){
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

function separador(){
    echo "****************************************************************************"."\n";
}
/**********************************************************************************/
/******************************* PROGRAMA PRINCIPAL *******************************/
/**********************************************************************************/

separador();
echo "Bienvenidos a la base de datos de viajes"."\n";
separador();

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

$arrayViajes[0] = new Viaje(1,"Bs As",50,$pasajeros1);
$arrayViajes[1] = new Viaje(2,"Nqn",30,$pasajeros2);
$arrayViajes[2] = new Viaje(3,"Cba",80,$pasajeros3);

echo "Desea agregar un viaje?";
$siNo = strtolower(trim(fgets(STDIN)));
while ($siNo<>"si" && $siNo<>"no"){
    echo "Debe ingresar si o no: "."\n";
    $siNo = strtolower(trim(fgets(STDIN)));
}
if ($siNo == "si"){
    echo "Cuantos viajes que desea ingresar?"."\n";
    $viajes = trim(fgets(STDIN));
    array_merge ($arrayViajes, acumViajes($viajes));
}
$dimension = count($arrayViajes);
$i = 0;
echo "Para ver o modificar un viaje, ingrese un número del 1 al ".$dimension.": ";
$codigo = trim(fgets(STDIN));
$existe = existeViaje($arrayViajes, $codigo);
while ($existe && ($i<$dimension)){
    echo "El codigo ingresado no concuerda, ingreselo nuevamente:";
    $codigo = trim(fgets(STDIN));
    $existe = existeViaje($arrayViajes, $codigo);
}
$posicionViaje = buscarViaje($arrayViajes, $codigo);


$menu = seleccionarOpcion();
separador();
do{
switch ($menu){
    case 1:
        separador();
        agregarPasajero($arrayViajes[$posicionViaje]->getCantMax(), $arrayViajes[$posicionViaje]->getPasajerosViaje());
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
        echo "Lista de pasajeros: ";
        print_r ($arrayViajes[$posicionViaje]->getPasajerosViaje());
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