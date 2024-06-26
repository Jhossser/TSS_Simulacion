//graficos
const ctxNumCamiones = document.getElementById('graficoAsignaCosto');

let asignacionCostoChart = new Chart(ctxNumCamiones, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Costos - Asignaciones',
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
                    text: 'Numero de asignaciones'
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

updateCharts(tablaAsignadoCosto);

function updateCharts(tablaAsignadoCosto) {
    const numCamionesY = tablaAsignadoCosto.map(item => item.costo);
    const numCamionesX = tablaAsignadoCosto.map(item => item.asignado);

    asignacionCostoChart.data.labels = numCamionesX;
    asignacionCostoChart.data.datasets[0].data = numCamionesY;
    asignacionCostoChart.update();

}
//termina graficos

//rehacer simulacion
function rehacer(){
    var formData = $('#formEj3').serialize();

    $.ajax({
        url: "/ejercicio5/index",
        type: 'GET',
        data: formData,
        dataType: 'json',
        success: function(response) {
            $('#asignacionMinimo').text(response.asignacionMinimo + ' maquinas');
            $('#costoMinimo2').text('Bs. '+response.costoMinimo2);

            let tableBody = '';
            $.each(response.tablaAsignadoCosto, function(index, asignadoCosto) {
                tableBody += '<tr>';
                tableBody += '<td>' + asignadoCosto.asignado + '</td>';
                tableBody += '<td>' + asignadoCosto.costo + '</td>';
                tableBody += '</tr>';
            });
            
            $('#tablaIteracion').html(tableBody);
            
            updateCharts(response.tablaAsignadoCosto);
        },
        error: function() {
            alert('Failed to run the simulation.');
        }
    });
}