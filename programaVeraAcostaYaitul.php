<?php
include_once("tateti.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

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

/**
 * Función que muestra por pantalla el menu y no tiene retorno.
 */
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

/**
 * Comprueba si la opción elegida esta dentro de las opciones válidas del menú.
 * @param int $opcionElegida;
 * @return int
 */
function seleccionarOpcion($opcionElegida)
{
    //boolean $numeroValido, int $opValida
    $numeroValido = false;
    do {
        if ($opcionElegida < 8 && $opcionElegida > 0) {
            $numeroValido = true;
            $opValida = $opcionElegida;
        } else {
            echo "La opcion seleccionada no existe porfavor ingresar un partida dentro del rango 1-7\n";
            menu();
            echo "Seleccione una opcion del menu: ";
            $opcionElegida = trim(fgets(STDIN));
        }
    } while ($numeroValido == false);
    return $opValida;
}

/**
 * Pregunta al usuario que número de juego (indice) esta buscando y muestra resultados de dicho juego por pantalla.
 * Si el juego no existe muestra un cartel de error acorde.
 * @param array $coleccionJuegos;
 */
function mostrarJuego($coleccionJuegos)
{
    //int $numeroJuego, int $puntosX, int $puntosO, boolean $bandera, string $nombreX, $nombreO
    $bandera = true;
    do {
        echo "Que numero de juego quiere ver: ";
        $numeroJuego = trim(fgets(STDIN));
        if ($numeroJuego > 0 && $numeroJuego <= count($coleccionJuegos)) {
            $puntosX = $coleccionJuegos[$numeroJuego - 1]["puntosCruz"];
            $puntosO = $coleccionJuegos[$numeroJuego - 1]["puntosCirculo"];
            $nombreX = $coleccionJuegos[$numeroJuego - 1]["jugadorCruz"];
            $nombreO = $coleccionJuegos[$numeroJuego - 1]["jugadorCirculo"];

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

/**
 * Pregunta al usuario a qué jugador esta buscando. En la primera partida de juego que encuentra el nombre del jugador, 
 * lo muestra por pantalla y termina de ejecutarse.
 * @param array $coleccionJuegos;
 */
function buscarJugador($coleccionJuegos)
{
    //string $jugador, int $partida, array $partida
    echo "Ingrese el nombre el jugador deseado: ";
    $jugador = trim(fgets(STDIN));
    $jugador = strtoupper($jugador);

    foreach ($coleccionJuegos as &$partida) {
        if ($jugador == $partida["jugadorCruz"] && $partida["puntosCruz"] > 1) {
            echo "\n◿\n";
            echo "‖ Jugador Tateti: " . array_search($partida, $coleccionJuegos) + 1 . " (Gano X)\n";
            echo "‖ Jugador Cruz: " . $partida["jugadorCruz"] . " obtuvo " . $partida["puntosCruz"] . " puntos.\n";
            echo "‖ Jugador Circulo: " . $partida["jugadorCirculo"] . " obtuvo " . $partida["puntosCirculo"] . " puntos.\n";
            echo "◹\n";
            break;
        } elseif ($jugador == $partida["jugadorCirculo"] && $partida["puntosCirculo"] > 1) {
            echo "\n◿\n";
            echo "‖ Jugador Tateti: " . array_search($partida, $coleccionJuegos) + 1 . " (Gano O)\n";
            echo "‖ Jugador Circulo: " . $partida["jugadorCirculo"] . " obtuvo " . $partida["puntosCirculo"] . " puntos.\n";
            echo "‖ Jugador Cruz: " . $partida["jugadorCruz"] . " obtuvo " . $partida["puntosCruz"] . " puntos.\n";
            echo "◹\n";
            break;
        } elseif (array_search($partida, $coleccionJuegos) + 1 == count($coleccionJuegos)) {
            echo "El jugador ingresado " . $jugador . " no a ganado ningun juego.\n";
        }
    }
}

/**
 * Recompila la información dada en todos los juegos y le pide al usuario cual jugador (X o O) quiere conseguir información.
 * Encuentra los datos del jugador y muestra por pantalla el porcentaje de victorias de tal jugador.
 * @param array $colecciónJuegos
 */
function porcentajeDeVictorias($coleccionJuegos)
{
    //int $acumX, $acumO, $acumT, array $partida, string $simbolo, 
    $acumX = 0;
    $acumO = 0;

    foreach ($coleccionJuegos as &$partida) {
        if ($partida["puntosCruz"] > 1) {
            $acumX = $acumX + 1;
        } elseif ($partida["puntosCirculo"] > 1) {
            $acumO = $acumO + 1;
        }
    }

    echo "Eliga al JugadorCruz o al jugadorCirculo con 'X' o 'O': ";
    $simbolo = trim(fgets(STDIN));
    $simbolo = strtoupper($simbolo);
    do {
        if ($simbolo == "X") {
            $acumT = round((($acumX * 100) / ($acumX + $acumO)), 2);
            echo "\n◿";
            echo "\n‖ El lado cruz obtuvo " . $acumT . "% de victorias.";
            echo "\n◹\n";
            break;
        } elseif ($simbolo == "O") {
            $acumT = round((($acumO * 100) / ($acumX + $acumO)), 2);
            echo "\n◿";
            echo "\n‖ El lado circulo obtuvo " . $acumT . "% de victorias.";
            echo "\n◹\n";
            break;
        } else {
            do {
                echo "\nEl caracter ingresado no es correcto. Ingrese 'X' o 'O': ";
                $simbolo = trim(fgets(STDIN));
                $simbolo = strtoupper($simbolo);
            } while ($simbolo != "X" && $simbolo != "O");
        }
    } while (true);
}

/**
 * Muestra por pantalla un resumen solicitado por el usuario.
 * Muestra cantidad de partidas ganadas, perdidas, empatadas y puntos.
 * @param array $colecionJuegos;
 */
function resumenJugador($coleccionJuegos)
{
    //string $nombre, array $datosJugador, boolean $jugadorEncontrado;
    $jugadorEncontrado = false;

    echo "Ingrese el nombre del jugador el cual desee conocer su resumen de partidas: ";
    $nombre = trim(fgets(STDIN));
    $nombre = strtoupper($nombre);
    $datosJugador = ["nombre" => $nombre, "juegosGanados" => 0, "juegosPerdidos" => 0, "juegosEmpatados" => 0, "puntosAcumulados" => 0];

    foreach ($coleccionJuegos as &$partida) {
        if ($nombre == $partida["jugadorCruz"]) {
            if ($partida["puntosCruz"] == 1) {
                $datosJugador["juegosEmpatados"]++;
                $datosJugador["puntosAcumulados"]++;
            } else {
                if ($partida["puntosCruz"] > 1) {
                    $datosJugador["juegosGanados"]++;
                    $datosJugador["puntosAcumulados"] += $partida["puntosCruz"];
                } else {
                    $datosJugador["juegosPerdidos"]++;
                }
            }
            $jugadorEncontrado = true;
        } elseif ($nombre == $partida["jugadorCirculo"]) {
            if ($partida["puntosCirculo"] == 1) {
                $datosJugador["juegosEmpatados"]++;
                $datosJugador["puntosAcumulados"]++;
            } else {
                if ($partida["puntosCirculo"] > 1) {
                    $datosJugador["juegosGanados"]++;
                    $datosJugador["puntosAcumulados"] += $partida["puntosCirculo"];
                } else {
                    $datosJugador["juegosPerdidos"]++;
                }
            }
            $jugadorEncontrado = true;
        } elseif (count($coleccionJuegos) == (array_search($partida, $coleccionJuegos) + 1)) {
            if ($jugadorEncontrado) {
                echo "\n◿\n‖ Jugador: " . strtoupper($datosJugador["nombre"]) .
                    "\n‖ Ganó: " . $datosJugador["juegosGanados"] . " juegos." .
                    "\n‖ Perdio: " . $datosJugador["juegosPerdidos"] . " juegos." .
                    "\n‖ Empato: " . $datosJugador["juegosEmpatados"] . " Juegos." .
                    "\n‖ Total de puntos acumulados " . $datosJugador["puntosAcumulados"] . " Puntos.\n◹\n";
            } else {
                echo "\nEl nombre ingresado no se encuentra en alguna partida.\n";
            }
        }
    }
}

/**
 * Comparador de los nombres dentro de dos arrays.
 * Devuelve 1 si el primer string es lexicograficamente menor al segundo.
 * Devuelve 0 si ambos strings son iguales.
 * Devuelve -1 si el primer string es mayor al segundo.
 * @param array $partidaA, $partidaB;
 * @return int;
 */
function comparador($partidaA, $partidaB)
{
    return strcmp($partidaA["jugadorCirculo"], $partidaB["jugadorCirculo"]);
}

/**
 * Ordena la colección de juegos alfabéticamente según el nombre del jugador O en cada partida jugada.
 * @param array $coleccionJuegos;
 */
function jugadoresOrdenados($coleccionJuegos)
{
    //array $partida
    uasort($coleccionJuegos, "comparador");
    foreach ($coleccionJuegos as &$partida) {
        time_nanosleep(0, 200000000);

        echo "◢ ===============================◣\n";
        print_r($partida);
        echo "◥ ===============================◤\n";
    }
}

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:

/**
 * int $i;
 * array $juegos;
 * string $opcion, $seleccion;
 */

//Inicialización de variables:

$i = 0;
$juegos =
    [
        ["jugadorCruz" => "AARON", "jugadorCirculo" => "MATEO", "puntosCruz" => 6, "puntosCirculo" => 0],
        ["jugadorCruz" => "SANTI", "jugadorCirculo" => "ALAN", "puntosCruz" => 1, "puntosCirculo" => 1],
        ["jugadorCruz" => "SANTI", "jugadorCirculo" => "ALAN", "puntosCruz" => 5, "puntosCirculo" => 0],
        ["jugadorCruz" => "MATEO", "jugadorCirculo" => "AARON", "puntosCruz" => 6, "puntosCirculo" => 0],
        ["jugadorCruz" => "MAJO", "jugadorCirculo" => "DAVID", "puntosCruz" => 0, "puntosCirculo" => 6],
        ["jugadorCruz" => "AARON", "jugadorCirculo" => "MATEO", "puntosCruz" => 3, "puntosCirculo" => 0],
        ["jugadorCruz" => "KARINA", "jugadorCirculo" => "SANDRA", "puntosCruz" => 0, "puntosCirculo" => 6],
        ["jugadorCruz" => "JOSEPE", "jugadorCirculo" => "GRILLO", "puntosCruz" => 1, "puntosCirculo" => 1],
        ["jugadorCruz" => "CRISTIAN", "jugadorCirculo" => "GASTON", "puntosCruz" => 4, "puntosCirculo" => 0],
        ["jugadorCruz" => "PEPE", "jugadorCirculo" => "CRISTIAN", "puntosCruz" => 6, "puntosCirculo" => 0]
    ];

//Proceso:

//DO WHILE para seguir ejecutando el programa mientras no se elija la opción 7.
do {
    menu();
    echo "Seleccione una opcion del menu: ";
    $opcion = trim(fgets(STDIN));
    $opcion = seleccionarOpcion($opcion);
    //Uso de switch para llamar al módulo adecuado en las opciones 1 a 6, mostrar un cartel de despedida en la opción 7.
    switch ($opcion) {
        case 1:
            echo "\n\n\t◢=================◣\n";
            echo "\t‖ Jugar al Tateti ‖\n";
            echo "\t◥=================◤\n\n";
            sleep(1);
            $juegos[$i] = jugar();
            imprimirResultado($juegos[$i])  ;
            $i++;
            sleep(2);
            break;
        case 2:
            echo "\n\t◢ ======================◣\n";
            echo "\t‖   Mostrar un juego.   ‖\n";
            echo "\t◥ ======================◤\n\n";
            sleep(2);
            mostrarJuego($juegos);
            sleep(2);
            break;
        case 3:
            echo "\n\t◢ =====================================◣\n";
            echo "\t‖   Mostrar el primer juego ganador.   ‖\n";
            echo "\t◥ =====================================◤\n\n";
            sleep(2);
            buscarJugador($juegos);
            break;
        case 4:
            echo "\n\t◢ ==========================================◣\n";
            echo "\t‖   Mostrar porcentaje de Juegos ganados.   ‖\n";
            echo "\t◥ ==========================================◤\n\n";
            sleep(2);
            porcentajeDeVictorias($juegos);
            break;
        case 5:
            echo "\n\t◢ ===============================◣\n";
            echo "\t‖   Mostrar resumen de Jugador   ‖\n";
            echo "\t◥ ===============================◤\n\n";
            sleep(2);
            resumenJugador($juegos);
            break;
        case 6:
            echo "\n\t◢ =====================================================◣\n";
            echo "\t‖   Mostrar listado de juegos Ordenado por jugador O   ‖\n";
            echo "\t◥ =====================================================◤\n\n";
            sleep(2);
            jugadoresOrdenados($juegos);
            break;
        case 7:
            echo chr(27) . chr(91) . 'H' . chr(27) . chr(91) . 'J';
            echo "\n◢ ===========================◣";
            echo "\n‖ Gracias por jugar a Tateti ‖";
            echo "\n◥ ===========================◤\n";
            break;
    }
} while ($opcion != 7);