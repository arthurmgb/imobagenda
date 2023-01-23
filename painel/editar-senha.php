<?php

session_start();
require_once "../conexao.php";

$id = filter_input(INPUT_POST, 'id2', FILTER_SANITIZE_NUMBER_INT);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

password_hash($senha, PASSWORD_DEFAULT);
$newsenha = password_hash($senha, PASSWORD_DEFAULT);

$update_senha = "UPDATE users SET senha='$newsenha' WHERE id='$id'";
$exec_update = mysqli_query($conn, $update_senha);

if(mysqli_affected_rows($conn)){
    header("Location: conta.php");
    $_SESSION['msg'] = "<div id='remove' class='alert alert-success mb-0' role='alert'>
    Senha editada com sucesso.
    </div>";
}else{
    header("Location: conta.php");
}