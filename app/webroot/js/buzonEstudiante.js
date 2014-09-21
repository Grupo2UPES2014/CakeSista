/* 
 * Copyright 2014 UPES Grupo#2 Ingenieria en Ciencias de la Computación.
 * [Iddo José Claros - José Carlos Escobar - Carlos Amaury Tejada]
 */
$(document).ready(function () {
    $('.finalizado').click(function () {
        window.open($('.SeguimientoGrid').data('appname') + 'tareas/mandamiento/' + $(this).data('id'), 'Mandamiento', 'menubar = no, toolbar = no, scrollbars = yes, width = 600, height = 800,addressbar=no');
    }).mouseover(function () {
        $(this).css('cursor', 'pointer');
    });
});

