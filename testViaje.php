<?php
/**********************************************************************************/
/*********************************** INCLUDES *************************************/
/**********************************************************************************/

include "Viaje.php";
include "Pasajero.php";
include "ResponsableV.php";
include "BaseDatos.php";
include "Empresa.php";

/**********************************************************************************/
/****************************** SALIDA POR PANTALLA *******************************/
/**********************************************************************************/

function separador(){
    return "|\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\|\n";
}

/**
 * Este módulo muestra por pantalla el menú y retorna la opción elegida por el usuario
 * @return int 
 */
function menuPrincipal(){
    separador();
    echo "╔═════════════════════════════════════════╗"."\n".
         "║               BBDD VIAJES               ║"."\n".
         "╚═════════════════════════════════════════╝"."\n".
         "╔═══╦═════════════════════════════════════╗"."\n".
         "║ 0 ║ Salir                               ║"."\n".
         "║ 1 ║ Menú de Empresas                    ║"."\n".
         "║ 2 ║ Menú de Viajes                      ║"."\n".
         "║ 3 ║ Menú de Pasajeros                   ║"."\n".
         "║ 4 ║ Menú de Responsables de Viajes      ║"."\n".
         "╚═══╩═════════════════════════════════════╝"."\n".
         "╔════════════════╗                      ╔═╗"."\n".
         "║ Opción elegida ╠══════════════════════╣";$opcion = verificarEntero(trim(fgets(STDIN)));
    echo "╚════════════════╝                      ╚═╝"."\n";
    return $opcion;
}

/**
 * Este módulo muestra por pantalla el menú y retorna la opción elegida por el usuario
 * @return int 
 */
function menuEmpresas(){
    separador();
    echo "╔═════════════════════════════════════════╗"."\n".
         "║          Administrar Empresas           ║"."\n".
         "╚═════════════════════════════════════════╝"."\n".
         "╔═══╦═════════════════════════════════════╗"."\n".
         "║ 0 ║ Volver al menú anterior             ║"."\n".
         "║ 1 ║ Agregar una empresa                 ║"."\n".
         "║ 2 ║ Modificar una empresa               ║"."\n".
         "║ 3 ║ Ver todas las empresas              ║"."\n".
         "╚═══╩═════════════════════════════════════╝"."\n".
         "╔════════════════╗                      ╔═╗"."\n".
         "║ Opción elegida ╠══════════════════════╣";$opcion = verificarEntero(trim(fgets(STDIN)));
    echo "╚════════════════╝                      ╚═╝"."\n";
    return $opcion;
}

/**
 * Este módulo muestra por pantalla el menú y retorna la opción elegida por el usuario
 * @return int 
 */
function menuModificarEmpresa(){
    separador();
    echo "╔═════════════════════════════════════════╗"."\n".
         "║        Modificar datos empresa          ║"."\n".
         "╚═════════════════════════════════════════╝"."\n".
         "╔═══╦═════════════════════════════════════╗"."\n".
         "║ 0 ║ Volver al menú anterior             ║"."\n".
         "║ 1 ║ Modificar nombre                    ║"."\n".
         "║ 2 ║ Modificar dirección                 ║"."\n".
         "╚═══╩═════════════════════════════════════╝"."\n".
         "╔════════════════╗                      ╔═╗"."\n".
         "║ Opción elegida ╠══════════════════════╣";$seleccion = verificarEntero(trim(fgets(STDIN)));
    echo "╚════════════════╝                      ╚═╝"."\n";
    return $seleccion;
}

/**
 * Este módulo muestra por pantalla el menú y retorna la opción elegida por el usuario
 * @return int 
 */
function menuViajes(){
    separador();
    echo "╔═════════════════════════════════════════╗"."\n".
         "║           Administrar Viajes            ║"."\n".
         "╚═════════════════════════════════════════╝"."\n".
         "╔═══╦═════════════════════════════════════╗"."\n".
         "║ 0 ║ Volver al menú anterior             ║"."\n".
         "║ 1 ║ Agregar viajes                      ║"."\n".
         "║ 2 ║ Modificar un viaje                  ║"."\n".
         "║ 3 ║ Eliminar un viaje                   ║"."\n".
         "║ 4 ║ Ver todos los viajes                ║"."\n".
         "╚═══╩═════════════════════════════════════╝"."\n".
         "╔════════════════╗                      ╔═╗"."\n".
         "║ Opción elegida ╠══════════════════════╣";$opcion = verificarEntero(trim(fgets(STDIN)));
    echo "╚════════════════╝                      ╚═╝"."\n";
    return $opcion;
}

/**
 * Este módulo muestra por pantalla el menú y retorna la opción elegida por el usuario
 * @return int 
 */
function menuModificarViaje(){
    echo "╔═════════════════════════════════════════╗"."\n".
         "║        Modificar datos viaje            ║"."\n".
         "╚═════════════════════════════════════════╝"."\n".
         "╔═══╦═════════════════════════════════════╗"."\n".
         "║ 0 ║ Volver al menú anterior             ║"."\n".
         "║ 1 ║ Modificar destino                   ║"."\n".
         "║ 2 ║ Modificar la cant max de pasajeros  ║"."\n".
         "║ 3 ║ Modificar el importe del asiento    ║"."\n".
         "║ 4 ║ Modificar el tipo de asiento        ║"."\n".
         "║ 5 ║ Modificar tipo de viaje(IdaYVuelta) ║"."\n".
         "╚═══╩═════════════════════════════════════╝"."\n".
         "╔════════════════╗                      ╔═╗"."\n".
         "║ Opción elegida ╠══════════════════════╣";$seleccion = verificarEntero(trim(fgets(STDIN)));
    echo "╚════════════════╝                      ╚═╝"."\n";
    return $seleccion;
}

