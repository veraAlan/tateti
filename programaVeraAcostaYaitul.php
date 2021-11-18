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
 * @param int $opValida;
 * @param bool $numeroValido;
 * @return int $opEvaluar;
 */
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

/**
 * Pregunta al usuario que número de juego (index) esta buscando y muestra ese juego por pantalla.
 * Si el juego no existe muestra un cartel de error acorde.
 * @param array $coleccionJuegos;
 */
function mostrarJuego($coleccionJuegos)
{
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

/**
 * Recompila la información dada en todos los juegos y le pide al usuario cual jugador (X o O) quiere conseguir información.
 * Encuentra los datos del jugador y muestra por pantalla el porcentaje de victorias de tal jugador.
 * @param array $colecciónJuegos
 */
function porcentajeDeVictorias($coleccionJuegos)
{
    $acumX = 0;
    $acumO = 0;

    foreach ($coleccionJuegos as $i => $info) {
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

/**
 * Da un resumen solicitado por el usuario.
 * Muestra cantidad de partidas ganadas, perdidas, empatadas y puntos.
 * @param array $colecionJuegos;
 */
function resumenJugador($coleccionJuegos)
{
    $gano = 0;
    $puntos = 0;
    $empato = 0;
    $perdio = 0;

    echo "Ingrese el nombre del jugador el cual desee conocer su resumen de partidas \n";
    $nombre = trim(fgets(STDIN));
    $nombre = strtolower($nombre);
    
    foreach ($coleccionJuegos as &$partida) {
        if ($nombre == strtolower($partida["jugadorCruz"])) {
            if ($partida["puntosCruz"] > 1) {
                $gano = $gano + 1;
                $puntos = $puntos + $partida["puntosCruz"];
            } elseif ($partida["puntosCruz"] == 0) {
                $perdio = $perdio + 1;
            } elseif ($partida["puntosCruz"] == 1) {
                $empato = $empato + 1;
                $puntos = $puntos + 1;
            }
        } elseif ($nombre == strtolower($partida["jugadorCirculo"])) {
            if ($partida["puntosCirculo"] > 1) {
                $gano = $gano + 1;
                $puntos = $puntos + $partida["puntosCirculo"];
            } elseif ($partida["puntosCirculo"] == 0) {
                $perdio = $perdio + 1;
            } elseif ($partida["puntosCirculo"] == 1) {
                $empato = $empato + 1;
                $puntos = $puntos + 1;
            }
        } elseif (count($coleccionJuegos) == (array_search($partida, $coleccionJuegos)+1)){
            if($puntos > 0 && $perdio > 0){
                echo "\n◿\n‖ Jugador: " . strtoupper($nombre) .
                "\n‖ Ganó: " . $gano . " juegos." .
                "\n‖ Perdio: " . $perdio . " juegos." .
                "\n‖ Empato: " . $empato . " Juegos." .
                "\n‖ Total de puntos acumulados " . $puntos . " Puntos.\n◹\n";
            } else {
                echo "El nombre ingresado no se encuentra en alguna partida \n";
            }
        }
    }
}

/**
 * Comparador de los nombres dentro de dos arrays.
 * Devuelve 1 si el primer string es menor lexicograficamente al segundo.
 * Devuelve 0 si ambos strings son iguales.
 * Devuelve -1 si el primer string es mayor al segundo.
 * @param array $arrayA, $arrayB;
 * @return int;
 */
function comparador($arrayA, $arrayB)
{
    return strcmp($arrayA["jugadorCirculo"], $arrayB["jugadorCirculo"]);
}

/**
 * Ordena la colección de juegos alfabéticamente según el nombre del jugador O en cada partida jugada.
 * @param array $coleccionJuegos;
 */
function jugadoresOrdenados($coleccionJuegos)
{
    uasort($coleccionJuegos, "comparador");
    foreach ($coleccionJuegos as &$array) {
        time_nanosleep(0, 200000000);

        echo "◢ ===============================◣\n";
        print_r($array);
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

    //Uso de switch para seleccionar opción de menu.
    switch ($seleccion) {

        case 1:
            echo "\n\n\t◢=================◣\n";
            echo "\t‖ Jugar al Tateti ‖\n";
            echo "\t◥=================◤\n\n";
            sleep(1);
            $juegos[$i] = jugar();
            imprimirResultado($juegos[$i]);
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
} while ($seleccion != 7);