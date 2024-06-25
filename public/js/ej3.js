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

//grafico poisson
const chart = LightweightCharts.createChart(document.getElementById('graficaEj3'), {
    
    layout: {
        backgroundColor: '#ffffff',
        textColor: '#000000',
    },
    grid: {
        vertLines: {
            color: '#e0e0e0',
        },
        horzLines: {
            color: '#e0e0e0',
        },
    },
    
    timeScale: {
        timeVisible: false,
        secondsVisible: true,
    },
});

const lineSeries = chart.addLineSeries({
    color: '#2196F3',
    lineWidth: 2,
});

const chartData = datosPoisson.map(point => ({ time: point.time + 1, value: point.value }));

lineSeries.setData(chartData);

chart.timeScale().fitContent();
//termina grafico poisson

//grafico exponencial
const chartOptions = { layout: { textColor: 'black', background: { type: 'solid', color: 'white' } } };
const chart2 = LightweightCharts.createChart(document.getElementById('graficoExponencial'), chartOptions);
const areaSeries = chart2.addAreaSeries({ lineColor: '#2962FF', topColor: '#2962FF', bottomColor: 'rgba(41, 98, 255, 0.28)' });

const exponentialData = datosExponencial.map((time, index) => ({ value: time, time: index + 1 }));
// console.log(exponentialData);

areaSeries.setData(exponentialData);

chart2.timeScale().fitContent();
//termina grafico exponencial

//grafico uniforme
const chartOptions3 = { layout: { textColor: 'black', background: { type: 'solid', color: 'white' } } };
const chart3 = LightweightCharts.createChart(document.getElementById('graficoUniforme'), chartOptions);
const areaSeries3 = chart3.addAreaSeries({ lineColor: '#FF5733', topColor: '#FF5733', bottomColor: 'rgba(41, 98, 255, 0.28)' });

const uniformData = datosUniforme.map((time, index) => ({ value: time, time: index }));
console.log(uniformData);

areaSeries3.setData(uniformData);

chart3.timeScale().fitContent();
//termina grafico uniforme

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
            lineSeries.setData(response.datosPoisson);
            
            const exponentialData2 = response.datosExponencial.map((time, index) => ({ value: time, time: index }));
            areaSeries.setData(exponentialData2);
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
