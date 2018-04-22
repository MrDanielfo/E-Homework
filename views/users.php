<?php

print('<h1 class="titulos">Usuarios</h1>');

$users_controller = new UsersController();

$users = $users_controller->get();

if( empty($users) ) {
  print('
    <article class="datos-usuario">
        <p class="datos-acerca">No hay Usuarios</p>
    </article>
  ');
} else {

$template_users = '
  <div class="agregar">
    <form method="POST">
      <input type="hidden" name="r" value="user-add">
      <input class="button add" type="submit" value="Agregar Usuario">
    </form>
  </div>
  <table class="registros">
      <tr>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>E-mail</th>
        <th>Número Celular</th>
        <th>Rol</th>
        <th colspan="2">Opciones</th>
      </tr> ';
    for($n = 0; $n < count($users); $n++ ) {
      $template_users .=
      '<tr>
        <td>'. $users[$n]['user']. '</td>
        <td>'. $users[$n]['name'] .'</td>
        <td>'. $users[$n]['email']. '</td>
        <td>'. $users[$n]['cellphone'] .'</td>
        <td>'. $users[$n]['role'] .'</td>
        <td>
            <form method="POST">
              <input type="hidden" name="r" value="user-edit">
              <input type="hidden" name="user" value="'. $users[$n]['user'] .'">
              <input class="button edit" type="submit" value="Editar">
            </form>
        </td>
        <td>
            <form method="POST">
              <input type="hidden" name="r" value="user-delete">
              <input type="hidden" name="user" value="'. $users[$n]['user'] .'">
              <input class="button delete" type="submit" value="Eliminar">
            </form>
        </td>
      </tr>';
    }

  $template_users .= '
  </table>';

  print($template_users);

}
