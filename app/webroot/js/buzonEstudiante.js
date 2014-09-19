/* 
 * Copyright 2014 UPES Grupo#2 Ingenieria en Ciencias de la Computación.
 * [Iddo José Claros - José Carlos Escobar - Carlos Amaury Tejada]
 */
$(document).ready(function () {
    $('.finalizado').click(function () {
        alert('localhost/CakeSista/tareas/mandamiento/' + $(this).data('id'));
        window.open('localhost/CakeSista/tareas/mandamiento/' + $(this).data('id'),"Homepage","resizable=no,status=yes,scrollbars=yes,height=970,width=945,menubar=yes,addressbar=no");
    }).mouseover(function () {
        $(this).css('cursor', 'pointer');
    });
});

