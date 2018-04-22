<?php

print('<h1 class="titulos">Tareas</h1>');

$homeworks_controller = new HomeworksController();

$homeworks = $homeworks_controller->get();

if( empty($homeworks) ) {
  print('
    <article class="datos-usuario">
        <p class="datos-acerca">No hay Tareas</p>
    </article>
  ');
} else {

$template_homeworks = '
  <div class="agregar">
    <form method="POST">
      <input type="hidden" name="r" value="homework-add">
      <input class="button add" type="submit" value="Agregar Tarea">
    </form>
  </div>
  <table class="registros">
      <tr>
        <th>Id</th>
        <th>Tarea</th>
        <th>Materia</th>
        <th>Prioridad</th>
        <th>Estatus</th>
        <th>Tiempo de Entrega</th>
        <th>Grupo Asignado</th>
        <th colspan="3">Opciones</th>
      </tr> ';
    for($n = 0; $n < count($homeworks); $n++ ) {
      $template_homeworks .=
      '<tr>
        <td>'. $homeworks[$n]['hw_id']. '</td>
        <td>'. $homeworks[$n]['title'] .'</td>
        <td>'. $homeworks[$n]['signature']. '</td>
        <td>'. $homeworks[$n]['priority'] .'</td>
        <td>'. $homeworks[$n]['status']. '</td>
        <td>'. $homeworks[$n]['to_finish'] .'</td>
        <td>'. $homeworks[$n]['group_name'] .'</td>
        <td>
            <form method="POST">
              <input type="hidden" name="r" value="homework-show">
              <input type="hidden" name="hw_id" value="'. $homeworks[$n]['hw_id'] .'">
              <input class="button show" type="submit" value="Mostrar">
            </form>
        </td>
        <td>
            <form method="POST">
              <input type="hidden" name="r" value="homework-edit">
              <input type="hidden" name="hw_id" value="'. $homeworks[$n]['hw_id'] .'">
              <input class="button edit" type="submit" value="Editar">
            </form>
        </td>
        <td>
            <form method="POST">
              <input type="hidden" name="r" value="homework-delete">
              <input type="hidden" name="hw_id" value="'. $homeworks[$n]['hw_id'] .'">
              <input class="button delete" type="submit" value="Eliminar">
            </form>
        </td>
      </tr>';
    }

  $template_homeworks .= '
  </table>';

  print($template_homeworks);
}
