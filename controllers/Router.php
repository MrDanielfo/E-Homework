<?php

class Router {
    public $route;

    public function __construct($route) {

      // validar session

      if( !isset($_SESSION) ) session_start();
      if( !isset($_SESSION['homework']) ) $_SESSION['homework'] = false;

      // fin de validación

      if($_SESSION['homework']) {
         // desarrollo de aplicación
        $this->route = isset($_GET['r'] ) ? $_GET['r'] : 'home';
        $controller = new ViewController();

        switch ($this->route) {
          case 'home' :
            $controller->load_view('home');
            break;

          case 'homeworks' :
            if(!isset( $_POST['r']) ) {
              $controller->load_view('homeworks');
            } else if ($_POST['r'] == 'homework-add') {
              $controller->load_view('homework-add');
            } else if ($_POST['r'] == 'homework-edit') {
              $controller->load_view('homework-edit');
            } else if ($_POST['r'] == 'homework-delete') {
              $controller->load_view('homework-delete');
            } else if ($_POST['r'] == 'homework-show') {
              $controller->load_view('homework-show');
            }

            break;

          case 'users' :
            if(!isset( $_POST['r']) ) {
              $controller->load_view('users');
            } else if ($_POST['r'] == 'user-add') {
              $controller->load_view('user-add');
            } else if ($_POST['r'] == 'user-edit') {
              $controller->load_view('user-edit');
            } else if ($_POST['r'] == 'user-delete') {
              $controller->load_view('user-delete');
            }

            break;

          case 'groups' :
            if(!isset( $_POST['r']) ) {
              $controller->load_view('groups');
            } else if ($_POST['r'] == 'group-add') {
              $controller->load_view('group-add');
            } else if ($_POST['r'] == 'group-edit') {
              $controller->load_view('group-edit');
            } else if ($_POST['r'] == 'group-delete') {
              $controller->load_view('group-delete');
            }

            break;

          case 'signatures' :
            if(!isset( $_POST['r']) ) {
              $controller->load_view('signatures');
            } else if ( $_POST['r']  == 'signature-add' ) {
              $controller->load_view('signature-add');
            } else if ( $_POST['r']  == 'signature-edit' ) {
              $controller->load_view('signature-edit');
            } else if ( $_POST['r']  == 'signature-delete' ) {
              $controller->load_view('signature-delete');
            }
            break;

          case 'status' :
            if(!isset( $_POST['r']) ) {
              $controller->load_view('status');
            } else if ( $_POST['r']  == 'status-add' ) {
              $controller->load_view('status-add');
            } else if ( $_POST['r']  == 'status-edit' ) {
              $controller->load_view('status-edit');
            } else if ( $_POST['r']  == 'status-delete' ) {
              $controller->load_view('status-delete');
            }
            break;

          case 'acercade' :
             $controller->load_view('acercade');
             break;

          case 'salir' :
            $user_session = new SessionController();
            $user_session->logout();
            break;

          default:
            $controller->load_view('error404');
            break;


        } // fin de switch

      } else {
        // mostrar el formulario
        if(!isset($_POST['user'])  && !isset($_POST['pass']) ) {
          $login_form = new ViewController();
          $login_form->load_view('login');

        } else {
          // se tienen que rgistrar los datos

          $user_session = new SessionController();
          $session = $user_session->login( $_POST['user'], $_POST['pass']);

          if( empty($session) ) {
            $login_form = new ViewController();
            $login_form->load_view('login');

            // si los datos no fueron llenados correctamente

            echo "<h3>El usuario " . $_POST['user'] . " o la contraseña de éste, no coincide en el registro, verifica tus datos e inténtalo de nuevo";
          }
          // esto pasa si los datos fueron correctos

          $_SESSION['homework'] = true;

          foreach($session as $row) {
            $_SESSION['user']       =   $row['user'];
            $_SESSION['email']      =   $row['email'];
            $_SESSION['name']       =   $row['name'];
            $_SESSION['cellphone']  =   $row['cellphone'];
            $_SESSION['pass']       =   $row['pass'];
            $_SESSION['role']       =   $row['role'];
          }

          header('Location: ./');

        }

      } // fin del if $_SESSION['homework'];


    } // fin del constructor

} // fin de class Router
