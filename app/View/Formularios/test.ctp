<h2>Solicitud de constancia de estudios</h2>
<form action="/CakeSista/formularios/add" id="FormularioAddForm" method="post" accept-charset="utf-8">
    <div style="display:none;"><input name="_method" value="POST" type="hidden"></div>
    <input id="FormularioCatformulario_id" name="data[Formulario][catformulario_id]" value="<?php echo $formulario['Catformulario']['id'] ?>" type="hidden">
    <input id="FormularioTarea_id" name="data[Formulario][tarea_id]" value="<?php echo $formulario['Tarea']['id'] ?>" type="hidden">
    <input id="FormularioTramite_id" name="data[Formulario][tramite_id]" value="<?php echo $formulario['Tarea']['tramite_id'] ?>" type="hidden">
    <input id="FormCampo1" name="data[Form][campo1]">
    <input id="FormCampo2" name="data[Form][campo2]">
    <input id="FormCampo3" name="data[Form][campo3]">
    <input id="FormCampo4" name="data[Form][campo4]">
    <select name="data[Form][campo5]" id="FormCampo5" required="required">
        <option value="">Selecciona un estado</option>
        <option value="1">Activo</option>
        <option value="2">Bloqueado</option>
    </select>
    <div class="submit"><input value="fin" type="submit"></div>
</form>