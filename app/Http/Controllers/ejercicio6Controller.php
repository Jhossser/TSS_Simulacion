<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ejercicio6Controller extends Controller
{
    public function index(Request $request)
    {
        $lambda = 2; // Tasa media de llegada de camiones por hora (ejemplo)
        $tiempoSimulacion = 8; // Tiempo de simulación en horas (ejemplo)
        $minTiempoServicio = 20; // Tiempo mínimo de servicio en minutos
        $maxTiempoServicio = 30; // Tiempo máximo de servicio en minutos

        // Generar tiempos de llegada de camiones (proceso de Poisson)
        $arrivalTimes = $this->generateArrivalTimes($lambda, $tiempoSimulacion);

        // Número total de camiones que llegan
        $cantidadCamiones = count($arrivalTimes);

        // Generar tiempos de servicio del equipo de 3 personas (distribución uniforme)
        $serviceTimes = $this->generateServiceTimes($minTiempoServicio, $maxTiempoServicio, $cantidadCamiones);

        // Calcular el tiempo total en el sistema para cada camión
        $systemTimes = [];
        for ($i = 0; $i < $cantidadCamiones; $i++) {
            $systemTimes[] = $arrivalTimes[$i] + $serviceTimes[$i];
        }

        // Datos para los gráficos (ejemplos)
        $datosGraficoPoisson = $this->generatePoissonData($arrivalTimes, $tiempoSimulacion);
        $datosGraficoUniforme = $this->generateUniformData($serviceTimes);

        // Pasar los datos a la vista
        return view('Ejercicio 6.index', [
            'arrivalTimes' => $arrivalTimes,
            'serviceTimes' => $serviceTimes,
            'systemTimes' => $systemTimes,
            'lambda' => $lambda,
            'minTiempoServicio' => $minTiempoServicio,
            'maxTiempoServicio' => $maxTiempoServicio,
            'datosGraficoPoisson' => $datosGraficoPoisson,
            'datosGraficoUniforme' => $datosGraficoUniforme,
        ]);
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

    private function generatePoissonData($arrivalTimes, $tiempoSimulacion)
    {
        // Inicializar un array para los datos del gráfico
        $data = [];
        $intervals = 10; // Número de intervalos en los que dividir el tiempo de simulación
        $intervalLength = $tiempoSimulacion / $intervals;
    
        // Contar las llegadas en cada intervalo de tiempo
        for ($i = 0; $i < $intervals; $i++) {
            $data[$i] = 0;
        }
    
        foreach ($arrivalTimes as $time) {
            $intervalIndex = min(floor($time / $intervalLength), $intervals - 1);
            $data[$intervalIndex]++;
        }
    
        // Crear las etiquetas para los intervalos de tiempo
        $labels = [];
        for ($i = 0; $i < $intervals; $i++) {
            $labels[] = round($i * $intervalLength, 2) . "-" . round(($i + 1) * $intervalLength, 2);
        }
    
        return [
            'labels' => $labels,
            'data' => array_values($data),
        ];
    }
    
    private function generateUniformData($serviceTimes)
    {
        $min = 20; // Tiempo mínimo de servicio en minutos
        $max = 30; // Tiempo máximo de servicio en minutos
        $intervals = 10; // Número de intervalos para el gráfico

        // Calcular el ancho de cada intervalo
        $intervalWidth = ($max - $min) / $intervals;

        // Inicializar los contadores para cada intervalo
        $data = array_fill(0, $intervals, 0);

        // Contar cuántos tiempos caen en cada intervalo
        foreach ($serviceTimes as $time) {
            $index = min(floor(($time * 60 - $min) / $intervalWidth), $intervals - 1); // Convertir tiempo a minutos y calcular el índice
            $data[$index]++;
        }

        // Crear las etiquetas para los intervalos de tiempo
        $labels = [];
        for ($i = 0; $i < $intervals; $i++) {
            $labels[] = round($min + $i * $intervalWidth, 2) . "-" . round($min + ($i + 1) * $intervalWidth, 2);
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
}

