<?php

namespace App\Http\Controllers;

use App\Models\ejercicio6;
use App\Models\equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Ejercicio6Controller extends Controller
{
    public function index(Request $request)
    {
        $lambda = $request->input('lambda', 2); // Tasa media de llegada de camiones por hora
        $numEquipos = $request->input('numEquipos', 4); // Número de equipos
        $minTiemposServicio = $request->input('minTiempoServicio', [20, 15, 10, 5]); // Tiempos mínimos de servicio en minutos
        $maxTiemposServicio = $request->input('maxTiempoServicio', [30, 25, 20, 15]); // Tiempos máximos de servicio en minutos
    
        if(isset($request->lambda) || isset($request->numEquipos) || isset($request->minTiempoServicio) || isset($request->maxTiempoServicio)){
            $userId = Auth::id();
    
            //guardando historial
            $ej6 = new ejercicio6();
            $ej6->idUsuario = $userId;
            $ej6->tasaLlegada = $lambda;
            $ej6->numEquipos = $numEquipos;
            $ej6->save();

            for ($j = 0; $j < $numEquipos; $j++) {
                $equipo = new equipo();
                $equipo->idEjercicio6 = $ej6->id;
                $equipo->numEquipo = $j+1;
                $equipo->min = $minTiemposServicio[$j];
                $equipo->max = $maxTiemposServicio[$j];
                $equipo->save();
            }
        }


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
        return view('Ejercicio 6.edit');
    }

    private function generateArrivalTimes($lambda, $tiempoSimulacion)
    {
        $arrivalTimes = [];
        $t = 0;
        while ($t < $tiempoSimulacion) {
            $u = mt_rand() / mt_getrandmax(); // Generar un número aleatorio uniforme entre 0 y 1
            $t -= log(1 - $u) / $lambda * 60; // Tiempo hasta la siguiente llegada en minutos
            if ($t < $tiempoSimulacion) {
                $arrivalTimes[] = round($t, 2); // Añadir tiempo de llegada redondeado
            }
        }
        return $arrivalTimes;
    }
    
    private function generateTeamsServiceTimes($numEquipos, $minTiemposServicio, $maxTiemposServicio, $cantidadCamiones)
    {
        $teamsResults = [];
        for ($team = 0; $team < $numEquipos; $team++) {
            
            $serviceTimes = [];
            for ($i = 0; $i < $cantidadCamiones; $i++) {
                $serviceTimes[] = rand($minTiemposServicio[$team], $maxTiemposServicio[$team]);
            }
            $teamsResults[] = ['serviceTimes' => $serviceTimes];
            // print_r($serviceTimes);
        }
        return $teamsResults;
    }

    public function hist(ejercicio6 $hist){
        $equipos = equipo::where('idEjercicio6', $hist->id)->get();

        return view('Ejercicio 6.edit', compact('hist','equipos'));
    }
}



