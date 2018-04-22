<?php

print('<h1 class="titulos">Grupos</h1>');

$groups_controller = new GroupsController();

$groups = $groups_controller->get();

if( empty($groups) ) {
  print('
    <article class="datos-usuario">
        <p class="datos-acerca">No hay grupos</p>
    </article>
  ');
} else {

$template_groups = '
  <div class="agregar">
    <form method="POST">
      <input type="hidden" name="r" value="group-add">
      <input class="button add" type="submit" value="Agregar Grupo">
    </form>
  </div>
  <table class="registros">
      <tr>
        <th>Id</th>
        <th>Grupo</th>
        <th colspan="2">Opciones</th>
      </tr> ';
    for($n = 0; $n < count($groups); $n++ ) {
      $template_groups .=
      '<tr>
        <td>'. $groups[$n]['group_id']. '</td>
        <td>'. $groups[$n]['group_name'] .'</td>
        <td>
            <form method="POST">
              <input type="hidden" name="r" value="group-edit">
              <input type="hidden" name="group_id" value="'. $groups[$n]['group_id'] .'">
              <input class="button edit" type="submit" value="Editar">
            </form>
        </td>
        <td>
            <form method="POST">
              <input type="hidden" name="r" value="group-delete">
              <input type="hidden" name="group_id" value="'. $groups[$n]['group_id'] .'">
              <input class="button delete" type="submit" value="Eliminar">
            </form>
        </td>
      </tr>';
    }

  $template_groups .= '
  </table>';

  print($template_groups);

}
