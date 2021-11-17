<?php
include_once("tateti.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* ... COMPLETAR ... */

/**
 * Vera Alan Cristian Gaston
 *      Legajo FAI - 2622
 *      Mail: cryssal220799@gmail.com
 *      Usuario GitHub: veraAlan
 */

/**
 * Acosta Demian Aaron
 *      Legajo FAI - 2592
 *      Mail Personal: acostademiann14@gmail.com
 *      Usuario GitHub: acostaDemianAaron
 */

/**
 * Yaitul Santiago Alejo
 *      Legajo FAI - 2339
 *      Mail Personal: santiago.yaitul@gmail.com
 *      Usuario GitHub: SantiagoYaitul
 */


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

function menu()
{
    echo "\t\t\n◢ ======================================================◣\n";
    time_nanosleep(0, 125000000);
    echo "‖1) Jugar al tateti\t\t\t\t\t‖\n";
    time_nanosleep(0, 125000000);
    echo "‖2) Mostrar un juego\t\t\t\t\t‖\n";
    time_nanosleep(0, 125000000);
    echo "‖3) Mostrar el primer juego ganador\t\t\t‖\n";
    time_nanosleep(0, 125000000);
    echo "‖4) Mostrar porcentaje de Juegos ganados\t\t‖\n";
    time_nanosleep(0, 125000000);
    echo "‖5) Mostrar resumen de Jugador\t\t\t\t‖\n";
    time_nanosleep(0, 125000000);
    echo "‖6) Mostrar listado de juegos Ordenado por jugador O\t‖\n";
    time_nanosleep(0, 125000000);
    echo "‖7) Salir\t\t\t\t\t\t‖\n";
    time_nanosleep(0, 125000000);
    echo "◥ ======================================================◤\n\n";
}

function opcionValida($opValida)
{
    $numeroValido = false;
    $opEvaluar = $opValida;
    do {
        if ($opEvaluar < 8 && $opEvaluar > 0) {
            $numeroValido = true;
            sleep(1);
        } else {
            echo "La opcion seleccionada no existe porfavor ingresar un valor dentro del rango 1-7\n";
            $opEvaluar = trim(fgets(STDIN));
        }
    } while ($numeroValido == false);
    return $opEvaluar;
}

function mostrarJuego($coleccion)
{
    $bandera = true;
    do {
        echo "Que numero de juego quiere ver: ";
        $numeroJuego = trim(fgets(STDIN));
        if ($numeroJuego > 0 && $numeroJuego <= count($coleccion)) {
            $puntosX = $coleccion[$numeroJuego - 1]["puntosCruz"];
            $puntosO = $coleccion[$numeroJuego - 1]["puntosCirculo"];
            $nombreX = $coleccion[$numeroJuego - 1]["jugadorCruz"];
            $nombreO = $coleccion[$numeroJuego - 1]["jugadorCirculo"];

            echo "\n◿\n";
            echo "‖ Juego TATETI: " . $numeroJuego . " ";
            if ($puntosX > $puntosO) {
                echo "(gano X)\n";
            } elseif ($puntosX < $puntosO) {
                echo "(gano O)\n";
            } else {
                echo "(empate)\n";
            }

            echo "‖ Jugador Cruz: " . $nombreX . " obtuvo " . $puntosX . " puntos.\n";
            echo "‖ Jugador Circulo: " . $nombreO . " obtuvo " . $puntosO . " puntos.\n";
            echo "◹\n";
            $bandera = false;
        } else {
            echo "No es un número de juego válido.\n";
            $bandera = true;
        }
    } while ($bandera);
}





/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:

$i = 0;
$juegos = null;

//Proceso:

do {
    menu();
    echo "Seleccione una opcion del menu: ";
    $opcion = trim(fgets(STDIN));

    $seleccion = opcionValida($opcion);

    switch ($seleccion) {

        case 1:
            echo "\n\n\t◢=================◣\n";
            echo "\t‖ Jugar al Tateti ‖\n";
            echo "\t◥=================◤\n\n";
            sleep(1);
            $juegos[$i] = jugar();
            imprimirResultado($juegos[$i]);

            $i++;
            sleep(2.5);
            break;

        case 2:
            if($juegos != null){
                echo "\n\t◢ ======================◣\n";
                echo "\t‖   Mostrar un juego.   ‖\n";
                echo "\t◥ ======================◤\n\n";
                mostrarJuego($juegos);
    
                sleep(2.5);
            } else {
                echo "\nOpción inválida: No se ha realizado ningún juego aún.\n";
                sleep(2.5);
            }
            break;
        case 3:

            break;
        case 4:

            break;
        case 5:

            break;
        case 6:

            break;
        case 7:
            echo chr(27).chr(91).'H'.chr(27).chr(91).'J'; 
            echo "\n◢ =================================◣";
            echo "\n‖ Gracias por jugar a Tres en Raya ‖";
            echo "\n◥ =================================◤\n";
            break;
    }
} while ($seleccion != 7);



 

//TODO Se puede borrar todo esto que esta abajo? Digo, sólo para no molestar con comentarios innecesarios.

//print_r($juego);
//imprimirResultado($juego);



/*
do {
    $opcion = ...;

    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != X);
*/