/**
 * Este módulo muestra por pantalla el menú y retorna la opción elegida por el usuario
 * @return int 
 */
function menuPasajeros(){
    separador();
    echo "╔═════════════════════════════════════════╗"."\n".
         "║          Administrar Pasajeros          ║"."\n".
         "╚═════════════════════════════════════════╝"."\n".
         "╔═══╦═════════════════════════════════════╗"."\n".
         "║ 0 ║ Volver al menú anterior             ║"."\n".
         "║ 1 ║ Agregar un pasajero                 ║"."\n".
         "║ 2 ║ Modificar un pasajero               ║"."\n".
         "║ 3 ║ Mostrar un pasajero                 ║"."\n".
         "║ 4 ║ Eliminar un pasajero                ║"."\n".
         "║ 5 ║ Ver todos los pasajeros             ║"."\n".
         "╚═══╩═════════════════════════════════════╝"."\n".
         "╔════════════════╗                      ╔═╗"."\n".
         "║ Opción elegida ╠══════════════════════╣";$opcion = verificarEntero(trim(fgets(STDIN)));
    echo "╚════════════════╝                      ╚═╝"."\n";
    return $opcion;
}

/**
 * Este módulo muestra por pantalla el menú y retorna la opción elegida por el usuario
 * @return int 
 */
function menuModificarPasajero(){
    separador();
    echo "╔═════════════════════════════════════════╗"."\n".
         "║        Modificar datos Pasajeros        ║"."\n".
         "╚═════════════════════════════════════════╝"."\n".
         "╔═══╦═════════════════════════════════════╗"."\n".
         "║ 0 ║ Volver al menú anterior             ║"."\n".
         "║ 1 ║ Modificar nombre                    ║"."\n".
         "║ 2 ║ Modificar apellido                  ║"."\n".
         "║ 3 ║ Modificar teléfono                  ║"."\n".
         "║ 4 ║ Modificar documento                 ║"."\n".
         "╚═══╩═════════════════════════════════════╝"."\n".
         "╔════════════════╗                      ╔═╗"."\n".
         "║ Opción elegida ╠══════════════════════╣";$opcion = verificarEntero(trim(fgets(STDIN)));
    echo "╚════════════════╝                      ╚═╝"."\n";
    return $opcion;
}

/**
 * Este módulo muestra por pantalla el menú y retorna la opción elegida por el usuario
 * @return int 
 */
function menuResponsableV(){
    separador();
    echo "╔═════════════════════════════════════════╗"."\n".
         "║        Administrar Responsables         ║"."\n".
         "╚═════════════════════════════════════════╝"."\n".
         "╔═══╦═════════════════════════════════════╗"."\n".
         "║ 0 ║ Volver al menú anterior             ║"."\n".
         "║ 1 ║ Agregar responsable                 ║"."\n".
         "║ 2 ║ Modificar responsable               ║"."\n".
         "║ 3 ║ Mostrar responsable                 ║"."\n".
         "║ 4 ║ Eliminar responsable                ║"."\n".
         "║ 5 ║ Ver todos los responsables          ║"."\n".
         "╚═══╩═════════════════════════════════════╝"."\n".
         "╔════════════════╗                      ╔═╗"."\n".
         "║ Opción elegida ╠══════════════════════╣";$opcion = verificarEntero(trim(fgets(STDIN)));
    echo "╚════════════════╝                      ╚═╝"."\n";
    return $opcion;
}

/**
 * Este módulo muestra por pantalla el menú y retorna la opción elegida por el usuario
 * @return int 
 */
function menuModificarResponsable(){
    separador();
    echo "╔═════════════════════════════════════════╗"."\n".
         "║       Modificar datos Responsable       ║"."\n".
         "╚═════════════════════════════════════════╝"."\n".
         "╔═══╦═════════════════════════════════════╗"."\n".
         "║ 0 ║ Volver al menú anterior             ║"."\n".
         "║ 1 ║ Modificar nombre                    ║"."\n".
         "║ 2 ║ Modificar apellido                  ║"."\n".
         "║ 3 ║ Modificar número de empleado        ║"."\n".
         "║ 4 ║ Modificar número de licencia        ║"."\n".
         "╚═══╩═════════════════════════════════════╝"."\n".
         "╔════════════════╗                      ╔═╗"."\n".
         "║ Opción elegida ╠══════════════════════╣";$opcion = verificarEntero(trim(fgets(STDIN)));
    echo "╚════════════════╝                      ╚═╝"."\n";
    return $opcion;
}

/**********************************************************************************/
/*********************************** FUNCIONES ************************************/
/**********************************************************************************/

/**
 * Este módulo agrega una nueva empresa a la Base de Datos
 */
