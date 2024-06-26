

$("#btnMenu").click(function(){
    $('#menu').addClass("aparecer");
    $('#fondoGris').show();
});

$(document).on('click', function(event) {
    var $targetElement = $(event.target);
    var $menu = $('#menu');
    var $btnMenu = $('#btnMenu');

    // Verifica si el clic no fue dentro del div y el div está visible
    if ($menu.hasClass('aparecer') && !$menu.is($targetElement) && !$menu.has($targetElement).length && !$btnMenu.is($targetElement) && !$btnMenu.has($targetElement).length) {
        $menu.removeClass('aparecer');
        $('#fondoGris').hide();
    }
});

function simu(){
    if($('#flecha1').css('transform') === 'none'){
        $('#flecha1').css('transform', 'rotate(180deg)');
    }else{
        $('#flecha1').css('transform', 'none');
    }
    
    $lista = $('#sub1');

    if ($lista.is(':visible')) {
        $lista.slideUp();
    } else {
        $lista.slideDown();
    }
}
function hist(){
    if($('#flecha2').css('transform') === 'none'){
        $('#flecha2').css('transform', 'rotate(180deg)');
    }else{
        $('#flecha2').css('transform', 'none');
    }
}

function logout() {
    document.getElementById('logout-form').submit();
}
