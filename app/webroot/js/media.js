/* 
 * Copyright 2014 UPES Grupo#2 Ingenieria en Ciencias de la Computación.
 * [Iddo José Claros - José Carlos Escobar - Carlos Amaury Tejada]
 */
$(document).ready(function() {
    $("#mediacenter a").click(function(e) {
        e.preventDefault();
        $('#video video').fadeOut();
        estructura = '<h2>' + $(this).data('titulo') + '</h2>\n\
        <video controls="controls" poster="img/poster.png" preload="metadata" width="90%" style="display: none">\n\
            <source src="vid/' + $(this).data('video') + '.webm" type="video/webm">\n\
            <source src="vid/' + $(this).data('video') + '.mp4" type="video/mp4">\n\
            <source src="vid/' + $(this).data('video') + '.ogv" type="video/ogg">\n\
            Tu navegador no soporta videos para HTML5.\n\
        </video>';
        $('#video').html(estructura);
        $('#video video').fadeIn();

    });

});

