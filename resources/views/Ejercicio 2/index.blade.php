@extends('layout.plantilla')

@section('links')
    <link rel="stylesheet" href="../../css/ejercicio3.css">
@endsection

@section('titulo', 'Ejercicio 2')

@section('contenido')
    <h1>Problema de Cajeros</h1>
    <img class="imgEst" src="../../Image/cajeros.jpg" alt="foto cajeros">
    <p class="margenAbajo" style="text-align: justify;">
        Un banco emplea 3 cajeros para servir a sus clientes. Los clientes 
        arriban de acuerdo a un proceso Poisson a una razón media de 40 por hora.
        Si un cliente encuentra todos los cajeros ocupados. entonces se incorpora 
        a la cola que alimenta a todos los cajeros. El tiempo que dura la transacción 
        entre un cajero y un cliente sigue una distribución uniforme entre 0 y 1 minuto. 
        Para esta información, ¿Cuál es el tiempo promedio en el sistema?, ¿Cuál es la cantidad promedio de clientes en el sistema? 
    </p>
    <div class="margenAbajo">
        <h1>Proceso de Llegada de Clientes</h1>
        <p style="text-align: justify;">
            CAMBIALOOOLos clientes llegan según un proceso de Poisson con una tasa media de 10 clientes por hora. La distribución de Poisson describe el número de eventos que ocurren
            en un intervalo de tiempo dado, dado un promedio constante de ocurrencias y eventos independientes.
        </p>
    </div>

    <h2>Detalles de la simulacion</h2>
    <div class="actualizar">
        <h2>Detalles de la simulacion</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Nro</th>
                        <th>Clientes por hora</th>
                        <th>Tiempo de llegada</th>
                        <th>Tiempo de transaccion</th>
                        <th>Tiempo final de transaccion</th>
                        <th>Tiempo en sistemas</th>
                        <th>Clientes en el sistema</th>
                    </tr>
                </thead>
                <tbody id="tablaIteracion">
                    
                </tbody>
            </table>
        </div>
    
        <h1>Cantidad de Eventos</h1>
        <p id="iteraciones"></p>
        <br>
        <div class="ecuacion">
            <h1>Estadisticas</h1>
            <p id="promedioClientes">Cantidad promedio de Clientes: <span id="promCl"> </span></p>
            <p id="tiempoPromedio">Tiempo promedio en el sistema: <span id="temP"></span></p>
        </div>
        
        {{-- Grafico --}}
        <br>
        <h1>Tiempo Promedio</h1>
        <canvas id="graficoExponencial" width="150" height="200" style="margin-top: 20px;"></canvas>
        <h1>Clientes promedio en el sistema</h1>
        <canvas id="graficoUniforme" width="150" height="200" style="margin-top: 20px;"></canvas>
    </div>
    <br>
    <p class="parrafo" style="text-align: justify;">
        para esta simulacion se le aplica el siguiente trato a la funcion de origen de la distribucion y que esta pueda darse atraves de una variable de 0 a 1
        por el metodo de la transformada inversa que genera el valor acumulado de probabilidad q tiene cada funcion la funcion acumulada se optiene a traves de una integral
        que transforma a la funcion de densidad(casos probables k)a su forma acumulada lo cual nos da eventos simulados atraves de la probabilidad acumulada de dichos eventos.
    </p>
    <h2>Distribución de Poisson</h2>
    <div style="display: flex; justify-content: space-around;">
        <div style="width: 30%;">
            <p>Función de Densidad de Probabilidad (pdf):</p>
            $$ P(X = k) = \frac{\lambda^k e^{-\lambda}}{k!} $$
        </div>
        <div style="width: 30%;">
            <p>Función de Distribución Acumulada (cdf):</p>
            $$ P(X \le k) = e^{-\lambda} \sum_{i=0}^k \frac{\lambda^i}{i!} $$
            <p>Para \( t \) y \( t + \Delta t \):</p>
            $$ P(T \le t + \Delta t) = 1 - e^{-\lambda (t + \Delta t)} $$
        </div>
        <div style="width: 30%;">
            <p>Transformada Inversa:</p>
            $$ T = -\frac{1}{\lambda} \ln(1 - U) $$
        </div>
    </div>

    <h2>Distribución Uniforme</h2>
    <div style="display: flex; justify-content: space-around;">
        <div style="width: 30%;">
            <p>Función de Densidad de Probabilidad (pdf):</p>
            $$ 
            f(x) = 
            \begin{cases} 
            \frac{1}{b-a} & \text{si } a \le x \le b \\
            0 & \text{en otro caso}
            \end{cases} 
            $$
        </div>
        <div style="width: 30%;">
            <p>Función de Distribución Acumulada (cdf):</p>
            $$ 
            F(x) = 
            \begin{cases} 
            0 & \text{si } x < a \\
            \frac{x-a}{b-a} & \text{si } a \le x \le b \\
            1 & \text{si } x > b
            \end{cases} 
            $$
        </div>
        <div style="width: 30%;">
            <p>Transformada Inversa:</p>
            $$ X = a + (b - a)U $$
        </div>
    </div>


    <div class="botones">
        <a href="{{route('ej2.edit')}}" class="btn btn-primary">Personalizar problema</a>
        
            <button class="btn btn-secondary" id="rehacer">Simular nuevamente</button>
        
    </div>

    <script> 
        
        document.addEventListener("DOMContentLoaded", function() {
            var clientes = 40; // Ejemplo de valor para clientes
            var maxHora = 1; // Ejemplo de valor para maxHora
            var cajeros = 3; // Ejemplo de valor para cajeros  
            simular(clientes, maxHora, cajeros);

        });

    
