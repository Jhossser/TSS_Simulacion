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