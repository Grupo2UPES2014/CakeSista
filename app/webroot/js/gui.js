$(document).ready(function(e){

});

function Mensaje(titulo,mensaje,tipo)
{
    $("#sistamensajes").removeClass("mnsgAlert mnsgError mnsgInfo mnsgOk");
    if(tipo != 4)
    {
        var clases = new Array(4);
        clases[0] = new Array("mnsgAlert","icoAlert");//"Alerta";
        clases[1] = new Array("mnsgError","icoError");//"error";
        clases[2] = new Array("mnsgInfo","icoInfoBlue");//"Información";
        clases[3] = new Array("mnsgOk","icoOK");//"Aprobatorio";
        $("#sistamensajes").html('<div class="ico mini '+clases[tipo][1]+'"></div><strong>'+titulo+':</strong><span>'+mensaje+'</span>').addClass(clases[tipo][0]);
    } 
}
