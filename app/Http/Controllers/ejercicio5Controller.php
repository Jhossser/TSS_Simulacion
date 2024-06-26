<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ejercicio5Controller extends Controller
{
    public function index(Request $request)
    {
        $tiempoReparacion = [];
        
        $rangoAsignacion = 50; //de 1 hasta 50 maquinas asignadas
        $costos = [];
        $tablaAsignadoCosto = [];

        if(isset($request->ns) || isset($request->no) || isset($request->cmo) || isset($request->sh)){
            $request->validate([
                'ns' => 'required|numeric|min:1',
                'no' => 'required|numeric|min:1',
                'cmo' => 'required|numeric|min:0',
                'sh' => 'required|numeric|min:0',
            ],
            [
                
            ]);

            //datos editables
            $numSimulaciones = $request-> ns; 
            $numOperarios = $request-> no; //operadores
            $costoMaquinaOciosa = $request-> cmo; //bs/hora
            $salrioHora = $request-> sh; //bs/hora

        }else{
            //datos editables
            $numSimulaciones = 50;
            $numOperarios = 10; //operadores
            $costoMaquinaOciosa = 500; //bs/hora
            $salrioHora = 50; //bs/hora
        }


        $datos = [
            'ns' => $numSimulaciones,
            'no' => $numOperarios,
            'cmo' => $costoMaquinaOciosa,
            'sh' => $salrioHora,
        ];

        for ($i = 0; $i < $numSimulaciones; $i++) {

            $randomRep = $this -> aleatorio();
            
            //definir produccion diaria
            if($randomRep>=0 && $randomRep<0.15){
                $tiempoReparacion[] = $this->uniforme(2,4);
                
            }elseif($randomRep>=0.15 && $randomRep<0.4){
                $tiempoReparacion[] =$this->uniforme(4,6);
                
            }elseif($randomRep>=0.4 && $randomRep<0.7){
                $tiempoReparacion[] =$this->uniforme(6,8);
                
            }elseif($randomRep>=0.7 && $randomRep<0.9){
                $tiempoReparacion[] =$this->uniforme(8,10);
 
            }elseif($randomRep>=0.9 && $randomRep<1){
                $tiempoReparacion[] =$this->uniforme(10,12);
 
            }
            
        }
        for($i=0; $i<$rangoAsignacion; $i++){
            $costos[$i] = (array_sum($tiempoReparacion)*($costoMaquinaOciosa+($salrioHora*$numOperarios)))/($i+1);

            $tablaAsignadoCosto[] = [
                'asignado' => $i+1,
                'costo' => $costos[$i]
            ];
        }

        $costoMinimo = PHP_INT_MAX;
        $asignacionMinimo = null;
        
        foreach ($tablaAsignadoCosto as $entry) {
            if ($entry['costo'] < $costoMinimo) {
                $costoMinimo = $entry['costo'];
                $asignacionMinimo = $entry['asignado'];
            }
        }

        $costoMinimo2 = number_format($costoMinimo, 2, ',', '.');

        if ($request->ajax()) {
            return response()->json([
                'costoMinimo2' => $costoMinimo2,
                'asignacionMinimo' => $asignacionMinimo,
                'tablaAsignadoCosto' => $tablaAsignadoCosto,
            ]);
        }

        //print_r($sumaTransportadoPorCamion);
        return view('Ejercicio 5.index', compact('costoMinimo2','asignacionMinimo','tablaAsignadoCosto'))->with('datos', $datos);
    }

    private function aleatorio(){
        return mt_rand() / mt_getrandmax();
    }
    private function uniforme($a, $b)
    {
        $u = $this->aleatorio();
        return $a + ($b - $a) * $u;
    }

    public function edit()
    {
        return view('Ejercicio 5.edit');
    }
}
