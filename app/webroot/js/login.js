/* 
 * Copyright 2014 UPES Grupo#2 Ingenieria en Ciencias de la Computación.
 * [Iddo José Claros - José Carlos Escobar - Carlos Amaury Tejada]
 */
$(document).ready(function () {
    vAlign();
    $('#tut').click(function () {
        //$('#modal').css('visibility', 'visible');
        $('#tituloModal').html($(this).data('titulo'));
        var estructura = '<source src="vid/' + $(this).data('fuente') + '.webm" type="video/webm">\n\
<source src="vid/' + $(this).data('fuente') + '.mp4" type="video/mp4">\n\
<source src="vid/' + $(this).data('fuente') + '.ogv" type="video/ogg">\n\
Tu navegador no soporta videos para HTML5.'
        $('#vid').html(estructura);
        $('#modal').fadeIn(300);
    });
    $('#closeModal').click(function () {
        $('#modal').fadeOut(300);
        $('#vid').get(0).pause();
    });
});
$(window).resize(function () {
    vAlign();
});
function vAlign()
{
    var h = ($(document).height() / 2) - 125;
    $("#login").css("margin-top", h);
}