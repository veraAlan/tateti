<?php
include_once("tateti.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/**     Vera Alan Cristian Gaston
 *      Legajo FAI - 2622
 *      Mail: cryssal220799@gmail.com
 *      Usuario GitHub: veraAlan
 */

/**     Acosta Demian Aaron
 *      Legajo FAI - 2592
 *      Mail Personal: acostademiann14@gmail.com
 *      Usuario GitHub: acostaDemianAaron
 */

/**     Yaitul Santiago Alejo
 *      Legajo FAI - 2339
 *      Mail Personal: santiago.yaitul@gmail.com
 *      Usuario GitHub: SantiagoYaitul
 */

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Funcion para precargar juegos.
 * @return array
 */
function cargarJuegos()
{
    //array $juegos
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

    return $juegos;
}

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
 * @param int $opcionElegida
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
            echo "La opcion seleccionada no existe porfavor ingresar un número entre 1 y 7.\n";
            menu();
            echo "Seleccione una opcion del menu: ";
            $opcionElegida = trim(fgets(STDIN));
        }
    } while ($numeroValido == false);
    return $opValida;
}

/**
 * Muestra el resultado de un juego por pantalla.
 * Si el juego no existe muestra un cartel de error acorde.
 * @param array $coleccionJuegos;
 * @param int $numeroJuego;
 */
function mostrarDatosJuego($coleccionJuegos, $numeroJuego)
{
    //array $datosJuego
    $datosJuego = $coleccionJuegos[$numeroJuego];
    echo "\n◿\n";
    echo "‖ Juego TATETI: " . ++$numeroJuego . " ";

    if ($datosJuego["jugadorCruz"] > $datosJuego["jugadorCirculo"]) {
        echo "(gano X)\n";
    } elseif ($datosJuego["jugadorCruz"] < $datosJuego["jugadorCirculo"]) {
        echo "(gano O)\n";
    } else {
        echo "(empate)\n";
    }

    echo "‖ Jugador Cruz: " . $datosJuego["jugadorCruz"] . " obtuvo " . $datosJuego["puntosCruz"] . " puntos.\n";
    echo "‖ Jugador Circulo: " . $datosJuego["jugadorCirculo"] . " obtuvo " . $datosJuego["puntosCirculo"] . " puntos.\n";
    echo "◹\n";
}

/**
 * Comprueba si el jugador seleccionado existe dentro de la coleccion.
 * @param array $coleccion
 * @param string $nombre
 * @return boolean
 */
function jugadorEncontrado($coleccion, $nombre)
{
    //boolean $jugadorExiste, int $indice
    $jugadorExiste = false;
    $indice = 0;
    while (!$jugadorExiste && $indice < count($coleccion)) {
        $jugadorExiste = $coleccion[$indice]["jugadorCruz"] == $nombre || $coleccion[$indice]["jugadorCirculo"] == $nombre;
        $indice++;
    }
    return $jugadorExiste;
}

/**
 * Comprueba si en el juego actual el jugador mencionado gana siendo X o O.
 * @param array $partida
 * @param string $jugador
 * @return boolean
 */
function jugadorGano($partida, $jugador)
{
    if ($partida["jugadorCruz"] == $jugador && $partida["puntosCruz"] > 1) {
        return true;
    } elseif ($partida["jugadorCirculo"] == $partida["puntosCirculo"] > 1) {
        return true;
    } else {
        return false;
    }
}

/**
 * Busca el juego de una persona en la colección de juegos y muestra por pantalla.
 * @param array $coleccionJuegos
 */
function buscarJugador($coleccionJuegos, $nombre)
{
    //int $numeroJuego, int $indice, boolean $jugadorEncontrado
    $jugadorEncontrado = false;
    $indice = 0;

    do {
        $partidaEncontrada = ($coleccionJuegos[$indice]["jugadorCruz"] == $nombre || $coleccionJuegos[$indice]["jugadorCirculo"] == $nombre);
        if ($partidaEncontrada) {
            if ($coleccionJuegos[$indice]["puntosCruz"] > 1 && $coleccionJuegos[$indice]["jugadorCruz"] == $nombre) {
                mostrarDatosJuego($coleccionJuegos, $indice);
                $jugadorEncontrado = true;
            } elseif ($coleccionJuegos[$indice]["puntosCirculo"] > 1 && $coleccionJuegos[$indice]["jugadorCirculo"] == $nombre) {
                mostrarDatosJuego($coleccionJuegos, $indice);
                $jugadorEncontrado = true;
            }
        } elseif ($indice + 1 >= count($coleccionJuegos)) {
            if (jugadorEncontrado($coleccionJuegos, $nombre)) {
                echo "El jugador " . $nombre . " no ha ganado ningún juego.\n";
            } else {
                echo "El jugador ingresado " . $nombre . " no a jugado ningún juego.\n";
            }
            $jugadorEncontrado = true;
        }
        $indice++;
    } while (!$jugadorEncontrado);
}

/**
 * Recompila la información dada en todos los juegos y le pide al usuario cual jugador (X o O) quiere conseguir información.
 * @param array $colecciónJuegos
 */
function porcentajeDeVictorias($coleccionJuegos)
{
    //int $acumX, $acumO, array $partida, string $simbolo, boolean $bandera
    $acumX = 0;
    $acumO = 0;
    $bandera = true;

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
        if ($simbolo == "X" || $simbolo == "O") {
            mostrarPorcentaje(calcPorcentaje($acumX, $acumO, $simbolo), $simbolo);
            $bandera = false;
        } else {
            echo "\nEl caracter ingresado no es correcto. Ingrese 'X' o 'O': ";
            $simbolo = trim(fgets(STDIN));
            $simbolo = strtoupper($simbolo);
        }
    } while ($bandera);
}

