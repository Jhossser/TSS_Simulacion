function masInfo(){
    if($('#flechaInfo').css('transform') === 'none'){
        $('#flechaInfo').css('transform', 'rotate(180deg)');
    }else{
        $('#flechaInfo').css('transform', 'none');
    }
    
    $lista = $('#informacion');

    if ($lista.is(':visible')) {
        $lista.slideUp();
    } else {
        $lista.slideDown();
    }
}

//graficos
const ctxPoisson = document.getElementById('graficoPoisson');
const ctxExponential = document.getElementById('graficoExponencial');
const ctxUniform = document.getElementById('graficoUniforme');

//poisson
let poissonChart = new Chart(ctxPoisson, {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'Ocupación del Estacionamiento',
            data: [],
            borderColor: 'rgba(33, 150, 243, 1)',
            borderWidth: 2,
            fill: false
        }]
    },
    options: {
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Iteración'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Espacios Ocupados'
                }
            }
        }
    }
});
//termina poisson

//exponencial
let exponentialChart = new Chart(ctxExponential, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Tiempos Exponenciales (minutos)',
            data: [],
            backgroundColor: 'rgba(255, 87, 51, 0.6)',
            borderColor: 'rgba(255, 87, 51, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Iteración'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Tiempo (minutos)'
                }
            }
        }
    }
});
//termina exponenecial

//uniforme
let uniformChart = new Chart(ctxUniform, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Tiempos Uniformes (minutos)',
            data: [],
            backgroundColor: 'rgba(139, 195, 74, 0.6)',
            borderColor: 'rgba(139, 195, 74, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Iteración'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Tiempo (minutos)'
                }
            }
        }
    }
});
//termina uniforme

updateCharts(datosPoisson, datosExponencial, datosUniforme);

function updateCharts(iterations, exponentialTimes, uniformTimes) {
    const poissonLabels = iterations.map(item => item.time);
    const poissonData = iterations.map(item => item.value);
    console.log(poissonData);

    poissonChart.data.labels = poissonLabels;
    poissonChart.data.datasets[0].data = poissonData;
    poissonChart.update();

    const exponentialLabels = exponentialTimes.map((_, index) => index + 1);
    const uniformLabels = uniformTimes.map((_, index) => index + 1);

    exponentialChart.data.labels = exponentialLabels;
    exponentialChart.data.datasets[0].data = exponentialTimes;
    exponentialChart.update();

    uniformChart.data.labels = uniformLabels;
    uniformChart.data.datasets[0].data = uniformTimes;
    uniformChart.update();
}
//termina graficos

function rehacer(){
    $.ajax({
        url: "/ejercicio3/index",
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#porcentajePerdidos').text('Porcentaje de Clientes perdidos: '+response.porcentajePerdidos + '%');
            $('#probabilidadEspacioLibre').text('Probabilidad de encontrar espacio: '+response.probabilidadEspacioLibre);
            $('#promedioEspaciosLibres').text('Promedio de espacios libres: '+response.promedioEspaciosLibres);
            $('#iteraciones').text(response.iteraciones.length);

            let tableBody = '';
            $.each(response.iteraciones, function(index, iteracion) {
                tableBody += '<tr>';
                tableBody += '<td>' + Math.round(iteracion.time) + '</td>';
                tableBody += '<td>' + iteracion.event + '</td>';
                tableBody += '<td>' + iteracion.available_spaces + '</td>';
                tableBody += '<td>' + iteracion.occupied_spaces + '</td>';
                tableBody += '<td>' + iteracion.lost_customers + '</td>';
                tableBody += '</tr>';
            });

            $('#tablaIteracion').html(tableBody);
            
            updateCharts(response.datosPoisson, response.datosExponencial, response.datosUniforme);
        },
        error: function() {
            alert('Failed to run the simulation.');
        }
    });
}

function rehacerDatos(){
    var formData = $('#formEj3').serialize();

    $.ajax({
        url: "/ejercicio3/update",
        type: 'GET',
        data: formData,
        dataType: 'json',
        success: function(response) {
            $('#porcentajePerdidos').text('Porcentaje de Clientes perdidos: '+response.porcentajePerdidos + '%');
            $('#probabilidadEspacioLibre').text('Probabilidad de encontrar espacio: '+response.probabilidadEspacioLibre);
            $('#promedioEspaciosLibres').text('Promedio de espacios libres: '+response.promedioEspaciosLibres);
            $('#iteraciones').text(response.iteraciones.length);

            let tableBody = '';
            $.each(response.iteraciones, function(index, iteracion) {
                tableBody += '<tr>';
                tableBody += '<td>' + Math.round(iteracion.time) + '</td>';
                tableBody += '<td>' + iteracion.event + '</td>';
                tableBody += '<td>' + iteracion.available_spaces + '</td>';
                tableBody += '<td>' + iteracion.occupied_spaces + '</td>';
                tableBody += '<td>' + iteracion.lost_customers + '</td>';
                tableBody += '</tr>';
            });

            $('#tablaIteracion').html(tableBody);
            
        },
        error: function() {
            alert('Failed to run the simulation.');
        }
    });
}



// const chartOptions = { layout: { textColor: 'black', background: { type: 'solid', color: 'white' } } };
// const chart = LightweightCharts.createChart(document.getElementById('graficaEj3'), chartOptions);
// const lineSeries = chart.addAreaSeries({ ineColor: '#2962FF', topColor: '#2962FF', bottomColor: 'rgba(41, 98, 255, 0.28)' } );

// const data = [{ value: 0, time: 1642425322 }, { value: 8, time: 1642511722 }, { value: 10, time: 1642598122 }, { value: 20, time: 1642684522 }, { value: 3, time: 1642770922 }, { value: 43, time: 1642857322 }, { value: 41, time: 1642943722 }, { value: 43, time: 1643030122 }, { value: 56, time: 1643116522 }, { value: 46, time: 1643202922 }];

// lineSeries.setData(data);

// chart.timeScale().fitContent();
