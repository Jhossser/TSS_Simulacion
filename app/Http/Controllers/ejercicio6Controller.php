<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ejercicio6Controller extends Controller
{
    public function index(Request $request)
    {
        $lambda = $request->input('lambda', 2); // Tasa media de llegada de camiones por hora
        $numEquipos = $request->input('numEquipos', 4); // Número de equipos
        $minTiemposServicio = $request->input('minTiempoServicio', [20, 20, 20, 20]); // Tiempos mínimos de servicio en minutos
        $maxTiemposServicio = $request->input('maxTiempoServicio', [30, 30, 30, 30]); // Tiempos máximos de servicio en minutos

        $tiempoSimulacion = 8; // Tiempo de simulación en horas (ejemplo)
        $teamsResults = [];

        for ($team = 1; $team <= $numEquipos; $team++) {
            $minTiempoServicio = $minTiemposServicio[$team - 1];
            $maxTiempoServicio = $maxTiemposServicio[$team - 1];

            // Generar tiempos de llegada de camiones (proceso de Poisson)
            $arrivalTimes = $this->generateArrivalTimes($lambda, $tiempoSimulacion);

            // Número total de camiones que llegan
            $cantidadCamiones = count($arrivalTimes);

            // Generar tiempos de servicio del equipo (distribución uniforme)
            $serviceTimes = $this->generateServiceTimes($minTiempoServicio, $maxTiempoServicio, $cantidadCamiones);

            // Calcular el tiempo total en el sistema para cada camión
            $systemTimes = [];
            for ($i = 0; $i < $cantidadCamiones; $i++) {
                $systemTimes[] = $arrivalTimes[$i] + $serviceTimes[$i];
            }

            $avgServiceTime = array_sum($serviceTimes) / $cantidadCamiones;
            $avgSystemTime = array_sum($systemTimes) / $cantidadCamiones;

            $teamsResults[$team] = [
                'avgServiceTime' => $avgServiceTime,
                'avgSystemTime' => $avgSystemTime,
                'serviceTimes' => $serviceTimes,
                'systemTimes' => $systemTimes,
                'arrivalTimes' => $arrivalTimes,
            ];
        }

        return view('Ejercicio 6.index', [
            'lambda' => $lambda,
            'numEquipos' => $numEquipos,
            'minTiemposServicio' => $minTiemposServicio,
            'maxTiemposServicio' => $maxTiemposServicio,
            'teamsResults' => $teamsResults,
        ]);
    }

    public function edit()
    {
        return view('Ejercicio 6.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'lambda' => 'required|numeric',
            'numEquipos' => 'required|integer|min:1',
            'minTiempoServicio.*' => 'required|numeric|min:1',
            'maxTiempoServicio.' => 'required|numeric|gte:minTiempoServicio.',
        ]);
    
        return redirect()->route('ej6.index', $request->all());
    }

    private function generateArrivalTimes($lambda, $tiempoSimulacion)
    {
        $arrivalTimes = [];
        $t = 0;
        while ($t < $tiempoSimulacion) {
            $u = rand() / getrandmax(); // Genera un número aleatorio uniforme entre 0 y 1
            $t -= log(1 - $u) / $lambda; // Tiempo hasta la siguiente llegada
            if ($t < $tiempoSimulacion) {
                $arrivalTimes[] = round($t, 2); // Añadir tiempo de llegada redondeado
            }
        }
        return $arrivalTimes;
    }

    private function generateServiceTimes($min, $max, $cantidadCamiones)
    {
        $serviceTimes = [];
        for ($i = 0; $i < $cantidadCamiones; $i++) {
            $serviceTimes[] = rand($min * 60, $max * 60) / 60; // Convertir minutos a horas
        }
        return $serviceTimes;
    }
}

