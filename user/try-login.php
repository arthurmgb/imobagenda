<?php

session_start();
require_once "../conexao.php";

$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
$user = trim($usuario);
$pass = trim($senha);

if(($user) AND ($pass)){

    $result_usuario = "SELECT id, usuario, senha FROM users WHERE usuario='$user' LIMIT 1";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    if($resultado_usuario){
        $row_usuario = mysqli_fetch_assoc($resultado_usuario);
        if(password_verify($pass, $row_usuario['senha'])){

            $_SESSION['id'] = $row_usuario['id'];
            header("Location: ../painel/index.php");
        }
        else{

            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
            Login ou senha incorretos.
            </div>";
            header("Location: login.php");

        }
    }
}
else{

    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
    É necessário preencher todos os campos.
    </div>";
    header("Location: login.php");

}