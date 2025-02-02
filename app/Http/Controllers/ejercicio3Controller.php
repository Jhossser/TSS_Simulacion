<?php

namespace App\Http\Controllers;

use App\Models\ejercicio3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ejercicio3Controller extends Controller
{
    public function index(Request $request)
    {
        $lambda = 10; // tasa de llegada (clientes por hora)
        $mu = 3; // tasa de servicio (servicios por hora)
        $cupos = 6; // capacidad del estacionamiento
        $tiempoSimulacion = 24; // tiempo de simulación en horas

        $datosPoisson = $this->distribucionPoisson($lambda, $tiempoSimulacion);
        $datosExponencial = [];
        $datosUniforme = [];
        // print_r($datosPoisson);

        // Variables para el resultado
        $clientesPerdidos = 0;
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
                            $tiempoUniforme = $this->generateUniform(10/60, 30/60);
                            $siguienteSalida[$i] = $tiempoActual + $tiempoUniforme; // Convertimos minutos a horas
                            $datosUniforme[] = $tiempoUniforme * 60;
                            break;
                        }
                    }
                } else {
                    // No hay espacio disponible
                    $clientesPerdidos++;
                }
                $tiempoExponencial = $this->generateExponential($lambda);
                $siguienteLlegada = $tiempoActual + $tiempoExponencial;
                $datosExponencial[] = $this->generateExponentialGrafico($lambda);  
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
                'time' => $tiempoActual*60,
                'event' => $tipoEvento,
                'available_spaces' => count(array_filter($lugaresLibres, function($val) { return $val == 0; })),
                'occupied_spaces' => $cupos - count(array_filter($lugaresLibres, function($val) { return $val == 0; })),
                'lost_customers' => $clientesPerdidos
            ];
        }

        $porcentajePerdidos = ($clientesPerdidos / $totalClientes) * 100;
        $probabilidadEspacioLibre = 100 - $porcentajePerdidos;
        $promedioEspaciosLibres = array_sum($lugaresLibres) / $tiempoSimulacion;

        if ($request->ajax()) {
            return response()->json([
                'porcentajePerdidos' => $porcentajePerdidos,
                'probabilidadEspacioLibre' => $probabilidadEspacioLibre,
                'promedioEspaciosLibres' => $promedioEspaciosLibres,
                'iteraciones' => $iteraciones,
                'datosPoisson' => $datosPoisson,
                'datosExponencial' => $datosExponencial,
                'datosUniforme' => $datosUniforme
            ]);
        }

        //print_r($datosExponencial);
        return view('Ejercicio 3.index', compact('porcentajePerdidos',  'probabilidadEspacioLibre', 'promedioEspaciosLibres', 'iteraciones','datosPoisson','datosExponencial','datosUniforme'));
    }

    //distribucion poisson
    private function distribucionPoisson($lambda, $horas){
        $data = [];
        for ($k = 0; $k <= $horas; $k++) {
            $probability = exp(-$lambda) * pow($lambda, $k) / $this->factorial($k);
            $data[] = ['time' => $k, 'value' => $probability];
        }

        return $data;
    }
    private function factorial($n)
    {
        if ($n <= 1) {
            return 1;
        } else {
            return $n * $this->factorial($n - 1);
        }
    }
    //termina distribucion poisson

    private function generateExponential($rate)
    {
        $u = mt_rand() / mt_getrandmax();
        return -log(1 - $u) / $rate;
    }

    //para grafico
    private function generateExponentialGrafico($rate)
    {
        $u = mt_rand() / mt_getrandmax();
        $valorExp = -log(1 - $u) / $rate;
        return ['numAleatorio' => $u, 'valor' => $valorExp];
    }
    //termina para grafico

    private function generateUniform($a, $b)
    {
        $u = mt_rand() / mt_getrandmax();
        return $a + ($b - $a) * $u;
    }

    public function edit()
    {
        return view('Ejercicio 3.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'tasaLlegada' => 'required|numeric|min:0',
            'tasaServicio' => 'required|numeric|min:0',
            'capacidad' => 'required|numeric|min:1',
            'tiempo' => 'required|numeric|min:1',
        ],
        [
            'tasaLlegada.min' => 'No puede ser un numero negativo',
            'tasaServicio.min' => 'No puede ser un numero negativo',
            'capacidad.min' => 'Espacio minimo de 1',
            'tiempo.min' => 'Tiempo minimo de 1 hora'
        ]);

        $userId = Auth::id();
        $exists = Ejercicio3::where('idUsuario', $userId)
                        ->where('tasaLlegada', $request->tasaLlegada)
                        ->where('tasaServicio', $request->tasaServicio)
                        ->where('cantCupos', $request->capacidad)
                        ->where('tiemposimu', $request->tiempo)
                        ->exists();
                        
        if (!$exists) {
            //guardando historial
            $ej3 = new ejercicio3();
            $ej3->idUsuario = $userId;
            $ej3->tasaLlegada = $request->tasaLlegada;
            $ej3->tasaServicio = $request->tasaServicio;
            $ej3->cantCupos = $request->capacidad;
            $ej3->tiemposimu = $request->tiempo;
            $ej3->save();
        }


        $lambda = $request -> tasaLlegada; // tasa de llegada (clientes por hora)
        $mu = $request -> tasaServicio; // tasa de servicio (servicios por hora)
        $cupos = $request -> capacidad; // capacidad del estacionamiento
        $tiempoSimulacion = $request -> tiempo; // tiempo de simulación en horas

        $datos = [
            'tl' => $lambda,
            'ts' => $mu,
            'c' => $cupos,
            'tiempo' => $tiempoSimulacion
        ];

        $datosPoisson = $this->distribucionPoisson($lambda, $tiempoSimulacion);
        $datosExponencial = [];
        $datosUniforme = [];
        // print_r($datosPoisson);

        // Variables para el resultado
        $clientesPerdidos = 0;
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
                            $tiempoUniforme = $this->generateUniform(10/60, 30/60);
                            $siguienteSalida[$i] = $tiempoActual + $tiempoUniforme; // Convertimos minutos a horas
                            $datosUniforme[] = $tiempoUniforme * 60;
                            break;
                        }
                    }
                } else {
                    // No hay espacio disponible
                    $clientesPerdidos++;
                }
                $tiempoExponencial = $this->generateExponential($lambda);
                $siguienteLlegada = $tiempoActual + $tiempoExponencial;
                $datosExponencial[] = $this->generateExponentialGrafico($lambda);  
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
                'time' => $tiempoActual*60,
                'event' => $tipoEvento,
                'available_spaces' => count(array_filter($lugaresLibres, function($val) { return $val == 0; })),
                'occupied_spaces' => $cupos - count(array_filter($lugaresLibres, function($val) { return $val == 0; })),
                'lost_customers' => $clientesPerdidos
            ];
        }

        $porcentajePerdidos = ($clientesPerdidos / $totalClientes) * 100;
        $probabilidadEspacioLibre = 100 - $porcentajePerdidos;
        $promedioEspaciosLibres = array_sum($lugaresLibres) / $tiempoSimulacion;

        if ($request->ajax()) {
            return response()->json([
                'porcentajePerdidos' => $porcentajePerdidos,
                'probabilidadEspacioLibre' => $probabilidadEspacioLibre,
                'promedioEspaciosLibres' => $promedioEspaciosLibres,
                'iteraciones' => $iteraciones,
                'datosPoisson' => $datosPoisson,
                'datosExponencial' => $datosExponencial,
                'datosUniforme' => $datosUniforme
            ]);
        }

        return view('Ejercicio 3.index', compact('porcentajePerdidos',  'probabilidadEspacioLibre', 'promedioEspaciosLibres', 'iteraciones','datosPoisson','datosExponencial','datosUniforme'))->with('datos', $datos);              
    }

    public function hist(ejercicio3 $hist){
        return view('Ejercicio 3.edit', compact('hist'));
    }
}

