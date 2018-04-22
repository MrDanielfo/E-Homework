<?php

$homework_controller = new HomeworksController();

if( $_POST['r'] == 'homework-delete' && $_SESSION['role'] == 'Docente' && !isset($_POST['crud']) ) {

  $homework = $homework_controller->get($_POST['hw_id']);

  if( empty($homework) ) {

    $template =
    '<article class="datos-usuario">
        <h2 class="datos">No existe la tarea de nombre<b>%s</b></h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("homeworks")
        }
    </script>';
  printf($template, $_POST['title']);
} else {
  $template_homework =
  '<div class="contenedor-login">
      <h2 class="login  delete">Eliminar Tarea</h2>
      <form class="login-crud"  method="POST">
          <div class="caja">
            <h2 class="delete-crud">¿Estás seguro que quieres eliminar la tarea <b>%s</b>?</h2>
          </div>
          <div class="caja">
            <input type="submit" class="button delete" value="Sí">
            <input type="button" class="button add" value="No" onclick="history.back()">
            <input type="hidden" name="hw_id" value="%s">
            <input type="hidden" name="r" value="homework-delete">
            <input type="hidden" name="crud" value="del">
          </div>
      </form>
  </div>';
  printf(
    $template_homework,
    $homework[0]['title'],
    $homework[0]['hw_id']
  );

}

} else if ($_POST['r'] == 'homework-delete'  && $_SESSION['role'] == 'Docente' && $_POST['crud'] == 'del' ) {

  $delete_homework = $_POST['hw_id'];

  $homework = $homework_controller->del($delete_homework);

  $template =
    '<article class="datos-usuario">
        <h2 class="datos  delete">La tarea <b>%s</b> ha sido eliminada</h2>
    </article>
    <script>
        window.onload = function() {
          reloadPage("homeworks")
        }
    </script>';

    printf($template, $_POST['hw_id']);
} else {
  $controller = new ViewController();
  $controller->load_view('error401');
}
