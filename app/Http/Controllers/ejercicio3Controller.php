<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ejercicio3Controller extends Controller
{
    public function index()
    {
        $lambda = 10; // tasa de llegada (clientes por hora)
        $mu = 3; // tasa de servicio (servicios por hora)
        $cupos = 6; // capacidad del estacionamiento
        $tiempoSimulacion = 10; // tiempo de simulación en horas

        // Variables para el resultado
        $clientesPredidios = 0;
        $totalClientes = 0;
        $lugaresLibres = array_fill(0, $cupos, 0); // Estado del estacionamiento
        $tiempoConlugarLibre = 0;

        //iteraciones
        $iteraciones = [];

        // Tiempos iniciales
        $tiempoActual = 0;
        $siguienteLlegada = $this->generateExponential($lambda);
        $siguienteSalida = array_fill(0, $cupos, INF); // Sin salidas al principio

        // Simulación
        while ($tiempoActual < $tiempoSimulacion) {
            $minDeparture = min($siguienteSalida);
            if ($siguienteLlegada <= $minDeparture) {
                // Llegada de un cliente
                $tiempoActual = $siguienteLlegada;
                $totalClientes++;
                $tipoEvento = 'Llegada';

                if (count(array_filter($lugaresLibres, function($val) { return $val == 0; })) > 0) {
                    // Hay espacio disponible
                    for ($i = 0; $i < $cupos; $i++) {
                        if ($lugaresLibres[$i] == 0) {
                            $lugaresLibres[$i] = 1;
                            $siguienteSalida[$i] = $tiempoActual + $this->generateUniform(10/60, 30/60); // Convertimos minutos a horas
                            break;
                        }
                    }
                } else {
                    // No hay espacio disponible
                    $clientesPredidios++;
                }
                $siguienteLlegada = $tiempoActual + $this->generateExponential($lambda);
            } else {
                // Salida de un cliente
                $tiempoActual = $minDeparture;
                $tipoEvento = 'Salida';
                for ($i = 0; $i < $cupos; $i++) {
                    if ($siguienteSalida[$i] == $minDeparture) {
                        $lugaresLibres[$i] = 0;
                        $siguienteSalida[$i] = INF;
                        break;
                    }
                }
            }

            // Contar el tiempo en que hay al menos un espacio disponible
            if (count(array_filter($lugaresLibres, function($val) { return $val == 0; })) > 0) {
                $tiempoConlugarLibre += $siguienteLlegada - $tiempoActual;
            }

            // Almacenar datos de la iteración
            $iteraciones[] = [
                'time' => $tiempoActual,
                'event' => $tipoEvento,
                'available_spaces' => count(array_filter($lugaresLibres, function($val) { return $val == 0; })),
                'occupied_spaces' => $cupos - count(array_filter($lugaresLibres, function($val) { return $val == 0; })),
                'lost_customers' => $clientesPredidios
            ];
        }

        $porcentajePerdidos = ($clientesPredidios / $totalClientes) * 100;
        $probabilidadEspacioLibre = $tiempoConlugarLibre / $tiempoSimulacion;
        $promedioEspaciosLibres = array_sum($lugaresLibres) / $tiempoSimulacion;

        return view('Ejercicio 3.index', compact('porcentajePerdidos',  'probabilidadEspacioLibre', 'promedioEspaciosLibres', 'iteraciones'));
    }

    private function generateExponential($rate)
    {
        $u = mt_rand() / mt_getrandmax();
        return -log(1 - $u) / $rate;
    }

    private function generateUniform($a, $b)
    {
        $u = mt_rand() / mt_getrandmax();
        return $a + ($b - $a) * $u;
    }
}

