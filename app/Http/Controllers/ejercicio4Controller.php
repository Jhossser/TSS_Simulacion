<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Composer;

class ejercicio4Controller extends Controller
{
    public function index(Request $request)
    {
        $prodDia = [];
        $transporteDia = [];

        $diasSimulados = 250; //dias
        $maxCamiones = 10; //de 1 a 10 camiones

        //datos editables
        $velocidadCamion = 90; //km/h
        $distancia = 30; //km
        $tiempoTrabajo = 8; //horas
        $tiempoCarga = 70; //min
        $tiempoDescarga = 60; //min
        $costoTransporteExtra = 100; //Bs.
        $costoAnualCamion = 100000; //Bs./año
        //termina datos editables

        $datos = [
            'vc' => $velocidadCamion,
            'd' => $distancia,
            'tc' => $tiempoCarga,
            'td' => $tiempoDescarga,
            'tt' => $tiempoTrabajo,
            'ce' => $costoTransporteExtra,
            'cac' => $costoAnualCamion,
        ];


        $costoDiarioCamion = $costoAnualCamion/250;
        
        //calcular cantidad de traslados por dia
        $tiempoTraslado = $distancia/$velocidadCamion;
        $vueltasDiarias = round($tiempoTrabajo/($tiempoTraslado+(($tiempoCarga+$tiempoDescarga)/60)));
        //termina cantidad de traslados por dia
        

        for ($i = 0; $i < $diasSimulados; $i++) {
            $capDia = [];
            $transporteDiaTemp = [];

            $randomProd = $this -> aleatorio();
            
            //definir produccion diaria
            if($randomProd>=0 && $randomProd<0.1){
                $prodDia[] = $this->uniforme(50,55);
                
            }elseif($randomProd>=0.1 && $randomProd<0.25){
                $prodDia[] =$this->uniforme(55,60);
                
            }elseif($randomProd>=0.25 && $randomProd<0.55){
                $prodDia[] =$this->uniforme(60,65);
                
            }elseif($randomProd>=0.55 && $randomProd<0.9){
                $prodDia[] =$this->uniforme(65,70);
                
            }elseif($randomProd>=0.9 && $randomProd<0.98){
                $prodDia[] =$this->uniforme(75,80);
                
            }elseif($randomProd>=0.98 && $randomProd<1){
                $prodDia[] =$this->uniforme(80,85);
            }
            // echo "En el dia " .($i+1). " hubo una produccion de $prodDia[$i] toneladas.\n";
            //echo "<br>";
            //termina produccion diaria

            //iterar de 1 a numero de camiones maximos
            for ($j = 0; $j < $maxCamiones; $j++) {
                //capacidad carga de un camion
                $randomCap = $this -> aleatorio();
                
                if($randomCap>=0 && $randomCap<0.3){
                    $capDia[] = $this->uniforme(4,4.5);
                    
                }elseif($randomCap>=0.3 && $randomCap<0.7){
                    $capDia[] =$this->uniforme(4.5,5);
                    
                }elseif($randomCap>=0.7 && $randomCap<0.9){
                    $capDia[] =$this->uniforme(5,5.5);
                    
                }elseif($randomCap>=0.9 && $randomCap<1){
                    $capDia[] =$this->uniforme(5.5,6);
                }
                //termina carga de un camion


                $transporteDiaTemp[] = array_sum($capDia);
                

                if(($transporteDiaTemp[$j]*$vueltasDiarias) > $prodDia[$i]){
                    $transporteDia[] = [
                        'dia' => $i+1,
                        'camiones' => $j+1,
                        'transportado' => $prodDia[$i]
                    ];
                    
                }else{
                    $transporteDia[] = [
                        'dia' => $i+1,
                        'camiones' => $j+1,
                        'transportado' => $transporteDiaTemp[$j]*$vueltasDiarias
                    ];
                }

            }
        }

        //calculos finales
        $sumaProduccion = array_sum($prodDia); 
        $sumaTransportadoPorCamion = [];
        $costoTotalPorCamion = [];

        foreach ($transporteDia as $entry) {
            $camion = $entry['camiones'];
            $transportado = $entry['transportado'];
        
            if (!isset($sumaTransportadoPorCamion[$camion])) {
                $sumaTransportadoPorCamion[$camion] = 0;
            }
        
            $sumaTransportadoPorCamion[$camion] += $transportado;
        }

        for($h=0; $h<$maxCamiones; $h++){
            $costoExedente = ($sumaProduccion - $sumaTransportadoPorCamion[$h+1])*$costoTransporteExtra;
            $costoPorCamion = ($h+1)*$costoDiarioCamion*$diasSimulados;
            $costoTotalPorCamion[] =  [
                'camiones' => $h+1,
                'costo' => $costoExedente+$costoPorCamion 
            ];
        }

        //calculo final de costo minimo
        $costoMinimo = PHP_INT_MAX;
        $camionesConCostoMinimo = null;

        foreach ($costoTotalPorCamion as $entry) {
            if ($entry['costo'] < $costoMinimo) {
                $costoMinimo = $entry['costo'];
                $camionesConCostoMinimo = $entry['camiones'];
            }
        }

        $costoMinimo2 = number_format($costoMinimo, 2, ',', '.');
        

        if ($request->ajax()) {
            return response()->json([
                'costoMinimo2' => $costoMinimo2,
                'camionesConCostoMinimo' => $camionesConCostoMinimo,
                'costoTotalPorCamion' => $costoTotalPorCamion,
            ]);
        }

        //print_r($sumaTransportadoPorCamion);
        return view('Ejercicio 4.index', compact('costoMinimo2','camionesConCostoMinimo','costoTotalPorCamion','diasSimulados'))->with('datos', $datos);
    }

    private function aleatorio(){
        return mt_rand() / mt_getrandmax();
    }

    private function uniforme($a, $b)
    {
        $u = $this->aleatorio();
        return $a + ($b - $a) * $u;
    }

    public function update(Request $request)
    {

    }
}
