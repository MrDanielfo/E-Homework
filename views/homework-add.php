<?php

if( $_POST['r'] == 'homework-add' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {

/* llamado de signatures controller */

  $signatures_controller = new SignaturesController();
  $signature = $signatures_controller->get();
  $signature_selected = '';

for ($n= 0; $n < count($signature); $n++) {
  $signature_selected .= '<option value="' . $signature[$n]['signature_id'] . '">' . $signature[$n]['signature'] . '</option>';
}

/* llamado de status controller */

$status_controller = new StatusController();
$status = $status_controller->get();

$status_selected = '';

for ($n= 0; $n < count($status); $n++) {
  $status_selected .= '<option value="' . $status[$n]['status_id'] . '">' . $status[$n]['status'] . '</option>';
}

/* llamado de groups_controller */

$groups_controller = new GroupsController();
$group = $groups_controller->get();

$group_selected = '';

for ($n= 0; $n < count($group); $n++) {
  $group_selected .= '<option value="' . $group[$n]['group_id'] . '">' . $group[$n]['group_name'] . '</option>';
}

/* agregar tarea */

  printf('
  <div class="contenedor-login">
      <h2 class="login  add">Agregar Tarea</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <input type="text" class="text" name="hw_id" placeholder="ID P/E(0002)" required>
          </div>
          <div class="caja">
            <input type="text" class="text" name="title" placeholder="Título" required>
          </div>
          <div class="caja">
            <select class="filtrado" name="signature" placeholder="Materia">
              <option value="">Materia</option>
              %s
            </select>
          </div>
          <div class="caja">
            <input type="text" class="text" name="priority" placeholder="Prioridad" required>
          </div>
          <div class="caja">
            <select class="filtrado" name="status" placeholder="Estado de la Tarea">
              <option value="">Estado</option>
              %s
            </select>
          </div>
          <div class="caja">
            <input type="text" class="text" name="to_finish" placeholder="Tiempo de realización" required>
          </div>
          <div class="caja">
            <select class="filtrado" name="group_name" placeholder="Grupo">
              <option value="">Grupo</option>
              %s
            </select>
          </div>
          <div class="caja">
            <textarea class="descripcion" name="description" cols="22" rows="10" placeholder="Descripción"></textarea>
          </div>
          <div class="caja">
            <input type="submit" class="button add" value="Agregar">
            <input type="hidden" name="r" value="homework-add">
            <input type="hidden" name="crud" value="set">
          </div>
      </form>
  </div>', $signature_selected, $status_selected, $group_selected);
} else if ($_POST['r'] == 'homework-add'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'set' ) {

  $homework_controller = new HomeworksController();

  $new_homework = array(
    'hw_id'         => $_POST['hw_id'],
    'title'         => $_POST['title'],
    'signature'     => $_POST['signature'],
    'priority'      => $_POST['priority'],
    'status'        => $_POST['status'],
    'to_finish'     => $_POST['to_finish'],
    'group_name'    => $_POST['group_name'],
    'description'   => $_POST['description'],
  );

  $homework = $homework_controller->set($new_homework);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos">La tarea <b>%s</b> ha sido agregada</h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("homeworks")
        }
    </script>';

    printf($template, $_POST['title']);
} else {
  $controller = new ViewController();
  $controller->load_view('error401');
}
