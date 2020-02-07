<?php
      session_start();
      $_SESSION = array();
      if(session_destroy()) {
            header("Location: ../back_office/index.php");
      }
      setcookie('login', '');
      setcookie('pass_hache', '');
?>

