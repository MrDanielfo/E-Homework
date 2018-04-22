<?php

if($_POST['r'] == 'homework-show' && isset($_POST['hw_id']) ) {

   $homework_controller = new HomeworksController();
   $homework = $homework_controller->get($_POST['hw_id']);

   if( empty($homework) ) {
     $template =
     '<article class="datos-usuario">
         <h2 class="datos">Error al cargar la tarea <b>%s</b></h2>
     </article>';
   printf($template, $_POST['hw_id']);
 } else {
   $template_show = '
      <div class="mostrador">
        <h2 class="grupo">Actividad a realizar por el grupo <b>%s</b></h2>
        <div class="single-campos">
          <div class="campos">
            <p>ID</p>
          </div>
          <h3 class="datos">%s</h3>
          <div class="campos">
            <p>Tarea</p>
          </div>
          <h3 class="datos">%s</h3>
          <div class="campos">
            <p>Materia</p>
          </div>
          <h3 class="datos">%s</h3>
          <div class="campos">
            <p>Tiempo de Entrega</p>
          </div>
          <h3 class="datos">%s</h3>
          <div class="campos">
            <p>Prioridad</p>
          </div>
          <h3 class="datos">%s</h3>
          <div class="campos">
            <p>Estado</p>
          </div>
          <h3 class="datos">%s</h3>
        </div>
        <div class="descripcion">
          <p class="texto">%s</p>
        </div>
      </div>
   ';

   printf(
     $template_show,
     $homework[0]['group_name'],
     $homework[0]['hw_id'],
     $homework[0]['title'],
     $homework[0]['signature'],
     $homework[0]['to_finish'],
     $homework[0]['priority'],
     $homework[0]['status'],
     $homework[0]['description']
   );

  }

} else {
  $controller = new ViewController();
  $controller->load_view('error404');
}
