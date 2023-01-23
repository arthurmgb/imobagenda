<?php

session_start();
unset($_SESSION['id']);

$_SESSION['msg'] = "<div id='remove' class='alert alert-success' role='alert'>
Deslogado com sucesso.
</div>";

header("Location: ../user/login.php");