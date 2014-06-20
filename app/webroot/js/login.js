/* 
 * Copyright 2014 UPES Grupo#2 Ingenieria en Ciencias de la Computación.
 * [Iddo José Claros - José Carlos Escobar - Carlos Amaury Tejada]
 */
$(document).ready(function(){
    vAlign();
});
$(window).resize(function(){vAlign();});
function vAlign()
{
    var h = ($(document).height() / 2) -125;
    $("#login").css("margin-top",h);
}