document.getElementById('rehacer').addEventListener('click', function () {
        var clientes = 40; // Ejemplo de valor para clientes
        var maxHora = 1; // Ejemplo de valor para maxHora
        var cajeros = 3; // Ejemplo de valor para cajeros  
        simular(clientes, maxHora, cajeros);

        
    }
);


    function simular(cliente, maxHora, cajeros) {
        var cantClientes = 0;
        const poissonRange = calculatePoissonRange(cliente);
        const previousCumulativeValue = findPreviousK(poissonRange);
    
        var contador = 0;
        var resultados = [];
        var llegadaAcumulativa = "00:00:00"; // Inicializamos la llegada acumulativa como tiempo en formato hh:mm:ss
        var menorResultado3 = null; // Variable para almacenar el menor resultado3 de las últimas 3 simulaciones
    
        while (contador < previousCumulativeValue) {
            // Generar un valor aleatorio entre 0 y 1
            var randomico = Math.random();
    
            // Calcular el resultado usando la fórmula dada
            var resultado = (-1 / (cliente / 60)) * Math.log(1 - randomico);
            console.log("Resultado:", resultado);
            var tiempoResultado = convertirDiasAHMS(resultado / 1440);
    
            llegadaAcumulativa = sumarTiempos(llegadaAcumulativa, tiempoResultado);
            console.log("Resultado en formato de tiempo:", tiempoResultado);
    
            // Generar un valor aleatorio entre 0 y 1 para L5
            var L5 = Math.random();
            var resultado2 = 0;
            // Definir los valores de B$2 y C$2 (rangos de tiempo en cajero)
            var B2 = 0; // Ejemplo de valor mínimo de tiempo en cajero
            var C2 = maxHora; // Convertir maxHora de horas a segundos
    
            if (L5 > 0) {
                resultado2 = B2 + ((C2 - B2) * L5);
            }
            console.log("Resultado 2:", resultado2);
            // Convertir resultado2 a formato de tiempo 00:00:00
            var tiempoResultado2 = convertirDiasAHMS(resultado2 / 1440);
            console.log("Resultado 2 en formato de tiempo:", tiempoResultado2);
    
            // Calcular resultado3
            var ultimosResultados3 = [];
            var resultado3 = null;
            if (contador >= cajeros) {
                ultimosResultados3 = resultados.slice(-cajeros).map(item => item.resultado3);
                var menorDeUltimosResultados3 = encontrarMenorTiempo(ultimosResultados3);
    
                // Verificar si menorDeUltimosResultados3 es mayor que llegadaAcumulativa
                if (compararTiempos(menorDeUltimosResultados3, llegadaAcumulativa) > 0) {
                    // Si mi resultado es menor que el menor de los últimos resultados3
                    if (compararTiempos(llegadaAcumulativa, menorDeUltimosResultados3) < 0) {
                        resultado3 = sumarTiempos(tiempoResultado2, menorDeUltimosResultados3);
                    } else {
                        resultado3 = sumarTiempos(llegadaAcumulativa, tiempoResultado2);
                    }
                } else {
                    resultado3 = sumarTiempos(llegadaAcumulativa, tiempoResultado2);
                }
            } else {
                ultimosResultados3 = resultados.slice(-contador).map(item => item.resultado3);
    
                resultado3 = sumarTiempos(llegadaAcumulativa, tiempoResultado2);
            }
    
            console.log("Resultado 3:", resultado3);
    
            // Calcular el número de clientes en el cajero
            var clientesEnCajero = ultimosResultados3.filter(tiempo => compararTiempos(tiempo, llegadaAcumulativa) > 0).length;
    
            // Calcular el tiempo de servicio
            var tiempoDeServicio = restarTiempos(resultado3, llegadaAcumulativa);
    
            // Almacenar el resultado3 actual en el arreglo de resultados
            resultados.push({
                resultado: llegadaAcumulativa,
                resultado2: tiempoResultado2,
                resultado3: resultado3,
                clientesEnCajero: clientesEnCajero,
                tiempoDeServicio: tiempoDeServicio
            });
    
            // Actualizar el menor resultado3 de las últimas 3 simulaciones
            if (contador >= cajeros) {
                menorResultado3 = Math.min(...resultados.slice(-cajeros).map(item => item.resultado3));
            } else {
                menorResultado3 = resultado3;
            }
    
            contador++;
        }
    
        console.log("Resultados de todas las simulaciones:", resultados);
        construirTabla(resultados);
        calcularPromedios(resultados);
        crearGraficos(resultados);
    }
    
    function calcularPromedios(resultados) {
        const totalClientes = resultados.reduce((total, resultado) => total + resultado.clientesEnCajero, 0);
        const totalTiempoEnSistema = resultados.reduce((total, resultado) => {
            return total + convertirHMSToDias(resultado.tiempoDeServicio) * 24 * 60;
        }, 0);
        
        const promedioClientes = totalClientes / resultados.length;
        const tiempoPromedio = totalTiempoEnSistema / resultados.length;
        
        document.getElementById('promCl').textContent = Math.ceil(promedioClientes);
        document.getElementById('temP').textContent = tiempoPromedio.toFixed(2);
    }
    
    function convertirHMSToDias(tiempo) {
        const partes = tiempo.split(':').map(Number);
        return (partes[0] / 24) + (partes[1] / 1440) + (partes[2] / 86400);
    }

    function crearGraficos(resultados) {
        const ctxExponencial = document.getElementById('graficoExponencial').getContext('2d');
        const ctxUniforme = document.getElementById('graficoUniforme').getContext('2d');
    
        // Convertir el tiempo de servicio a minutos
        const tiemposDeServicio = resultados.map(resultado => convertirHMSToMinutos(resultado.tiempoDeServicio));
    
        // Obtener la cantidad de clientes en el sistema
        const clientesEnSistema = resultados.map((_, index) => index + 1); // Indice de iteración para el eje X
    
        // Crear el gráfico de tiempo de servicio vs clientes
        new Chart(ctxExponencial, {
            type: 'line',
            data: {
                labels: clientesEnSistema,
                datasets: [{
                    label: 'Tiempo de Servicio',
                    data: tiemposDeServicio,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false,
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Clientes'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Tiempo de Servicio (minutos)'
                        }
                    }
                }
            }
        });
    
        // Crear el gráfico de clientes en el sistema vs tiempo de servicio
        const clientesPorCajero = resultados.map(resultado => resultado.clientesEnCajero);
    
        new Chart(ctxUniforme, {
            type: 'line',
            data: {
                labels: clientesEnSistema,
                datasets: [{
                    label: 'Clientes en Sistema',
                    data: clientesPorCajero,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1,
                    fill: false,
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Cajeros'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Clientes en Sistema'
                        }
                    }
                }
            }
        });
    }
    
    function convertirHMSToMinutos(hms) {
        const [hours, minutes, seconds] = hms.split(':').map(Number);
        return hours * 60 + minutes + seconds / 60;
    }
    
    
    
    function restarTiempos(tiempo1, tiempo2) {
        var [horas1, minutos1, segundos1] = tiempo1.split(':').map(Number);
        var [horas2, minutos2, segundos2] = tiempo2.split(':').map(Number);
    
        var totalSegundos1 = horas1 * 3600 + minutos1 * 60 + segundos1;
        var totalSegundos2 = horas2 * 3600 + minutos2 * 60 + segundos2;
    
        var totalSegundos = totalSegundos1 - totalSegundos2;
        if (totalSegundos < 0) totalSegundos = 0; // Evitar tiempos negativos
    
        var horas = Math.floor(totalSegundos / 3600);
        var minutos = Math.floor((totalSegundos % 3600) / 60);
        var segundos = totalSegundos % 60;
        return `${pad(horas)}:${pad(minutos)}:${pad(segundos)}`;
    }
    // Función para convertir días en segundos a formato hh:mm:ss
    function convertirDiasAHMS(dias) {
        var segundos = dias * 24 * 60 * 60;
        var horas = Math.floor(segundos / 3600);
        segundos %= 3600;
        var minutos = Math.floor(segundos / 60);
        segundos %= 60;
    
        return `${formatoDosDigitos(horas)}:${formatoDosDigitos(minutos)}:${formatoDosDigitos(segundos)}`;
    }
    
    // Función auxiliar para asegurarse de que los números tengan dos dígitos
    function formatoDosDigitos(numero) {
        return numero < 10 ? `0${numero}` : numero;
    }
    
    // Función para sumar dos tiempos en formato hh:mm:ss
    function sumarTiempos(tiempo1, tiempo2) {
        var [h1, m1, s1] = tiempo1.split(":").map(Number);
        var [h2, m2, s2] = tiempo2.split(":").map(Number);
    
        var segundosTotales = s1 + s2;
        var minutosExtra = Math.floor(segundosTotales / 60);
        segundosTotales %= 60;
    
        var minutosTotales = m1 + m2 + minutosExtra;
        var horasExtra = Math.floor(minutosTotales / 60);
        minutosTotales %= 60;
    
        var horasTotales = h1 + h2 + horasExtra;
    
        return `${formatoDosDigitos(horasTotales)}:${formatoDosDigitos(minutosTotales)}:${formatoDosDigitos(segundosTotales)}`;
    }
    
    function compararTiempos(tiempo1, tiempo2) {
        var [horas1, minutos1, segundos1] = tiempo1.split(':').map(Number);
        var [horas2, minutos2, segundos2] = tiempo2.split(':').map(Number);
    
        var totalSegundos1 = horas1 * 3600 + minutos1 * 60 + segundos1;
        var totalSegundos2 = horas2 * 3600 + minutos2 * 60 + segundos2;
        return totalSegundos1 - totalSegundos2;
    }
    
    function encontrarMenorTiempo(tiempos) {
        return tiempos.reduce((menor, tiempo) => compararTiempos(menor, tiempo) < 0 ? menor : tiempo);
    }
    // Función para calcular la distribución de Poisson
    function calculatePoissonRange(lambda) {
        var probabilities = [];
        var cumulativeProbability = 0;
        var k = 0;
    
        while (cumulativeProbability < 0.9999) { // Hasta que la probabilidad acumulada sea muy cercana a 1
            var probability = poissonProbability(lambda, k);
            cumulativeProbability += probability;
    
            var roundedProbability = parseFloat(probability.toFixed(2));
            var roundedCumulativeProbability = parseFloat(cumulativeProbability.toFixed(2));
    
            if (roundedProbability !== 0.000) {
                probabilities.push({
                    k: k,
                    probability: roundedProbability,
                    cumulativeProbability: roundedCumulativeProbability
                });
            }
    
            k++;
        }
        return probabilities;
    }
    
    // Función para calcular la probabilidad de Poisson
    function poissonProbability(lambda, k) {
        return (Math.pow(lambda, k) * Math.exp(-lambda)) / factorial(k);
    }
    
    // Función para calcular el factorial
    function factorial(n) {
        if (n === 0) {
            return 1;
        }
        return n * factorial(n - 1);
    }
    
    // Función auxiliar para encontrar el valor de K anterior al que supera el acumulado
    function findPreviousK(probabilities) {
        var randomValue = Math.random();
        var previousK = -1;
    
        for (var i = 0; i < probabilities.length; i++) {
            if (randomValue <= probabilities[i].cumulativeProbability) {
                return previousK;
            }
            previousK = probabilities[i].k;
        }
    
        return previousK; // Por si el valor random es muy cercano a 1
    }
    
    // Ejemplo de uso
    
    
    
    
    
        function convertirHMSToDias(tiempo) {
            // Dividir la cadena de tiempo en partes de horas, minutos y segundos
            var partes = tiempo.split(':');
            var horas = parseInt(partes[0], 10);
            var minutos = parseInt(partes[1], 10);
            var segundos = parseInt(partes[2], 10);
    
            // Convertir todo a días
            var totalHoras = horas + (minutos / 60) + (segundos / 3600);
            var dias = totalHoras / 24;
    
            return dias;
        }
        function obtenerMenorTiempo(tiemos) {
            // Función para convertir un tiempo 'HH:mm:ss' a segundos totales
            function tiempoASegundos(tiempo) {
                const partes = tiempo.split(':').map(Number);
                return partes[0] * 3600 + partes[1] * 60 + partes[2];
            }
    
            // Convertir todos los tiempos a segundos y encontrar el mínimo
            const segundos = tiemos.map(tiempoASegundos);
            const menorSegundo = Math.min(...segundos);
    
            // Convertir el menor tiempo de segundos nuevamente a formato 'HH:mm:ss'
            const indiceMenor = segundos.indexOf(menorSegundo);
            return tiemos[indiceMenor];
        }
    
        // Función para convertir días a horas, minutos y segundos
        function convertirDiasAHMS(dias) {
            var horasTotales = dias * 24;
            var horas = Math.floor(horasTotales);
            var minutosTotales = (horasTotales - horas) * 60;
            var minutos = Math.floor(minutosTotales);
            var segundosTotales = (minutosTotales - minutos) * 60;
            var segundos = Math.round(segundosTotales);
    
            if (segundos === 60) {
                minutos += 1;
                segundos = 0;
            }
            if (minutos === 60) {
                horas += 1;
                minutos = 0;
            }
    
            return `${String(horas).padStart(2, '0')}:${String(minutos).padStart(2, '0')}:${String(segundos).padStart(2, '0')}`;
        }
    
        function pad(num) {
        return num.toString().padStart(2, '0');
    }
        // Función para sumar tiempos en formato hh:mm:ss
        function sumarTiempos(tiempo1, tiempo2) {
            var tiempo1Split = tiempo1.split(":");
            var tiempo2Split = tiempo2.split(":");
    
            var horas = parseInt(tiempo1Split[0]) + parseInt(tiempo2Split[0]);
            var minutos = parseInt(tiempo1Split[1]) + parseInt(tiempo2Split[1]);
            var segundos = parseInt(tiempo1Split[2]) + parseInt(tiempo2Split[2]);
    
            if (segundos >= 60) {
                minutos += Math.floor(segundos / 60);
                segundos %= 60;
            }
            if (minutos >= 60) {
                horas += Math.floor(minutos / 60);
                minutos %= 60;
            }
    
            return `${String(horas).padStart(2, '0')}:${String(minutos).padStart(2, '0')}:${String(segundos).padStart(2, '0')}`;
        }
    
    function convertirDiasAHMS(dias) {
        // Convertir días a horas
        var horasTotales = dias * 24;
        var horas = Math.floor(horasTotales);
    
        // Obtener los minutos de la parte decimal de las horas
        var minutosTotales = (horasTotales - horas) * 60;
        var minutos = Math.floor(minutosTotales);
    
        // Obtener los segundos de la parte decimal de los minutos
        var segundosTotales = (minutosTotales - minutos) * 60;
        var segundos = Math.round(segundosTotales);
    
        // Si los segundos son 60, incrementar los minutos y reiniciar los segundos
        if (segundos === 60) {
            minutos += 1;
            segundos = 0;
        }
    
        // Si los minutos son 60, incrementar las horas y reiniciar los minutos
        if (minutos === 60) {
            horas += 1;
            minutos = 0;
        }
    
        // Retornar el resultado en formato hh:mm:ss
        return String(horas).padStart(2, '0') + ':' + String(minutos).padStart(2, '0') + ':' + String(segundos).padStart(2, '0');
    }
    
    function factorial(n) {
        if (n === 0) {
            return 1;
        }
        return n * factorial(n - 1);
    }
    
    function poissonProbability(lambda, k) {
        return (Math.pow(lambda, k) * Math.exp(-lambda)) / factorial(k);
    }
    
    function calculatePoissonRange(lambda) {
        const probabilities = [];
        let cumulativeProbability = 0;
        let k = 0;
    
        while (cumulativeProbability < 0.9999) { // Hasta que la probabilidad acumulada sea muy cercana a 1
            let probability = poissonProbability(lambda, k);
            cumulativeProbability += probability;
    
            let roundedProbability = parseFloat(probability.toFixed(2));
            let roundedCumulativeProbability = parseFloat(cumulativeProbability.toFixed(2));
    
            if (roundedProbability !== 0.000) {
                probabilities.push({
                    k: k,
                    probability: roundedProbability,
                    cumulativeProbability: roundedCumulativeProbability
                });
            }
    
            k++;
        }
        return probabilities;
    }
    
    function findPreviousK(probabilities) {
        const randomValue = parseFloat(Math.random().toFixed(3));
        console.log("Random Value:", randomValue);
        let previousK = -1;
    
        for (let i = 0; i < probabilities.length; i++) {
            if (randomValue <= probabilities[i].cumulativeProbability) {
                return previousK;
            }
            previousK = probabilities[i].k;
        }
    
        return previousK; // Por si el valor random es muy cercano a 1
    }


    function construirTabla(resultados) {
        const tbody = document.getElementById('tablaIteracion');
        tbody.innerHTML = ''; // Limpiar el contenido existente
    
        resultados.forEach((resultado, index) => {
            const fila = document.createElement('tr');
    
            // Crear las celdas de la fila
            const celdaNro = document.createElement('td');
            celdaNro.textContent = index + 1;
    
            const celdaClientesPorHora = document.createElement('td');
            celdaClientesPorHora.textContent = resultado.resultado;
    
            const celdaTiempoLlegada = document.createElement('td');
            celdaTiempoLlegada.textContent = resultado.resultado;
    
            const celdaTiempoTransaccion = document.createElement('td');
            celdaTiempoTransaccion.textContent = resultado.resultado2;
    
            const celdaTiempoFinalTransaccion = document.createElement('td');
            celdaTiempoFinalTransaccion.textContent = resultado.resultado3;
    
            const celdaTiempoEnSistema = document.createElement('td');
            celdaTiempoEnSistema.textContent = resultado.tiempoDeServicio;
    
            const celdaClientesEnSistema = document.createElement('td');
            celdaClientesEnSistema.textContent = resultado.clientesEnCajero;
    
            // Añadir las celdas a la fila
            fila.appendChild(celdaNro);
            fila.appendChild(celdaClientesPorHora);
            fila.appendChild(celdaTiempoLlegada);
            fila.appendChild(celdaTiempoTransaccion);
            fila.appendChild(celdaTiempoFinalTransaccion);
            fila.appendChild(celdaTiempoEnSistema);
            fila.appendChild(celdaClientesEnSistema);
    
            // Añadir la fila al tbody
            tbody.appendChild(fila);
        });
    }
    
    </script>
    @endsection

