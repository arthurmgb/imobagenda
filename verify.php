<?php

session_start();

if(!empty($_SESSION['id'])){

} else{
  $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
  Você não está logado.
  </div>";
  header("Location: ../user/login.php");
}