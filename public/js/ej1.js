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