function agregarEmpresa(){
    echo "Ingrese el nombre de la nueva empresa: ";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese la dirección de la nueva empresa: ";
    $direccion = trim(fgets(STDIN));
    echo "\n";
    $objEmpresa = new Empresa();
    $objEmpresa->cargar(null, $nombre, $direccion);
    $resp = $objEmpresa->insertar();
    if($resp){
        separador();
        echo "La empresa se agregó exitosamente a la Base de Datos\n";
        separador();
    }else{
        separador();
        echo "No se pudo realizar el cambio:\n".$objEmpresa->getMensajeError()."\n";
        separador();
    }
}

/**
 * Este módulo cambia los datos del objEmpresa que entra por parámetro
 * @param object $objEmpresa
 */
function modificarEmpresa($objEmpresa){
    do{
        separador();
        $seleccion = menuModificarEmpresa();
        switch ($seleccion){
            case 0:
            break;
            case 1: 
                separador();
                echo "Ingrese el nuevo nombre para la empresa: "; 
                $nuevoNombre = trim(fgets(STDIN));
                $objEmpresa->setENombre($nuevoNombre);
                $resp = $objEmpresa->modificar();
                if($resp == true){
                    echo "El nombre de la empresa ha sido modificado\n";
                }else{
                    echo "No se pudo realizar el cambio:\n".$objEmpresa->getMensajeError()."\n";
                }
                separador();
            break;

            case 2: 
                separador();
                echo "Ingrese la nueva dirección: "; 
                $nuevaDireccion = trim(fgets(STDIN));
                $objEmpresa->setEDireccion($nuevaDireccion);
                $resp = $objEmpresa->modificar();
                if($resp == true){
                    echo "La dirección de la empresa ha sido modificada\n";
                }else{
                    echo "No se pudo realizar el cambio:\n".$objEmpresa->getMensajeError()."\n";
                }
                separador();
            break;

            default:
            echo "Elija una opción del 0 al 2\n\n";
            break;
                
        }
        }while($seleccion != 0);
}

/**
 * Este módulo solicita al usuario que elija una empresa existente en la base de datos, en caso de no existir
 * puede crear una nueva y luego retorna el objEmpresa seleccionado.
 * @return object
 */
function elegirEmpresa(){
    $objEmpresa = new Empresa();
    $stringEmpresa = empresasToString();
    $resp = true;
    do{
        if($resp){
            echo "Seleccione el id de la empresa solicitada, de no encontrarse, digite si para crear una nueva:\n".$stringEmpresa;
        }else{
            echo "El id de la empresa solicitada no existe o fue mal tipeado, por favor ingrese uno válido o digite si para crear una nueva:\n".$stringEmpresa;
        }
        $empresaElecta = trim(fgets(STDIN));
        if (is_numeric($empresaElecta)){
            $resp = $objEmpresa->buscar($empresaElecta);
        }elseif (strtolower($empresaElecta) == "si"){
            agregarEmpresa();
            $resp = $objEmpresa->buscar(count($objEmpresa->listar("")));
        }
    }while(!$resp);
    return $objEmpresa;
}

/**
 * Este módulo agrega un nuevo viaje a la Base de Datos
 */
function agregarViaje(){
    $objEmpresa = elegirEmpresa();
    $objResponsable = elegirResponsable();
    echo "Indique el destino del viaje: ";
    $destino = trim(fgets(STDIN));
    echo "Utilize un número para indicar si el viaje es de:\n 0 - Ida\n 1 - Ida y vuelta\n";
    $idaYVuelta = verificarIdaYVuelta(trim(fgets(STDIN)));
    if ($idaYVuelta == 0){
        $idaYVuelta = "Solo ida";
    }else{
        $idaYVuelta = "Ida y vuelta";
    }
    echo "Indique la capacidad máxima de personas que tiene el viaje: ";
    $capacidad = verificarEntero(trim(fgets(STDIN)));
    echo "Utilize un número para indicar el tipo de asiento del viaje:\n 0 - Clase económica\n 1 - Primera clase:\n";
    $tipoAsiento = verificarAsiento(trim(fgets(STDIN)));
    if ($tipoAsiento == 0){
        $tipoAsiento = "Clase económica";
    }else{
        $tipoAsiento = "Primera clase";
    }
    echo "Indique el importe del viaje: ";
    $importe = verificarEntero(trim(fgets(STDIN)));
    $objViaje = new Viaje();
    $objViaje->cargar(null, $destino, $capacidad, $objEmpresa, $objResponsable, $importe, $tipoAsiento, $idaYVuelta);
    if(verificarViajeRepetido($objViaje)){
        separador();
        echo "El viaje ya se encuentra cargado en la Base de Datos\n";
        separador();
    }else{
        $resp = $objViaje->insertar();
        if($resp){
            separador();
            echo "El viaje fue cargado exitosamente\n";
            separador();
        }else{
            separador();
            echo "No se pudo realizar el cambio:\n".$objViaje->getMensajeError();
            separador();
        }
    }    
}

/**
 * Este módulo modifica los datos del objViaje que entra por parámetro
 */
