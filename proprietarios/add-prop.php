<?php

require_once "../conexao.php";
session_start();

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$profissao = filter_input(INPUT_POST, 'profissao', FILTER_SANITIZE_STRING);
$bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
$endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
$numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
$celular1 = filter_input(INPUT_POST, 'celular1', FILTER_SANITIZE_STRING);
$celular2 = filter_input(INPUT_POST, 'celular2', FILTER_SANITIZE_STRING);
$telefone =filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);

$insert_prop = "INSERT INTO proprietarios (created, nome, email, profissao, bairro, endereco, numero, celular1, celular2, telefone) VALUES (NOW(),'$nome', '$email', '$profissao', '$bairro', '$endereco', '$numero', '$celular1', '$celular2', '$telefone')";
$exec_prop = mysqli_query($conn, $insert_prop);

if(mysqli_insert_id($conn)){
    $_SESSION['msg'] = "<div id='remove' class='alert alert-success mb-2' role='alert'>
    Novo proprietário cadastrado com sucesso!
    </div>";
    header("Location: proprietarios.php");
}else{
    $_SESSION['msg'] = "<div id='remove' class='alert alert-danger mb-2' role='alert'>
    Erro ao cadastrar proprietário!
    </div>";
    header("Location: proprietarios.php");
}