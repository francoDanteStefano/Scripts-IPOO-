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
    echo "1) Agregar pasajero"."\n";
    echo "2) Eliminar un pasajero"."\n";
    echo "3) Modificar un pasajero"."\n";
    echo "4) Mostrar un pasajero"."\n";
    echo "5) Modificar información del viaje"."\n";
    echo "6) Mostrar información del viaje"."\n";
    echo "7) Modificar el responsable del vuelo"."\n";
    echo "8) Mostrar el responsable del vuelo"."\n";
    echo "9) Salir"."\n";
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
        echo "Ingrese los datos del responsable de vuelo del viaje n°".($i + 1).":"."\n";
        echo "Nombre:  ";
        $nombre = trim(fgets(STDIN));
        echo "\n"."Apellido:  ";
        $apellido = trim(fgets(STDIN));
        echo "\n"."Número de licencia:  ";
        $nroLicencia = trim(fgets(STDIN));
        echo "\n"."Número de empleado:  ";
        $nroEmpleado = trim(fgets(STDIN));
        $responsable = new ResponsableV($nombre, $apellido, $nroLicencia, $nroEmpleado);
        $arrayPasajeros = [];
        $objViajes[$i] = new Viaje ($cod, $dest, $capMax, $arrayPasajeros, $responsable);
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
 * Esta función modifica los datos de un viaje.
 * @param object $objetoViaje
 */
function modificarInfoViaje($objetoViaje){
    echo "Ingrese 1, si desea modificar el código."."\n";
    echo "Ingrese 2, si desea modificar el destino."."\n";
    echo "Ingrese 3, si desea modificar la capacidad máxima de pasajeros."."\n";
    echo "Que desea modificar?"."\n";
    $opcion = trim(fgets(STDIN));
    while (($opcion <> 1)&&($opcion <> 2)&&($opcion <> 3)){
        echo "Solo puede ingresar 1, 2 o 3 como opcion válida:"."\n";
        $opcion = trim(fgets(STDIN));
    }
    echo "Introduzca el nuevo valor:"."\n";
    $dato = trim(fgets(STDIN));
    $objetoViaje->modificarViaje($opcion,$dato);
    echo $objetoViaje;
}

/**
 * Esta función modifica los datos del objeto ResponsableV.
 * @param object $objetoViaje
 */
function modificarResponsable($objetoViaje){
    do{
        echo "Ingrese 1, si desea modificar el nombre."."\n";
        echo "Ingrese 2, si desea modificar el apellido."."\n";
        echo "Ingrese 3, si desea modificar número de licencia."."\n";
        echo "Ingrese 4, si desea modificar número de empleado."."\n";
        echo "Que desea modificar?"."\n";
        $opcion = trim(fgets(STDIN));
        echo "Introduzca el nuevo valor:"."\n";
        $dato = trim(fgets(STDIN));
        $objetoViaje->modificarViaje($opcion,$dato);
        echo "Desea modificar otro dato?";
        $siNo = trim(fgets(STDIN));
    }while($siNo == "si");
    echo "Los nuevos datos del responsable son:".$objetoViaje->getResponsableV()."\n";
}
/**
 * Esta función modifica los datos del objeto ResponsableV.
 * @param object $objetoViaje
 */
function modificarUnPasajero($objetoViaje){
    echo "Introduzca el documento del pasajero:"."\n";
        $dni = trim(fgets(STDIN));
    do{
        echo "Ingrese 1, si desea modificar el nombre."."\n";
        echo "Ingrese 2, si desea modificar el apellido."."\n";
        echo "Ingrese 3, si desea modificar el teléfono."."\n";
        echo "Que desea modificar?"."\n";
        $opcion = trim(fgets(STDIN));
        echo "Introduzca el nuevo valor:"."\n";
        $dato = trim(fgets(STDIN));
        $modifica = $objetoViaje->modificarPasajero($dni, $opcion, $dato);
        if($modifica){
            echo "El pasajero fue modificado correctamente:"."\n";
            echo $objetoViaje->mostrarPasajero($dni)."\n";
            echo "Desea modificar otro dato?"."\n";
            $siNo = strtolower(trim(fgets(STDIN)));
        }else{
            echo "El pasajero no existe. Introduzca otro documento:"."\n";
            $dni = trim(fgets(STDIN));
            $siNo = "si";
        }
    }while($siNo == "si");
}

/**
 * Esta función crea una cantidad determinada de pasajeros y los almacena en un array.
 * Retorna el array
 * @param object $objetoViaje
 */