function modificarViaje($objViaje){
    do{
        separador();
        $seleccion = menuModificarViaje();
        switch ($seleccion){
            case 0:
            break;
            // CAMBIAR DESTINO
            case 1: 
                separador();
                echo "Ingrese el nuevo destino: ";
                $destino = trim(fgets(STDIN));
                $objViaje->setDestino($destino);
                $resp = $objViaje->modificar();
                if($resp){
                    echo "El destino ha sido modificado\n";
                }else{
                    echo "No se pudo realizar el cambio: ".$objViaje->getMensajeError()."\n";
                }
                separador();
            break;
            // CAMBIAR CAP MAX DE PASAJEROS
            case 2: 
                separador();
                echo "Ingrese la nueva capacidad máxima del viaje: ";
                $capMax = verificarEntero(trim(fgets(STDIN)));
                $objViaje->setCantMaxPasajeros($capMax);
                $resp = $objViaje->modificar();
                if($resp){
                    echo "La capacidad ha sido modificada\n";
                }else{
                    echo "No se pudo realizar el cambio: ".$objViaje->getMensajeError()."\n";
                }
                separador();
            break;
            // MODIFICAR IMPORTE ASIENTO(VIAJE)
            case 3: 
                separador();
                echo "Ingrese el nuevo importe de asiento del viaje: ";
                $importe = verificarEntero(trim(fgets(STDIN)));
                $objViaje->setImporte($importe);
                $resp = $objViaje->modificar();
                if($resp){
                    echo "El importe ha sido modificado\n";
                }else{
                    echo "No se pudo realizar el cambio: ".$objViaje->getMensajeError()."\n";
                }
                separador();
            break;
            // MODIFICAR TIPO DE ASIENTO(CLASE ECON, PRIM CLASE)
            case 4: 
                separador();
                echo "Indique el nuevo tipo de asiento del viaje:\n 0 - Clase económica\n 1 - Primera clase:\n";
                $tipoAsiento = verificarAsiento(trim(fgets(STDIN)));
                if ($tipoAsiento == 0){
                    $tipoAsiento = "Clase económica";
                }else{
                    $tipoAsiento = "Primera clase";
                }
                $objViaje->setTipoAsiento($tipoAsiento);
                $resp = $objViaje->modificar();
                if($resp){
                    echo "El tipo de asiento ha sido modificado\n";
                }else{
                    echo "No se pudo realizar el cambio: ".$objViaje->getMensajeError()."\n";
                }
                separador();
            break;
            // MODIFICAR TIPO DE VIAJE(IDA/VUELTA)
            case 5: 
                separador();
                echo "Indique si el viaje ahora es de:\n 0 - Ida\n 1 - Ida y vuelta\n";
                $tipoViaje = verificarIdaYVuelta(trim(fgets(STDIN)));
                if ($tipoViaje == 0){
                    $tipoViaje = "Solo ida";
                }else{
                    $tipoViaje = "Ida y vuelta";
                }
                $objViaje->setIdaYVuelta($tipoViaje);
                $resp = $objViaje->modificar();
                if($resp){
                    echo "El tipo de viaje ha sido modificado"."\n";
                }else{
                    echo "No se pudo realizar el cambio: ".$objViaje->getMensajeError()."\n";
                }
                separador();
            break;
            // MENSAJE PREDETERMINADO
            default:
            echo "El número ingresado no es válido, por favor ingrese un número del 0 al 5\n\n";
            break;  
        }
    }while($seleccion != 0);
}

/**
 * Este módulo permite elegir un objViaje de la BD y lo retorna. 
 * @return object
 */
function elegirViaje(){
    $objViaje = new Viaje();
    $stringViaje = viajesToString();
    $resp = true;
    do{
        if($resp){
            echo "Éstos son los viajes almacenados en la BD, cuál desea modificar?\n".$stringViaje;
        }else{
            echo "El id ingresado no existe o es incorrecto, por favor ingreselo nuevamente: "."\n".$stringViaje;
        }
        $viajeElecto = verificarEntero(trim(fgets(STDIN)));
        $resp = $objViaje->buscar($viajeElecto);
    }while(!$resp);
    return $objViaje;
}

/**
 * Este módulo selecciona un viaje para eliminarlo siempre que no tenga pasajeros cargados. 
 */
function eliminarViaje(){
    separador();
    $objViaje = elegirViaje();
    $objViaje->arrayObjPasajeros();
    if(count($objViaje->getColPasajeros()) == 0){
        $resp = $objViaje->eliminar();
        if($resp){
            echo "El viaje ha sido eliminado"."\n";
        }else{
            echo "No se ha encontrado ese viaje"."\n";
        }
    }else{
        separador();
        echo "El viaje no puede ser elminado ya que contiene pasajeros"."\n";
    }
    separador();
}

/**
 * Módulo que recibe por parametro la referencia a un viaje y agrega un pasajero a la base de datos si éste no existe en la misma.
 * En caso de existir ofrece, con la invocación de otro módulo, la oportunidad de cambiarlo de viaje.
 */
function agregarPasajero($objViaje){
    echo "Ingrese el documento del pasajero: ";
    $documento = verificarEntero(trim(fgets(STDIN)));
    echo "Ingrese el apellido del pasajero: ";
    $apellido = trim(fgets(STDIN));
    echo "Ingrese el nombre del pasajero: ";
    $nombre =  trim(fgets(STDIN));
    echo "Ingrese el télefono del pasajero: ";
    $telefono = verificarEntero(trim(fgets(STDIN)));
    $objPasajero = new Pasajero();
    $resp = $objPasajero->buscar($documento);
    if($resp){
        verificarPasajeroRepetido($objPasajero, $objViaje);
    }else{
        if($objViaje->asientosLibres()){
            $objPasajero->cargar($documento, $nombre, $apellido, $telefono, $objViaje);
            $resp = $objPasajero->insertar();
            if($resp){
                separador();
                echo "El pasajero ha sido agregado exitosamente a la BD\n";
            }else{
                separador();
                echo "No se han realizado cambios:\n".$objPasajero->getMensajeError()."\n";
            }
        }
    }

}

