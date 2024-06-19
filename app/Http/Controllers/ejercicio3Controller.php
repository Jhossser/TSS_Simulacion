<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ejercicio3Controller extends Controller
{
    public function index()
    {
        $lambda = 10; // tasa de llegada (clientes por hora)
        $mu = 3; // tasa de servicio (servicios por hora)
        $c = 6; // capacidad del estacionamiento

        $po = $this->calculateP0($lambda, $mu, $c);
        $pc = pow($lambda / $mu, $c) / $this->factorial($c) * $po;

        $percentageLostCustomers = $pc * 100;
        $probabilityAvailableSpace = 1 - $pc;
        $averageAvailableSpaces = $this->averageAvailableSpaces($lambda, $mu, $c, $po);

        return view('Ejercicio 3.index', compact('percentageLostCustomers', 'probabilityAvailableSpace', 'averageAvailableSpaces'));
    }

    private function calculateP0($lambda, $mu, $c)
    {
        $sum = 0;
        for ($n = 0; $n <= $c; $n++) {
            $sum += pow($lambda / $mu, $n) / $this->factorial($n);
        }
        return 1 / $sum;
    }

    private function factorial($n)
    {
        if ($n == 0) {
            return 1;
        }
        return $n * $this->factorial($n - 1);
    }

    private function averageAvailableSpaces($lambda, $mu, $c, $po)
    {
        $averageSpaces = 0;
        for ($n = 0; $n < $c; $n++) {
            $pn = pow($lambda / $mu, $n) / $this->factorial($n) * $po;
            $averageSpaces += ($c - $n) * $pn;
        }
        return $averageSpaces;
    }
}
