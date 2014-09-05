$(document).ready(function(e) {
    renderMensajes();
    $("#logo").click(function(e) {
        home($(this).data('raiz'));
    });
});

function Mensaje(titulo, mensaje, tipo)
{
    $("#sistamensajes").removeClass("mnsgAlert mnsgError mnsgInfo mnsgOk");
    if (tipo >= 0 && tipo <= 3)
    {
        var clases = new Array(4);
        clases[0] = new Array("mnsgAlert", "icoAlert");//"Alerta";
        clases[1] = new Array("mnsgError", "icoError");//"error";
        clases[2] = new Array("mnsgInfo", "icoInfoBlue");//"Información";
        clases[3] = new Array("mnsgOk", "icoOK");//"Aprobatorio";
        $("#sistamensajes").html('<div class="ico mini ' + clases[tipo][1] + '"></div><strong>' + titulo + ':</strong> <span>' + mensaje + '</span>').addClass(clases[tipo][0]);
    }
}

function renderMensajes()
{
    if ($('#flashMessage').length > 0)
    {
        if ($('#flashMessage').closest('div').hasClass('OK'))
        {
            Mensaje($('#controller').html(), $('#flashMessage').closest('div').html(), 3);
        }
        if ($('#flashMessage').closest('div').hasClass('ERROR'))
        {
            Mensaje($('#controller').html(), $('#flashMessage').closest('div').html(), 1);
        }
        if ($('#flashMessage').closest('div').hasClass('ALERT'))
        {
            Mensaje($('#controller').html(), $('#flashMessage').closest('div').html(), 0);
        }
        if ($('#flashMessage').closest('div').hasClass('INFO'))
        {
            Mensaje($('#controller').html(), $('#flashMessage').closest('div').html(), 2);
        }
    }
}

function home(ruta)
{
    location.href = ruta;
}