/**
 * Calcula el porcentaje de victorias y devuelve el adecuado dependiendo $simbolo.
 * @param int $victoriasX, $victoriasO
 * @param string $simbolo
 * @return int
 */
function calcPorcentaje($victoriasX, $victoriasO, $simbolo)
{
    //int $porcVictorias
    if ($simbolo == "X") {
        $porcVictorias = round((($victoriasX * 100) / ($victoriasX + $victoriasO)), 2);
    } else {
        $porcVictorias = round((($victoriasO * 100) / ($victoriasX + $victoriasO)), 2);
    }
    return $porcVictorias;
}

/**
 * Muestra por pantalla la información de todos los juegos ganados por X o O.
 * @param int $porcentaje 
 * @param string $simbolo
 */
function mostrarPorcentaje($porcentaje, $simbolo)
{
    if ($simbolo == "X") {
        echo "\n◿";
        echo "\n‖ El lado cruz obtuvo " . $porcentaje . "% de victorias.";
        echo "\n◹\n";
    } elseif ($simbolo == "O") {
        echo "\n◿";
        echo "\n‖ El lado circulo obtuvo " . $porcentaje . "% de victorias.";
        echo "\n◹\n";
    }
}

/**
 * Genera un array con los datos de los juegos de la persona indicada por el usuario.
 * @param array $colecionJuegos
 */
function resumenJugador($coleccionJuegos, $jugador)
{
    //string $jugador, array $datosJugador

    $datosJugador = ["nombre" => $jugador, "juegosGanados" => 0, "juegosPerdidos" => 0, "juegosEmpatados" => 0, "puntosAcumulados" => 0];

    foreach ($coleccionJuegos as &$partida) {
        if ($jugador == $partida["jugadorCruz"]) {
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
        } elseif ($jugador == $partida["jugadorCirculo"]) {
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
        }
    }
    mostrarResumen($datosJugador);
}

/**
 * Muestra por pantalla los datos del jugador elegido.
 * @param array $datos
 */
function mostrarResumen($datos)
{
    echo "\n◿\n‖ Jugador: " . ($datos["nombre"]) .
        "\n‖ Ganó: " . $datos["juegosGanados"] . " juegos." .
        "\n‖ Perdio: " . $datos["juegosPerdidos"] . " juegos." .
        "\n‖ Empato: " . $datos["juegosEmpatados"] . " Juegos." .
        "\n‖ Total de puntos acumulados " . $datos["puntosAcumulados"] . " Puntos.\n◹\n";
}

/**
 * Comparador de los nombres dentro de dos arrays.
 * Devuelve 1 si el primer string es lexicograficamente menor al segundo.
 * Devuelve 0 si ambos strings son iguales.
 * Devuelve -1 si el primer string es mayor al segundo.
 * @param array $partidaA, $partidaB
 * @return int
 */
function comparador($partidaA, $partidaB)
{
    return strcmp($partidaA["jugadorCirculo"], $partidaB["jugadorCirculo"]);
}

/**
 * Ordena la colección de juegos alfabéticamente según el nombre del jugador O en cada partida jugada.
 * @param array $coleccionJuegos
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
 * string $opcion;
 */

//Inicialización de variables:

$i = 0;

$juegos = cargarJuegos();

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
            imprimirResultado($juegos[$i]);
            $i++;
            sleep(1);
            break;
        case 2:
            echo "\n\t◢ ======================◣\n";
            echo "\t‖   Mostrar un juego.   ‖\n";
            echo "\t◥ ======================◤\n\n";
            sleep(1);

            echo "Ingrese el número de juego a mostrar: ";
            $indice = trim(fgets(STDIN));
            $indice--;
            if ($indice >= 0 && $indice < count($juegos)) {
                mostrarDatosJuego($juegos, $indice);
            } else {
                echo "El número ingresado no corresponde a ningún juego.\n";
            }
            sleep(1);
            break;
        case 3:
            echo "\n\t◢ =====================================◣\n";
            echo "\t‖   Mostrar el primer juego ganador.   ‖\n";
            echo "\t◥ =====================================◤\n\n";
            sleep(1);

            echo "Ingrese el nombre del jugador deseado: ";
            $jugador = trim(fgets(STDIN));
            $jugador = strtoupper($jugador);
            buscarJugador($juegos, $jugador);
            break;
        case 4:
            echo "\n\t◢ ==========================================◣\n";
            echo "\t‖   Mostrar porcentaje de Juegos ganados.   ‖\n";
            echo "\t◥ ==========================================◤\n\n";
            sleep(1);

            porcentajeDeVictorias($juegos);
            break;
        case 5:
            echo "\n\t◢ ===============================◣\n";
            echo "\t‖   Mostrar resumen de Jugador   ‖\n";
            echo "\t◥ ===============================◤\n\n";
            sleep(1);

            echo "Ingrese el nombre del jugador el cual desee conocer su resumen de partidas: ";
            $nombre = trim(fgets(STDIN));
            $nombre = strtoupper($nombre);
            if (jugadorEncontrado($juegos, $nombre)) {
                resumenJugador($juegos, $nombre);
            } else {
                echo "El nombre ingresado no se encuentra en alguna partida.\n";
            }
            break;
        case 6:
            echo "\n\t◢ =====================================================◣\n";
            echo "\t‖   Mostrar listado de juegos Ordenado por jugador O   ‖\n";
            echo "\t◥ =====================================================◤\n\n";
            sleep(1);
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
