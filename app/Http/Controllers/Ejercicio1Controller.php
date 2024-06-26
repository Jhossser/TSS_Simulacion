<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ejercicio1Controller extends Controller
{
    public function generatePoisson($lambda) {
        $l = exp(-$lambda);
        $k = 0;
        $p = 1.0;

        do {
            $k++;
            $p *= mt_rand() / mt_getrandmax();
        } while ($p > $l);

        return $k - 1;
    }

    public function generateExponential($mean) {
        $lambda = 1 / $mean;
        return -log(1.0 - mt_rand() / mt_getrandmax()) / $lambda;
    }

    public function generateUniform($min, $max) {
        return $min + (mt_rand() / mt_getrandmax()) * ($max - $min);
    }

    public function formatTime($timeInMinutes) {
        $hours = floor($timeInMinutes / 60);
        $minutes = floor($timeInMinutes % 60);
        $seconds = round(($timeInMinutes * 60) % 60);
        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }

    public function simulateQueueSystem($lambda, $meanService1, $minService2, $maxService2) {
        $arrivalTimes = [];
        $serviceTimes1 = [];
        $serviceTimes2 = [];
        $systemTimes = [];

        $totalTimeInSystem = 0;
        $totalServiceTime1 = 0;
        $totalServiceTime2 = 0;

        for ($i = 0; $i < 100; $i++) {
            // Llegada a la estación 1
            $arrivalTime = $i * (60 / $lambda); // Tiempo entre llegadas
            $arrivalTimes[] = $this->formatTime($arrivalTime);

            // Servicio en la estación 1
            $serviceTime1 = $this->generateExponential($meanService1);
            $serviceTimes1[] = $this->formatTime($serviceTime1 * 60); // Convertimos de horas a minutos
            $totalServiceTime1 += $serviceTime1 * 60;

            // Servicio en la estación 2
            $serviceTime2 = $this->generateUniform($minService2, $maxService2);
            $serviceTimes2[] = $this->formatTime($serviceTime2 * 60); // Convertimos de horas a minutos
            $totalServiceTime2 += $serviceTime2 * 60;

            // Tiempo total en el sistema
            $systemTime = ($serviceTime1 + $serviceTime2) * 60; // Convertimos de horas a minutos
            $systemTimes[] = $this->formatTime($systemTime);

            $totalTimeInSystem += $systemTime;
        }

        $averageTimeInSystem = $this->formatTime($totalTimeInSystem / 100);
        $averageServiceTime1 = $this->formatTime($totalServiceTime1 / 100);
        $averageServiceTime2 = $this->formatTime($totalServiceTime2 / 100);

        return [
            'averageTimeInSystem' => $averageTimeInSystem,
            'averageServiceTime1' => $averageServiceTime1,
            'averageServiceTime2' => $averageServiceTime2,
            'averageServiceTime1InMinutes' => $totalServiceTime1 / 100,
            'averageServiceTime2InMinutes' => $totalServiceTime2 / 100,
            'arrivalTimes' => $arrivalTimes,
            'serviceTimes1' => $serviceTimes1,
            'serviceTimes2' => $serviceTimes2,
            'systemTimes' => $systemTimes
        ];
    }

    public function index(Request $request) {
        $lambda = $request->input('lambda', 20); // Llegadas por hora, valor por defecto: 20
        $meanService1 = 2 / 60; // 2 minutos por persona, convertido a horas
        $minService2 = 1 / 60; // 1 minuto, convertido a horas
        $maxService2 = 2 / 60; // 2 minutos, convertido a horas

        $result = $this->simulateQueueSystem($lambda, $meanService1, $minService2, $maxService2);

        return view('Ejercicio 1.index', [
            'averageTimeInSystem' => $result['averageTimeInSystem'],
            'averageServiceTime1' => $result['averageServiceTime1'],
            'averageServiceTime2' => $result['averageServiceTime2'],
            'averageServiceTime1InMinutes' => $result['averageServiceTime1InMinutes'],
            'averageServiceTime2InMinutes' => $result['averageServiceTime2InMinutes'],
            'arrivalTimes' => $result['arrivalTimes'],
            'serviceTimes1' => $result['serviceTimes1'],
            'serviceTimes2' => $result['serviceTimes2'],
            'systemTimes' => $result['systemTimes']
        ]);
    }
}
