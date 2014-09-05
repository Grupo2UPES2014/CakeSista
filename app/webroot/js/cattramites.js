/* 
 * Copyright 2014 UPES Grupo#2 Ingenieria en Ciencias de la Computación.
 * [Iddo José Claros - José Carlos Escobar - Carlos Amaury Tejada]
 */
correlativo = 1;
$(document).ready(function(e) {
    $('#mas').click(function(ev) {
        ev.preventDefault();

        tarea = '<hr><input type="hidden" name="data[Cattarea][' + correlativo + '][correlativo]" value="' + (correlativo + 1) + '" id="Cattarea' + correlativo + 'Correlativo"/>\n\
            <div class="input text required">\n\
            <input name="data[Cattarea][' + correlativo + '][nombre]" placeholder="Nombre" maxlength="45" type="text" id="Cattarea' + correlativo + 'Nombre" required="required"/>\n\
            </div>\n\
            <div class="input text required">\n\
            <input name="data[Cattarea][' + correlativo + '][descripcion]" placeholder="Descripción" maxlength="100" type="text" id="Cattarea' + correlativo + 'Descripcion" required="required"/>\n\
            </div>\n\
            <select name="data[Cattarea][' + correlativo + '][tipo]" id="Cattarea' + correlativo + 'Tipo" required="required">\n\
            <option value="">Seleccione el Tipo</option>\n\
            <option value="1">Actividad</option>\n\
            <option value="2">Mandamiento</option>\n\
            <option value="3">documento</option>\n\
            <option value="4">formulario</option>\n\
            </select>\n\
            <div class="input select required">\n\
            <select name="data[Cattarea][' + correlativo + '][catcargo_id]" id="Cattarea' + correlativo + 'CatcargoId" required="required">\n\
            <option value="">Seleccione el cargo</option>\n\
            <option value="1">Secretaria decanatos</option>\n\
            <option value="2">Vocals</option>\n\
            <option value="3">Devs</option>\n\
            <option value="4">Bassist</option>\n\
            </select></div>';
        $('#tareas').append(tarea);
        correlativo++;
    });
});