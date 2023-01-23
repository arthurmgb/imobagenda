<?php

require_once "../conexao.php";
session_start();

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$profissao = filter_input(INPUT_POST, 'profissao', FILTER_SANITIZE_STRING);
$bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
$endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
$numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
$celular1 = filter_input(INPUT_POST, 'celular1', FILTER_SANITIZE_STRING);
$celular2 = filter_input(INPUT_POST, 'celular2', FILTER_SANITIZE_STRING);
$telefone =filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);

$query_update = "UPDATE proprietarios SET nome='$nome', email='$email', profissao='$profissao', bairro='$bairro', endereco='$endereco', numero='$numero', celular1='$celular1', celular2='$celular2', telefone='$telefone' WHERE id='$id'";
$exec_update = mysqli_query($conn, $query_update);

if(mysqli_affected_rows($conn)){
    $_SESSION['msg'] = "<div id='remove' class='alert alert-success mb-2' role='alert'>
    Proprietário editado com sucesso!
    </div>";
    header("Location: proprietarios.php");
}else{
    $_SESSION['msg'] = "<div id='remove' class='alert alert-danger mb-2' role='alert'>
    Erro ao editar proprietário!
    </div>";
    header("Location: proprietarios.php");
}