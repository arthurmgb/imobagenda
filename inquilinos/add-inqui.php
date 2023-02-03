<?php
require_once "../conexao.php";
session_start();

$nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
$profissao = trim(filter_input(INPUT_POST, 'profissao', FILTER_SANITIZE_STRING));
$bairro = trim(filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING));
$endereco = trim(filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING));
$numero = trim(filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING));
$celular = trim(filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_STRING));
$celular2 = trim(filter_input(INPUT_POST, 'celular2', FILTER_SANITIZE_STRING));
$telefone = trim(filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING));


$insert_inquili = "INSERT INTO inquilinos (created, nome, email, profissao, bairro, endereco, numero, celular, celular2, telefone) VALUES (NOW(), '$nome', '$email', '$profissao', '$bairro', '$endereco', '$numero', '$celular', '$celular2', '$telefone')";

$insert_inquili_query = mysqli_query($conn, $insert_inquili);

if (mysqli_insert_id($conn)) {
    $_SESSION['msg'] = "<div id='remove' class='alert alert-success mb-2' role='alert'>
    Novo inquilino cadastrado com sucesso!
    </div>";
    header("Location: inquilinos.php");
} else {
    $_SESSION['msg'] = "<div id='remove' class='alert alert-danger mb-2' role='alert'>
    Erro ao cadastrar inquilino!
    </div>";
    header("Location: inquilinos.php");
}