function nuevosPasajeros($cantidad, $objetoViaje){
    for ($i = 0; $i < $cantidad; $i++){
        echo "Introduzca el nombre del pasajero n° ".($i+1).":"."\n";
        $nombre = trim(fgets(STDIN));
        echo "Introduzca el apellido del pasajero n° ".($i+1).":"."\n";
        $apellido = trim(fgets(STDIN));
        echo "Introduzca el documento del pasajero n° ".($i+1).":"."\n";
        $dni = trim(fgets(STDIN));
        echo "Introduzca el teléfono del pasajero n° ".($i+1).":"."\n";
        $telefono = trim(fgets(STDIN));
        $arrayPasajeros[$i] = $objetoViaje->agregarPasajero($nombre, $apellido, $dni, $telefono);
    }
    return $arrayPasajeros;
}

/**
 * Esta función muestra los codigos de todos los viajes en una cadena de caracteres.
 * @param array $arrayViajes
 * @return string
 */
function codigoViajesToString($arrayViajes){
    $string = "Codigos de viajes:"."\n";
    foreach ($arrayViajes as $objViaje){
        $string .= "Viaje con destino a ".$objViaje->getDestino().": ".$objViaje->getCodigo()."\n";
    }
    return $string;
}

/**
 * Función que muestra por pantalla un separador de asteriscos 
 */
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
$arrayViajes[0] = new Viaje(98743, "Bs As", 10, $pasajeros1, $responsableV1);
$arrayViajes[1] = new Viaje(12547, "Nqn", 10, $pasajeros2, $responsableV2);
$arrayViajes[2] = new Viaje(36963, "Cba", 10, $pasajeros3, $responsableV3);


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
echo codigoViajesToString($arrayViajes);
echo "Para ver o modificar un viaje, ingrese su código:"."\n";
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
            $nuevaCantidad = $cantidad + count($arrayPasajeros);
            if($nuevaCantidad < $capacidadMax){
                $coleccionPasajeros = nuevosPasajeros($cantidad, $arrayViajes[$posicionViaje]);
                $nuevaColeccion = array_merge($arrayPasajeros,$coleccionPasajeros);
                $arrayViajes[$posicionViaje]->setArrayObjPasajeros($nuevaColeccion);
            }else{
                $espacioDisp = $capacidadMax - count($arrayPasajeros);
                echo "No se han cargado los pasajeros. Solo quedan ".$espacioDisp." lugares disponibles."."\n";
            }
            $menu = seleccionarOpcion();
            break;

        case 2:
            separador();
            echo "Escriba el documento del pasajero que desea quitar:"."\n";
            $documento = trim(fgets(STDIN));
            $elimina = $arrayViajes[$posicionViaje]->eliminarPasajero($documento);
            if ($elimina){
                echo "El pasajero fue quitado correctamente."."\n";
            }else{
                echo "El pasajero no fue cargado en este viaje."."\n";
            }
            $menu = seleccionarOpcion();
            break;

        case 3:
            separador();
            modificarUnPasajero($arrayViajes[$posicionViaje]);
            $menu = seleccionarOpcion();
            break;
            
        case 4:
            separador();
            $objViaje = $arrayViajes[$posicionViaje];
            echo "Escriba el documento del pasajero que desea mostrar:"."\n";
            $documento = trim(fgets(STDIN));
            $objPasajero = $objViaje->mostrarPasajero($documento);
            while($objPasajero == null){
                echo "El documento ingresado no concuerda con ningun pasajero.
                      Introduzca otro documento:"."\n";
                $documento = trim(fgets(STDIN));
                $objPasajero = $objViaje->mostrarPasajero($documento);
            }
            echo $objPasajero;
            $menu = seleccionarOpcion();
            break;
        
        case 5:
            separador();
            modificarInfoViaje($arrayViajes[$posicionViaje]);
            $menu = seleccionarOpcion();
            break;

        case 6:
            separador();
            echo $arrayViajes[$posicionViaje];
            $menu = seleccionarOpcion();
            break; 

        case 7:
            separador();
            modificarResponsable($arrayViajes[$posicionViaje]);
            $menu = seleccionarOpcion();
            break;

        case 8:
            separador();
            echo $arrayViajes[$posicionViaje]->getObjResponsableV();
            $menu = seleccionarOpcion();
            break; 

        default:
            separador();
            echo "Debe introducir un número entre el 1 y el 9"."\n";
            $menu = seleccionarOpcion();
            break;
        }
} while ($menu < 9 || $menu > 9);
exit();
?>