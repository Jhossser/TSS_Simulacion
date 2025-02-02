
//graficos
const ctxNumCamiones = document.getElementById('graficoNumCamiones');

let NumCamionesChart = new Chart(ctxNumCamiones, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Costos - Numero de camiones',
            data: [],
            borderColor: 'rgba(33, 150, 243, 1)',
            borderWidth: 2,
            fill: true
        }]
    },
    options: {
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Numero de camiones'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Costo'
                }
            }
        }
    }
});

updateCharts(costoTotalPorCamion);

function updateCharts(costoTotalPorCamion) {
    const numCamionesY = costoTotalPorCamion.map(item => item.costo);
    const numCamionesX = costoTotalPorCamion.map(item => item.camiones);

    NumCamionesChart.data.labels = numCamionesX;
    NumCamionesChart.data.datasets[0].data = numCamionesY;
    NumCamionesChart.update();

}
//termina graficos


//rehacer simulacion
function rehacer(){
    var formData = $('#formEj3').serialize();

    $.ajax({
        url: "/ejercicio4/index",
        type: 'GET',
        data: formData,
        dataType: 'json',
        success: function(response) {
            $('#camionesConCostoMinimo').text(response.camionesConCostoMinimo + ' camiones');
            $('#costoMinimo2').text('Bs. '+response.costoMinimo2);

            let tableBody = '';
            $.each(response.transporteDia, function(index, tranporteDelDia) {
                tableBody += '<tr>';
                tableBody += '<td>' + tranporteDelDia.dia + '</td>';
                tableBody += '<td>' + response.prodDia[tranporteDelDia.dia-1] + '</td>';
                tableBody += '<td>' + tranporteDelDia.camiones + '</td>';
                tableBody += '<td>' + tranporteDelDia.transportado + '</td>';
                tableBody += '</tr>';
            });
            
            $('#tablaIteracion').html(tableBody);
            
            updateCharts(response.costoTotalPorCamion);
        },
        error: function() {
            alert('Failed to run the simulation.');
        }
    });
}