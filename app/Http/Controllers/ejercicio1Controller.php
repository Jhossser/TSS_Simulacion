<?php

namespace App\Http\Controllers;

use App\Models\ejercicio1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ejercicio1Controller extends Controller
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

    public function simulateQueueSystem($lambda, $meanService1, $minService2, $maxService2, $numClientes) {
        $arrivalTimes = [];
        $serviceTimes1 = [];
        $serviceTimes2 = [];
        $systemTimes = [];

        $totalTimeInSystem = 0;
        $totalServiceTime1 = 0;
        $totalServiceTime2 = 0;

        for ($i = 0; $i < $numClientes; $i++) {
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

        $averageTimeInSystem = $this->formatTime($totalTimeInSystem / $numClientes);
        $averageServiceTime1 = $this->formatTime($totalServiceTime1 / $numClientes);
        $averageServiceTime2 = $this->formatTime($totalServiceTime2 / $numClientes);

        return [
            'averageTimeInSystem' => $averageTimeInSystem,
            'averageServiceTime1' => $averageServiceTime1,
            'averageServiceTime2' => $averageServiceTime2,
            'averageServiceTime1InMinutes' => $totalServiceTime1 / $numClientes,
            'averageServiceTime2InMinutes' => $totalServiceTime2 / $numClientes,
            'arrivalTimes' => $arrivalTimes,
            'serviceTimes1' => $serviceTimes1,
            'serviceTimes2' => $serviceTimes2,
            'systemTimes' => $systemTimes
        ];
    }

    public function index(Request $request) {
        if(isset($request->lambda) || isset($request->meanService1) || isset($request->minService2) || isset($request->maxService2) || isset($request->numClientes)){

            $userId = Auth::id();
            $exists = ejercicio1::where('idUsuario', $userId)
                            ->where('lambda', $request->lambda)
                            ->where('mediaEst1', $request->meanService1)
                            ->where('minEst2', $request->minService2)
                            ->where('maxEst2', $request->maxService2)
                            ->where('numClientes', $request->numClientes)
                            ->exists();
                            
            if (!$exists) {
                //guardando historial
                $ej3 = new ejercicio1();
                $ej3->idUsuario = $userId;
                $ej3->lambda = $request->lambda;
                $ej3->mediaEst1 = $request->meanService1;
                $ej3->minEst2 = $request->minService2;
                $ej3->maxEst2 = $request->maxService2;
                $ej3->numClientes = $request->numClientes;
                $ej3->save();
            }
        }
        


        // Valores por defecto si no se proporcionan en la solicitud
        $lambda = $request->input('lambda', 20); // Llegadas por hora, valor por defecto: 20
        $meanService1 = $request->input('meanService1', 2) / 60; // Convertido a horas, valor por defecto: 2 minutos
        $minService2 = $request->input('minService2', 1) / 60; // Convertido a horas, valor por defecto: 1 minuto
        $maxService2 = $request->input('maxService2', 2) / 60; // Convertido a horas, valor por defecto: 2 minutos
        $numClientes = $request->input('numClientes', 100); // Número de clientes para la simulación, valor por defecto: 100

        // Simular el sistema de colas
        $result = $this->simulateQueueSystem($lambda, $meanService1, $minService2, $maxService2, $numClientes);

        // Devolver la vista con los resultados de la simulación
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

    public function hist(ejercicio1 $hist){
        return view('Ejercicio 1.edit', compact('hist'));
    }
}