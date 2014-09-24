/* 
 * Copyright 2014 UPES Grupo#2 Ingenieria en Ciencias de la Computación.
 * [Iddo José Claros - José Carlos Escobar - Carlos Amaury Tejada]
 */
$(document).ready(function () {
    $('.segMandamiento').closest('.finalizado').click(function () {
        window.open($('.SeguimientoGrid').data('appname') + 'tareas/mandamiento/' + $(this).data('id'), 'Mandamiento', 'menubar = no, toolbar = no, scrollbars = yes, width = 600, height = 800,addressbar=no');
    }).mouseover(function () {
        $(this).css('cursor', 'pointer');
    });

    $('.segDocumento').closest('.enproceso').click(function () {
        location.href = $('.SeguimientoGrid').data('appname') + 'tareas/documento/' + $(this).data('id');
        //window.open($('.SeguimientoGrid').data('appname') + 'tareas/documento/' + $(this).data('id'), 'Mandamiento', 'menubar = no, toolbar = no, scrollbars = yes, width = 600, height = 800,addressbar=no');
    }).mouseover(function () {
        $(this).css('cursor', 'pointer');
    });
});

