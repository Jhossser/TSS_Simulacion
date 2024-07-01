<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Ejercicio6Controller extends Controller
{
    public function index(Request $request)
    {
        $lambda = $request->input('lambda', 2); // Tasa media de llegada de camiones por hora
        $numEquipos = $request->input('numEquipos', 4); // Número de equipos
        $minTiemposServicio = $request->input('minTiempoServicio', [20, 15, 10, 5]); // Tiempos mínimos de servicio en minutos
        $maxTiemposServicio = $request->input('maxTiempoServicio', [30, 25, 20, 15]); // Tiempos máximos de servicio en minutos
    
        $tiempoSimulacion = 8 * 60; // Tiempo de simulación en minutos
    
        // Generar tiempos de llegada de camiones (proceso de Poisson)
        $arrivalTimes = $this->generateArrivalTimes($lambda, $tiempoSimulacion);
    
        // Generar tiempos de servicio para cada equipo
        $teamsResults = $this->generateTeamsServiceTimes($numEquipos, $minTiemposServicio, $maxTiemposServicio, count($arrivalTimes));
    
        // Generar datos para el gráfico comparativo
        $labels = array_map(function ($i) { return "Camión " . ($i + 1); }, array_keys($arrivalTimes));
        $datasets = [];
        foreach ($teamsResults as $team => $result) {
            $datasets[] = [
                'label' => "Equipo $team",
                'data' => $result['serviceTimes'],
                'backgroundColor' => 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ', 0.2)',
                'borderColor' => 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ', 1)',
                'borderWidth' => 1
            ];
        }
    
        return view('Ejercicio 6.index', [
            'arrivalTimes' => $arrivalTimes,
            'teamsResults' => $teamsResults,
            'labels' => $labels,
            'datasets' => $datasets
        ]);
    }
    

    
    

    
        
    public function edit()
    {
        return view('Ejercicio 6.edit', compact('lambda', 'numEquipos', 'minTiemposServicio', 'maxTiemposServicio'));
    }


    

}