/**
 * Este módulo cambia datos del Pasajero
 * @param object $objPasajero
 */
function modificarPasajero($objPasajero){
    do{
        $seleccion = menuModificarPasajero();
        switch ($seleccion){
            //MENU ANTERIOR
            case 0:
            break;
            // MODIFICAR NOMBRE
            case 1: 
                separador();
                echo "Ingrese el nuevo nombre: "; 
                $nombre = trim(fgets(STDIN));
                $objPasajero->setNombre($nombre);
                $resp = $objPasajero->modificar();
                if($resp == true){
                    echo "El nombre ha sido modificado\n";
                }else{
                    echo "No se pudo realizar el cambio: ".$objPasajero->getMensajeError()."\n";
                }
                separador();
                break;
            // MODIFICAR APELLIDO
            case 2: 
                separador();
                echo "Ingrese el nuevo apellido: "; 
                $apellido = trim(fgets(STDIN));
                $objPasajero->setApellido($apellido);
                $resp = $objPasajero->modificar();
                if($resp == true){
                    echo "El apellido ha sido modificado\n";
                }else{
                    echo "No se pudo realizar el cambio: ".$objPasajero->getMensajeError()."\n";
                }
                separador();
                break;
            // MODIFICAR TELEFONO
            case 3: 
                separador();
                echo "Ingrese el nuevo teléfono: "; 
                $telefono = verificarEntero(trim(fgets(STDIN)));
                $objPasajero->setTelefono($telefono);
                $resp = $objPasajero->modificar();
                if($resp == true){
                    echo "El teléfono ha sido modificado\n";
                }else{
                    echo "No se pudo realizar el cambio: ".$objPasajero->getMensajeError()."\n";
                }
                separador();
            break;
            // MODIFICAR DOCUMENTO
            case 4: 
                separador();
                echo "Ingrese el nuevo documento: "; 
                $nuevoTelefono = trim(fgets(STDIN));
                $objPasajero->setTelefono($nuevoTelefono);
                $resp = $objPasajero->modificar();
                if($resp == true){
                    echo "El documento ha sido modificado\n";
                }else{
                    echo "No se pudo realizar el cambio: ".$objPasajero->getMensajeError()."\n";
                }
                separador();
            break;

            default:
            echo "El número que ingresó no es válido, por favor ingrese un número del 0 al 4\n\n";
            break;
                
        }
    }while($seleccion != 0);
}

/**
 * Este módulo solicita el documento del pasajero y si existe en la BD lo retorna, null caso contrario.
 * @return object
 */
function elegirPasajero(){
    echo "Ingrese el documento del pasajero que desea buscar: ";
    $documento = trim(fgets(STDIN));
    $objPasajero = new Pasajero();
    $resp = $objPasajero->buscar($documento);
    if(!$resp){
        echo "El pasajero ingresado no existe en la BD\n";
        $objPasajero = null;
    }
    return $objPasajero;
}
/**
 * Este módulo elimina un pasajero de la base de datos
 */
function eliminarPasajero(){
    echo "Ingrese el documento del pasajero que desea eliminar: ";
            $documento = verificarEntero(trim(fgets(STDIN)));
            $objPasajero = new Pasajero();
            $resp = $objPasajero->buscar($documento);
            if($resp){
                $resp = $objPasajero->eliminar($documento);
                if($resp){
                    echo "El pasajero ha sido eliminado"."\n";
                }else{
                    echo "No se pudo realizar el cambio:\n".$objPasajero->getMensajeError()."\n";
                }
            }else{
                echo "El pasajero no esta cargado en la BD\n";
            }
}

/**
 * Agrega un nuevo responsableV a la Base de Datos
 */
function agregarResponsable(){
    separador();
    echo "Ingrese el número de licencia del nuevo responsable: ";
    $numeroLicencia =  verificarEntero(trim(fgets(STDIN)));
    echo "Ingrese el apellido del nuevo responsable: ";
    $apellido =  trim(fgets(STDIN));
    echo "Ingrese el nombre del nuevo responsable: ";
    $nombre =  trim(fgets(STDIN));
    separador();
    $objResponsable = new ResponsableV();
    $objResponsable->cargar($nombre, $apellido, $numeroLicencia, null);
    $resp = $objResponsable->insertar();
    if($resp){
        separador();
        echo "El nuevo responsable ha sido correctamente agregado a la Base de Datos\n";
        separador();
    }else{
        separador();
        echo "No se pudo realizar el cambio:\n".$objResponsable->getMensajeError()."\n";
        separador();
    }
}

/**
 * Este módulo cambia datos del Responsable
 * @param object $objResponsable
 */
