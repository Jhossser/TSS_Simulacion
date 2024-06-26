<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    
        // Iterar para cada equipo
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
    
            // Almacenar resultados del equipo
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
    
        // Generar datos para los gráficos
        $datosGraficoPoisson = $this->generatePoissonChartData($lambda, $tiempoSimulacion);
        $datosGraficoUniforme = $this->generateUniformChartData($minTiemposServicio, $maxTiemposServicio);
    
        return view('Ejercicio 6.index', [
            'lambda' => $lambda,
            'numEquipos' => $numEquipos,
            'minTiemposServicio' => $minTiemposServicio,
            'maxTiemposServicio' => $maxTiemposServicio,
            'teamsResults' => $teamsResults,
            'datosGraficoPoisson' => $datosGraficoPoisson,
            'datosGraficoUniforme' => $datosGraficoUniforme,
        ]);
    }
    
    private function generatePoissonChartData($lambda, $tiempoSimulacion)
    {
        // Número máximo de puntos en el tiempo que queremos mostrar en el gráfico
        $maxPoints = 100;
    
        // Generar tiempos de llegada de camiones (proceso de Poisson)
        $arrivalTimes = [];
        $t = 0;
        $count = 0;
    
        while ($count < $maxPoints && $t < $tiempoSimulacion) {
            $u = rand() / getrandmax(); // Generar un número aleatorio uniforme entre 0 y 1
            $t -= log(1 - $u) / $lambda; // Tiempo hasta la siguiente llegada
            if ($t < $tiempoSimulacion) {
                $arrivalTimes[] = round($t, 2); // Añadir tiempo de llegada redondeado
                $count++;
            }
        }
    
        return [
            'labels' => range(1, $count), // Etiquetas del gráfico (números de punto)
            'data' => $arrivalTimes, // Datos para el gráfico (tiempos de llegada)
        ];
    }
    
    
    private function generateUniformChartData($minTiemposServicio, $maxTiemposServicio)
    {
        // Número de equipos
        $numEquipos = count($minTiemposServicio);
    
        // Preparar datos para el gráfico
        $labels = [];
        $data = [];
        for ($i = 0; $i < $numEquipos; $i++) {
            $labels[] = "Equipo " . ($i + 1);
            $data[] = rand($minTiemposServicio[$i] * 60, $maxTiemposServicio[$i] * 60) / 60; // Convertir minutos a horas
        }
    
        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
    
        
    public function edit()
    {
        // Ejemplo de obtener datos desde algún modelo o configuración
        $lambda = 20; // Ejemplo, puedes obtenerlo de una base de datos o configuración
        $numEquipos = 4; // Ejemplo
        $minTiemposServicio = [10, 15, 20, 25]; // Ejemplo
        $maxTiemposServicio = [30, 35, 40, 45]; // Ejemplo
    
        return view('Ejercicio 6.edit', compact('lambda', 'numEquipos', 'minTiemposServicio', 'maxTiemposServicio'));
    }

    public function update(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'lambda' => 'required|numeric',
            'numEquipos' => 'required|integer|min:1',
            'minTiempoServicio.*' => 'required|numeric|min:1',
            'maxTiempoServicio.*' => 'required|numeric|gte:minTiempoServicio.*',
        ]);
    
        // Recoger los datos del formulario
        $lambda = $request->input('lambda');
        $numEquipos = $request->input('numEquipos');
        $minTiempoServicio = $request->input('minTiempoServicio');
        $maxTiempoServicio = $request->input('maxTiempoServicio');
    
        // Simulación y cálculo de resultados
        $tiempoSimulacion = 8; // Ejemplo de tiempo de simulación (ajusta según tus necesidades)
    
        // Generar resultados para cada equipo
        $teamsResults = $this->generateTeamsResults($numEquipos, $minTiempoServicio, $maxTiempoServicio);
    
        // Generar datos para los gráficos
        $datosGraficoPoisson = $this->generatePoissonChartData($lambda, $tiempoSimulacion);
        $datosGraficoUniforme = $this->generateUniformChartData($minTiempoServicio, $maxTiempoServicio);
    
        // Redirigir a la vista de resultados con los datos actualizados
        return view('Ejercicio 6.index', [
            'lambda' => $lambda,
            'numEquipos' => $numEquipos,
            'minTiemposServicio' => $minTiempoServicio,
            'maxTiemposServicio' => $maxTiempoServicio,
            'teamsResults' => $teamsResults,
            'datosGraficoPoisson' => $datosGraficoPoisson,
            'datosGraficoUniforme' => $datosGraficoUniforme,
        ]);
    }
    
      public function generateTeamsResults($numEquipos, $poissonChartData, $serviceTimes)
    {
        $teamsResults = [];

        // Ejemplo de cómo podrías calcular resultados para cada equipo
        for ($equipo = 1; $equipo <= $numEquipos; $equipo++) {
            // Simulación de resultados para cada equipo
            $arrivalTimes = []; // Tiempos de llegada
            $serviceTimesForTeam = []; // Tiempos de servicio para este equipo
            $systemTimes = []; // Tiempos en el sistema

            // Generar datos ficticios para este equipo (debes ajustar según tu lógica específica)
            for ($camion = 1; $camion <= 5; $camion++) {
                $arrivalTimes[] = mt_rand(1, 10); // Ejemplo de tiempo de llegada aleatorio
                $serviceTimesForTeam[] = $serviceTimes[$equipo - 1]; // Usando el tiempo de servicio del equipo correspondiente
                $systemTimes[] = $arrivalTimes[$camion - 1] + $serviceTimesForTeam[$camion - 1]; // Ejemplo de cálculo de tiempo en el sistema
            }

            // Agregar resultados para este equipo al array de resultados
            $teamsResults[$equipo] = [
                'arrivalTimes' => $arrivalTimes,
                'serviceTimes' => $serviceTimesForTeam,
                'systemTimes' => $systemTimes,
            ];
        }

        // Ejemplo de registro de un mensaje en el log
        Log::info('Se generaron resultados para ' . $numEquipos . ' equipos.');

        return $teamsResults;
    }
    private function generateUniformServiceTimes($camiones, $minTiempos, $maxTiempos)
    {
        $minTiemposServicio = [];
        $maxTiemposServicio = [];
    
        for ($i = 0; $i < $camiones; $i++) {
            // Generar tiempos aleatorios dentro del rango uniforme para cada equipo
            $minTiemposServicio[] = rand($minTiempos[$i], $maxTiempos[$i]);
            $maxTiemposServicio[] = rand($minTiempos[$i], $maxTiempos[$i]);
        }
    
        return [
            'minTiemposServicio' => $minTiemposServicio,
            'maxTiemposServicio' => $maxTiemposServicio,
        ];
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