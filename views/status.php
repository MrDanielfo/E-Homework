<?php


print('<h1 class="titulos">Estado de las Tareas</h1>');

$status_controller = new StatusController();

$status = $status_controller->get();

if( empty($status) ) {
  print('
    <article class="datos-usuario">
        <p class="datos-acerca">No hay estados</p>
    </article>
  ');
} else {

$template_status = '
  <div class="agregar">
    <form method="POST">
      <input type="hidden" name="r" value="status-add">
      <input class="button add" type="submit" value="Agregar Estado">
    </form>
  </div>
  <table class="registros">
      <tr>
        <th>Id</th>
        <th>Estado de la Tarea</th>
        <th colspan="2">Opciones</th>
      </tr> ';
    for($n = 0; $n < count($status); $n++ ) {
      $template_status .=
      '<tr>
        <td>'. $status[$n]['status_id']. '</td>
        <td>'. $status[$n]['status'] .'</td>
        <td>
            <form method="POST">
              <input type="hidden" name="r" value="status-edit">
              <input type="hidden" name="status_id" value="'. $status[$n]['status_id'] .'">
              <input class="button edit" type="submit" value="Editar">
            </form>
        </td>
        <td>
            <form method="POST">
              <input type="hidden" name="r" value="status-delete">
              <input type="hidden" name="status_id" value="'. $status[$n]['status_id'] .'">
              <input class="button delete" type="submit" value="Eliminar">
            </form>
        </td>
      </tr>';
    }

  $template_status .= '
  </table>';

  print($template_status);

}
