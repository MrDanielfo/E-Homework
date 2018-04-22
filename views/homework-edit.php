<?php

$homework_controller = new HomeworksController();

if( $_POST['r'] == 'homework-edit' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {

  $homework = $homework_controller->get($_POST['hw_id']);

  if( empty($homework) ) {

    $template =
    '<article class="datos-usuario">
        <h2 class="datos">No existe la tarea <b>%s</b></h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("homeworks")
        }
    </script>';
  printf($template, $_POST['hw_id']);
} else {

  $signature_controller = new SignaturesController();
  $signature = $signature_controller->get();

  $signature_select = '';

  for ($n = 0; $n < count($signature); $n ++) {
    $sig_selected = ($homework[0]['signature'] == $signature[$n]['signature']) ? 'selected' : '';
    $signature_select .= '<option value="' . $signature[$n]['signature_id'] . '"' . $sig_selected . '>' . $signature[$n]['signature'] . '</option>';
  }

  $status_controller = new StatusController();
  $status = $status_controller->get();

  $status_select = '';

  for ($h=0; $h < count($status); $h++) {
    $sta_selected = ($homework[0]['status'] == $status[$h]['status'] ) ? 'selected' : '';
    $status_select .= '<option value="' . $status[$h]['status_id'] . '"' . $sta_selected . '>' . $status[$h]['status'] . '</option>';
  }


  $group_controller = new GroupsController();
  $group = $group_controller->get();

  $group_select = '';

  for ($j=0; $j < count($group) ; $j++) {
    $gr_selected = ($homework[0]['group_name'] == $group[$j]['group_name'] ) ? 'selected' : '';
    $group_select .= '<option value="'. $group[$j]['group_id'] .'"'. $gr_selected .'>'. $group[$j]['group_name'] .'</option>';
  }

  $template_homework =
  '<div class="contenedor-login">
      <h2 class="login  edit">Editar Tarea</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <input type="text" class="text" name="hw_id" placeholder="ID" value="%s" disabled required>
            <input type="hidden" name="hw_id" value="%s">
          </div>
          <div class="caja">
            <input type="text" class="text" name="title" value="%s" placeholder="Título" required>
          </div>
          <div class="caja">
            <select class="filtrado" name="signature" placeholder="Materia">
              <option value="">Materia</option>
              %s
            </select>
          </div>
          <div class="caja">
            <input type="text" class="text" name="priority" placeholder="Prioridad" value="%s" required>
          </div>
          <div class="caja">
            <select class="filtrado" name="status" placeholder="Estado de la Tarea">
              <option value="">Estado</option>
              %s
            </select>
          </div>
          <div class="caja">
            <input type="text" class="text" name="to_finish" value="%s" placeholder="Tiempo de realización" required>
          </div>
          <div class="caja">
            <select class="filtrado" name="group_name" placeholder="Grupo">
              <option value="">Grupo</option>
              %s
            </select>
          </div>
          <div class="caja">
            <textarea class="descripcion" name="description" cols="22" rows="10" placeholder="Descripción">%s</textarea>
          </div>
          <div class="caja">
            <input type="submit" class="button edit" value="Editar">
            <input type="hidden" name="r" value="homework-edit">
            <input type="hidden" name="crud" value="set">
          </div>
      </form>
  </div>';

  printf(
    $template_homework,
    $homework[0]['hw_id'],
    $homework[0]['hw_id'],
    $homework[0]['title'],
    $signature_select,
    $homework[0]['priority'],
    $status_select,
    $homework[0]['to_finish'],
    $group_select,
    $homework[0]['description']
  );

}

} else if ($_POST['r'] == 'homework-edit'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'set' ) {

  $save_homework = array(
    'hw_id' => $_POST['hw_id'],
    'title' => $_POST['title'],
    'signature' => $_POST['signature'],
    'priority' => $_POST['priority'],
    'status' => $_POST['status'],
    'to_finish' => $_POST['to_finish'],
    'group_name' => $_POST['group_name'],
    'description' => $_POST['description'],
  );

  $homework = $homework_controller->set($save_homework);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos edit">La tarea <b>%s</b> ha sido editada</h2>
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
