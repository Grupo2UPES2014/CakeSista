<h2><?php echo $tarea['Cattramite']['nombre']; ?></h2>
<strong>Solicitante:</strong> <?php echo $tarea['Estudiante']['nombres'] . ' ' . $tarea['Estudiante']['apellido1'] . ' ' . $tarea['Estudiante']['apellido2']; ?><br>
<strong>Tarea:</strong> <?php echo $tarea['Cattarea']['nombre']; ?><br>
<strong>Estado de Tarea:</strong> <?php echo $estados[$tarea['Tarea']['estado']]; ?><br>
<a href="<?php echo Router::url(array('controller' => 'tareas', 'action' => $tipos[$tarea['Cattarea']['tipo']][1], $tarea['Tarea']['id'])); ?>"><button>Recibir</button></a>