function modificarResponsable($objResponsable){
    do{
        $seleccion = menuModificarResponsable();
        switch ($seleccion){
            //MENU ANTERIOR
            case 0:
            break;
            // MODIFICAR NOMBRE
            case 1: 
                separador();
                echo "Ingrese el nuevo nombre: "; 
                $nombre = trim(fgets(STDIN));
                $objResponsable->setNombre($nombre);
                $resp = $objResponsable->modificar();
                if($resp == true){
                    echo "El nombre ha sido modificado\n";
                }else{
                    echo "No se pudo realizar el cambio:\n".$objResponsable->getMensajeError()."\n";
                }
                separador();
                break;
            // MODIFICAR APELLIDO
            case 2: 
                separador();
                echo "Ingrese el nuevo apellido: "; 
                $apellido = trim(fgets(STDIN));
                $objResponsable->setApellido($apellido);
                $resp = $objResponsable->modificar();
                if($resp == true){
                    echo "El apellido ha sido modificado\n";
                }else{
                    echo "No se pudo realizar el cambio:\n".$objResponsable->getMensajeError()."\n";
                }
                separador();
                break;
            // MODIFICAR NUMERO LICENCIA
            case 3: 
                separador();
                echo "Ingrese el nuevo número de licencia: "; 
                $numeroLicencia = verificarEntero(trim(fgets(STDIN)));
                $objResponsable->setNumeroLicencia($numeroLicencia);
                $resp = $objResponsable->modificar();
                if($resp == true){
                    echo "El número de licencia ha sido modificado\n";
                }else{
                    echo "No se pudo realizar el cambio:\n".$objResponsable->getMensajeError()."\n";
                }
                separador();
            break;
            // MODIFICAR NUMERO EMPLEADO
            case 4: 
                separador();
                echo "Ingrese el nuevo número de empleado: "; 
                $numeroEmpleado = trim(fgets(STDIN));
                $objResponsable->setTelefono($numeroEmpleado);
                $resp = $objResponsable->modificar();
                if($resp == true){
                    echo "El número de empleado ha sido modificado\n";
                }else{
                    echo "No se pudo realizar el cambio:\n".$objResponsable->getMensajeError()."\n";
                }
                separador();
            break;

            default:
                echo "El número que ingresó no es válido, por favor ingrese un número del 0 al 4\n\n";
            break;
                
        }
    }while($seleccion != 0);
}

/**
 * Este módulo permite elegir un objResponsable y de no encontrarse, da la opción de crear uno nuevo y lo retorna. 
 * @return object
 */
function elegirResponsable(){
    $objResponsable = new ResponsableV();
    $stringResponsable = responsablesToString();
    $resp = true;
    do{
        if($resp){
            echo "Seleccione el número de empleado del responsable solicitado, de no encontrarse, digite si para crear uno nuevo:\n".$stringResponsable;
        }else{
            echo "El número de empleado no existe o fue mal tipeado, por favor ingrese uno válido o digite si para crear uno:\n".$stringResponsable;
        }
        $responsableElecto = trim(fgets(STDIN));
        if (is_numeric($responsableElecto)){
            $resp = $objResponsable->buscar($responsableElecto);
        }elseif (strtolower($responsableElecto) == "si"){
            agregarResponsable();
            $resp = $objResponsable->buscar(count($objResponsable->listar("")));
        }
    }while(!$resp);
    return $objResponsable;
}

/**
 * Este módulo elimina un responsable de la base de datos
 */
function eliminarResponsable(){
    echo "Ingrese el número del empleado que desea eliminar: ";
            $numeroEmpleado = verificarEntero(trim(fgets(STDIN)));
            $objResponsable = new ResponsableV();
            $resp = $objResponsable->buscar($numeroEmpleado);
            if($resp){
                $resp = $objResponsable->eliminar($numeroEmpleado);
                if($resp){
                    echo "El responsable ha sido eliminado"."\n";
                }else{
                    echo "No se pudo realizar el cambio: ".$objResponsable->getMensajeError()."\n";
                }
            }else{
                echo "El responsable no está cargado en la BD\n";
            }
}


/**********************************************************************************/
/********************************* ARRAY TO STRING ********************************/
/**********************************************************************************/

/**
 * Devuelve una cadena de caracteres para ver los datos de la empresa
 * @return string
 */
function empresasToString(){
    $separador = "|\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\|";
    $stringEmpresa = $separador;
    $objEmpresa = new Empresa();
    $arrayObjEmpresa = $objEmpresa->listar("");
    if(count($arrayObjEmpresa) > 0){
        foreach($arrayObjEmpresa as $empresa){
            $stringEmpresa.= "\n".$empresa."\n".$separador."\n";
        }
    }
    return $stringEmpresa;
}

/**
 * Devuelve una cadena de caracteres para ver los datos del viaje
 * @return string
 */
function viajesToString(){
    $separador = "|************************************************|";                  
    $stringViaje = $separador;
    $objViaje = new Viaje();
    $arrayObjViaje = $objViaje->listar("");
    if(count($arrayObjViaje) > 0){
        foreach($arrayObjViaje as $viaje){
            $viaje->arrayObjPasajeros();
            $stringViaje.= "\n".$viaje."\n".$separador."\n";
        }
    }
    return $stringViaje;
}

/**
 * Devuelve una cadena de caracteres para ver los datos del viaje
 * @return string
 */
function pasajerosToString(){
    $separador = "|************************************************|";
    $stringPasajero = $separador;
    $objPasajero = new Pasajero();
    $colPasajeros = $objPasajero->listar("");
    if(count($colPasajeros) > 0){
        foreach($colPasajeros as $pasajero){
            $stringPasajero.= "\n".$pasajero."\n".$separador."\n";
        }
    }
    return $stringPasajero;
}

