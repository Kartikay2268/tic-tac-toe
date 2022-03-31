<?php
  require 'includes/url.php';
  require 'Activity.php';


  destroyActivity();

  $_SESSION = array();

  if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(session_name(),'',time() - 4200,
      $params['path'], $params['domian'],
      $params['secure'], $params["httponly"]
    );
  }
  session_destroy();

  redirect('/tictactoe/');
