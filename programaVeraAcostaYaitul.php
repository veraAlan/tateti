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

function buscarJugador($coleccionJuegos)
{
    echo "Ingrese el nombre el jugador deseado: ";
    $jugador = trim(fgets(STDIN));
    $jugador = strtoupper($jugador);


    foreach ($coleccionJuegos as $dato => $valor) {
        if ($jugador == strtoupper($valor["jugadorCruz"]) && $valor["puntosCruz"] > 1) {
            echo "\n◿\n";
            echo "‖ Jugador Tateti: " . array_search($valor, $coleccionJuegos) + 1 . " (Gano X)\n";
            echo "‖ Jugador Cruz: " . $valor["jugadorCruz"] . " obtuvo " . $valor["puntosCruz"] . " puntos.\n";
            echo "‖ Jugador Circulo: " . $valor["jugadorCirculo"] . " obtuvo " . $valor["puntosCirculo"] . " puntos.\n";
            echo "◹\n";
            break;
        } elseif ($jugador == strtoupper($valor["jugadorCirculo"]) && $valor["puntosCirculo"] > 1) {
            echo "\n◿\n";
            echo "‖ Jugador Tateti: " . array_search($valor, $coleccionJuegos) + 1 . " (Gano O)\n";
            echo "‖ Jugador Circulo: " . $valor["jugadorCirculo"] . " obtuvo " . $valor["puntosCirculo"] . " puntos.\n";
            echo "‖ Jugador Cruz: " . $valor["jugadorCruz"] . " obtuvo " . $valor["puntosCruz"] . " puntos.\n";
            echo "◹\n";
            break;
        } elseif (array_search($valor, $coleccionJuegos) + 1 == count($coleccionJuegos)) {
            echo "El jugador ingresado " . $jugador . " no a ganado ningun juego.\n";
        }
    }
}


function porcentajeDeVictorias($recopilacionJuegos)
{
    $acumX = 0;
    $acumV = 0;
    $acumO = 0;

    foreach ($recopilacionJuegos as $i => $info) {
        if ($info["puntosCruz"] > 1) {
            $acumX = $acumX + 1;
        } elseif ($info["puntosCirculo"] > 1) {
            $acumO = $acumO + 1;
        }
    }


    echo "Eliga al JugadorCruz o al jugadorCirculo con 'X' o 'O'";
    $simbolo = trim(fgets(STDIN));
    $simbolo = strtoupper($simbolo);
    do {

        if ($simbolo == "X") {
            $acumT = round((($acumX * 100) / ($acumX + $acumO)), 2);
            echo "El jugadorCruz gano " . $acumT . " % de los juegos ganados";
            break;
        } elseif ($simbolo == "O") {
            $acumT = round((($acumO * 100) / ($acumX + $acumO)), 2);
            echo "El jugadorCirculo gano " . $acumT . " % de los juegos ganados";
            break;
        } else {
            do {
                echo "El caracter ingresado no es correcto. Ingrese 'X' o 'O': ";
                $simbolo = trim(fgets(STDIN));
                $simbolo = strtoupper($simbolo);
            } while ($simbolo != "X" && $simbolo != "O");
        }
    } while (true);
}

function resumenJugador($datosJuegos){
    $gano = 0;
    $puntos = 0;
    $empato = 0;
    $perdio = 0;
    echo "Ingrese el nombre del jugador el cual desee conocer su resumen de partidas \n";
    $nombre = trim(fgets(STDIN));
    $nombre = strtolower($nombre);
    foreach ($datosJuegos as $posicion => $archivo){
        if ($nombre == $archivo["jugadorCruz"]){
            if ($archivo["puntosCruz"] > 1){
                $gano = $gano + 1;
                $puntos = $puntos + $archivo["puntosCruz"];
            } elseif($archivo["puntosCruz"] == 0){
                $perdio = $perdio + 1;
            } elseif ($archivo["puntosCruz"] == 1){
                $empato = $empato + 1;
                $puntos = $puntos + 1;
            }
        } elseif ($nombre == $archivo ["jugadorCirculo"]){
                if($archivo["puntosCirculo"] > 1) {
                    $gano = $gano + 1;
                    $puntos = $puntos + $archivo["puntosCirculo"];
                }elseif ($archivo["puntosCirculo"] == 0){
                    $perdio = $perdio + 1;
                }elseif ($archivo["puntosCirculo"] == 1){
                    $empato = $empato + 1;
                    $puntos = $puntos + 1;
                }
            } else 
            echo " El nombre ingresado no se encuentra en alguna partida \n";
    }

    echo " 
    Jugador: " . $nombre .
    " Ganò: " . $gano . " juegos " . 
    " Perdio: " . $perdio . " juegos " .
    " Empato: " . $empato . " Juegos " .
    " Total de puntos acumulados " . $puntos . " Puntos";
}



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:

$i = 0;
$juegos = array(
    array("jugadorCruz" => "Aaron", "jugadorCirculo" => "Mateo", "puntosCruz" => 6, "puntosCirculo" => 0),
    array("jugadorCruz" => "Santi", "jugadorCirculo" => "Alan", "puntosCruz" => 1, "puntosCirculo" => 1),
    array("jugadorCruz" => "Santi", "jugadorCirculo" => "Alan", "puntosCruz" => 5, "puntosCirculo" => 0),
    array("jugadorCruz" => "Mateo", "jugadorCirculo" => "Aaron", "puntosCruz" => 6, "puntosCirculo" => 0),
    array("jugadorCruz" => "Majo", "jugadorCirculo" => "David", "puntosCruz" => 0, "puntosCirculo" => 6),
    array("jugadorCruz" => "Aaron", "jugadorCirculo" => "Mateo", "puntosCruz" => 3, "puntosCirculo" => 0),
    array("jugadorCruz" => "Karina", "jugadorCirculo" => "Sandra", "puntosCruz" => 0, "puntosCirculo" => 6),
    array("jugadorCruz" => "Josepe", "jugadorCirculo" => "Grillo", "puntosCruz" => 1, "puntosCirculo" => 1),
    array("jugadorCruz" => "Cristian", "jugadorCirculo" => "Gaston", "puntosCruz" => 4, "puntosCirculo" => 0),
    array("jugadorCruz" => "Pepe", "jugadorCirculo" => "Cristian", "puntosCruz" => 6, "puntosCirculo" => 0)
);

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
            if ($juegos != null) {
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
            echo "\n\t◢ =====================================◣\n";
            echo "\t‖   Mostrar el primer juego ganador.   ‖\n";
            echo "\t◥ =====================================◤\n\n";
            buscarJugador($juegos);
            break;
        case 4:

            echo "\n\t◢ ==========================================◣\n";
            echo "\t‖   Mostrar porcentaje de Juegos ganados.   ‖\n";
            echo "\t◥ ==========================================◤\n\n";
            if (gettype($juegos) != "NULL") {
                porcentajeDeVictorias($juegos);
            } else {
                echo "No existen partidad para mostrar el porcentaje.\n";
            }
            break;
        case 5:
            echo "\n\t◢ ===============================◣\n";
            echo "\t‖   Mostrar resumen de Jugador   ‖\n";
            echo "\t◥ ===============================◤\n\n";

            resumenJugador($juegos);

            break;
        case 6:

            break;
        case 7:
            echo chr(27) . chr(91) . 'H' . chr(27) . chr(91) . 'J';
            echo "\n◢ ===========================◣";
            echo "\n‖ Gracias por jugar a Tateti ‖";
            echo "\n◥ ===========================◤\n";
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