/**
 * Devuelve una cadena de caracteres para ver los datos del responsable
 * @return string
 */
function responsablesToString(){
    $separador = "|************************************************|";
    $stringResponsable = $separador;
    $objResponsable = new ResponsableV();
    $arrayObjResponsable = $objResponsable->listar("");
    if(count($arrayObjResponsable) > 0){
        foreach($arrayObjResponsable as $responsable){
            $stringResponsable.= "\n".$responsable."\n".$separador."\n";
        }
    }
    return $stringResponsable;
}

/**********************************************************************************/
/********************************** VERIFICADORES *********************************/
/**********************************************************************************/

/**
 * Verifica que el valor ingreasado sea un número
 * @param mixed $valor
 * @return int
 */
function verificarEntero($valor){
    while(is_numeric($valor) == false){
        echo "El valor ".$valor." no es correcto, por favor ingrese números unicamente\n";
        echo "Opción elegida: ";
        $valor = trim(fgets(STDIN));
    }
    return $valor;
}

/**
 * Verifica que el valor ingreasado sea 0 o 1
 * @param int $dato
 * @return int
 */
function verificarAsiento($dato){
    $valor = verificarEntero($dato);
    while(($valor < 0) || ($valor > 1)){
        echo "Los valores permitidos son 0 o 1\n 0: Clase económica \n 1: Primera clase\n";
        echo "Opción elegida: ";
        $valor = trim(fgets(STDIN));
    }
    return $valor;
}
/**
 * Verifica que el valor ingreasado sea 0 o 1
 * @param int $dato
 * @return string
 */
function verificarIdaYVuelta($dato){
    $valor = verificarEntero($dato);
    while(($valor < 0) || ($valor > 1)){
        echo "Los valores permitidos son 0 o 1\n 0: Ida\n 1: Ida y vuelta\n";
        echo "Opción elegida: ";
        $valor = trim(fgets(STDIN));
    }
    return $valor;
}

/**
 * Este módulo verifica que no exista en la Base de Datos, el objViaje que entra por parámetro y retorna true si existe,
 * false caso contrario.
 */
function verificarViajeRepetido($viaje){
    $objViaje = new Viaje();
    $colViajes = $objViaje->listar("");
    $i = 0;
    $viajeRepetido = false;
    while(!$viajeRepetido && ($i < count($colViajes))){
        if(strtolower($colViajes[$i]->getImporte()) == strtolower($viaje->getImporte()) &&
           strtolower($colViajes[$i]->getDestino()) == strtolower($viaje->getDestino()) &&
           strtolower($colViajes[$i]->getIdaYVuelta()) == strtolower($viaje->getIdaYVuelta()) &&
           strtolower($colViajes[$i]->getObjEmpresa()) == strtolower($viaje->getObjEmpresa()) &&
           strtolower($colViajes[$i]->getTipoAsiento()) == strtolower($viaje->getTipoAsiento()) &&
           strtolower($colViajes[$i]->getObjResponsableV()) == strtolower($viaje->getObjResponsableV()) &&
           strtolower($colViajes[$i]->getCantMaxPasajeros()) == strtolower($viaje->getCantMaxPasajeros())){
            $viajeRepetido = true;
        }else{
            $i++;
        }
    }
    return $viajeRepetido;
}

/**
 * Este módulo recibe por parámetro un pasajero existente en la base de datos y un objViaje, ofrece el intercambio de viaje
 * y de no concretarse, no realiza cambios en la base de datos
 * @param object $objPasajero
 * @param object $objViaje
 */
function verificarPasajeroRepetido($objPasajero, $objViaje){
    echo "Ese pasajero ya fue cargado, quiere moverlo del viaje N° ".$objPasajero->getObjViaje()->getIdViaje().
         " al viaje N° ".$objViaje->getIdViaje()."?\n"."Si/No\n";
    $siNo = strtolower(trim(fgets(STDIN)));
    while(($siNo <> "si") && ($siNo <> "no")){
        echo "Solo se acepta como respuesta si o no, intente nuevamente:\n";
        $siNo = strtolower(trim(fgets(STDIN)));
    }
    if($siNo == "si"){
        $objPasajero->setObjViaje($objViaje);
        $objPasajero->modificar();
        separador();
        echo "El cambio de viaje se ha realizado correctamente\n";
    }else{
        separador();
        echo "El pasajero no ha sido movido y no se ha cargado otro pasejero al viaje\n";
    }
}

/**********************************************************************************/
/******************************* PROGRAMA PRINCIPAL *******************************/
/**********************************************************************************/

do{
    // MENU PRINCIPAL
    $menu = menuPrincipal();
    separador();
    switch ($menu){
        case 0:
            exit();
        break;
        // MENU EMPRESAS    
        case 1:
            do{
                separador();
                $opcion = menuEmpresas();
                switch($opcion){
                    // MENU ANTERIOR
                    case 0:
                    break;
                    // AGREGAR UNA EMPRESA 
                    case 1:
                        separador();
                        echo "Cuántas empresas desea agregar?\n";
                        $viajes = verificarEntero(trim(fgets(STDIN)));
                        for ($i=0; $i < $viajes; $i++){
                            agregarEmpresa();
                        }
                        separador();
                    break;
                    // MODIFICAR UNA EMPRESA
                    case 2:
                        separador();
                        $objEmpresa = elegirEmpresa();
                        modificarEmpresa($objEmpresa);
                        separador();
                    break;
                    // MOSTRAR TODAS LAS EMPRESAS
                    case 3:
                        separador();
                        echo empresasToString(); 
                        separador();
                    break;
                    // MENSAJE PREDETERMINADO
                    default:
                        echo "Debe introducir un número entre el 0 y el 3"."\n";
                    break;
                }
            }while($opcion <> 0);
        break;
        // MENU VIAJES
        case 2:
            do{
                separador();
                $opcion = menuViajes();
                switch($opcion){
                    // MENU ANTERIOR
                    case 0:
                    break;
                    // AGREGAR VIAJES
                    case 1:
                        separador();
                        echo "Cuántos viajes desea agregar?\n";
                        $viajes = verificarEntero(trim(fgets(STDIN)));
                        for ($i=0; $i < $viajes; $i++){
                            agregarViaje();
                        }
                        separador();
                    break;
                    // MODIFICAR VIAJE
                    case 2:
                        separador();
                        $objViaje = elegirViaje();
                        modificarViaje($objViaje);
                        separador();
                    break;
                    // ELIMINAR VIAJE
                    case 3:
                        separador();
                        eliminarViaje();
                        separador();
                    break;
                    // VER TODOS LOS VIAJES
                    case 4:
                        separador();
                        echo viajesToString();
                        separador();
                    break;
                    // MENSAJE PREDETERMINADO
                    default:
                        echo "Debe introducir un número entre el 0 y el 4"."\n";
                    break;
                }
            }while($opcion <> 0);
        break;
        // MENU PASAJEROS
        case 3:
            do{
                separador();
                $opcion = menuPasajeros();
                switch($opcion){
                    // MENU ANTERIOR
                    case 0:
                    break;
                    // AGREGAR PASAJEROS
                    case 1:
                        separador();
                        $objViaje = elegirViaje();
                        echo "Cuántos pasajeros desea agregar?\n";
                        $pasajeros = verificarEntero(trim(fgets(STDIN)));
                        for ($i=0; $i < $pasajeros; $i++){
                            agregarPasajero($objViaje);
                        }
                        separador();
                    break;
                    // MODIFICAR PASAJERO
                    case 2:
                        separador();
                        echo "Ingrese el documento del pasajero a modificar: ";
                        $documento = verificarEntero(trim(fgets(STDIN)));
                        $objPasajero = new Pasajero();
                        $resp = $objPasajero->buscar($documento);
                        if($resp){
                            modificarPasajero($objPasajero);
                        }else{
                            echo "El pasajero no se encuentra cargado en la BD\n";
                        }
                        separador();
                    break;
                    // MOSTRAR PASAJERO
                    case 3:
                        separador();
                        echo elegirPasajero();
                        separador();
                    break;
                    // ELIMINAR PASAJERO
                    case 4:
                        separador();
                        eliminarPasajero();
                        separador();
                    break;
                    // VER PASAJEROS
                    case 5:
                        separador();
                        echo pasajerosToString();
                        separador();
                    break;
                    // MENSAJE PREDETERMINADO
                    default:
                        echo "Debe introducir un número entre el 0 y el 4"."\n";
                    break;
                }
            }while($opcion <> 0);
        break;
        // MENU RESPONSABLES  
        case 4:
            do{
                separador();
                $opcion = menuResponsableV();
                switch($opcion){
                    // MENU ANTERIOR
                    case 0:
                    break;
                    // AGREGAR RESPONSABLE
                    case 1:
                        separador();
                        echo "Cuántos responsables desea agregar?\n";
                        $viajes = verificarEntero(trim(fgets(STDIN)));
                        for ($i=0; $i < $viajes; $i++){
                            agregarResponsable();
                        }
                        separador();
                    break;
                    // MODIFICAR RESPONSABLE
                    case 2:
                        separador();
                        echo "Ingrese el número de empleado a modificar: ";
                        $numeroEmpleado = verificarEntero(trim(fgets(STDIN)));
                        $objResponsable = new ResponsableV();
                        $resp = $objResponsable->buscar($numeroEmpleado);
                        if($resp){
                            modificarResponsable($objResponsable);
                        }else{
                            echo "El responsable no se encuentra cargado en la BD\n";
                        }
                        separador();
                    break;
                    // MOSTRAR RESPONSABLE
                    case 3:
                        separador();
                        echo elegirResponsable();
                        separador();
                    break;
                    // ELIMINAR RESPONSABLE
                    case 4:
                        separador();
                        eliminarResponsable();
                        separador();
                    break;
                    // VER TODOS LOS RESPONSABLES
                    case 5:
                        separador();
                        echo responsablesToString();
                        separador();
                    break;
                    // MENSAJE PREDETERMINADO
                    default:
                        separador();
                        echo "Debe introducir un número entre el 0 y el 5"."\n";
                    break;
                }
            }while($opcion != 0);
        break;
        // MENSAJE PREDETERMINADO
        default:
            separador();
            echo "Debe introducir un número entre el 0 y el 4"."\n";
        break;
    }
}while ($menu <> 0);
?>