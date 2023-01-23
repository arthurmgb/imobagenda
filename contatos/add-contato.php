<?php

require_once "../conexao.php";
session_start();

$prop = filter_input(INPUT_POST, 'prop', FILTER_SANITIZE_NUMBER_INT);
$inq = filter_input(INPUT_POST, 'inq', FILTER_SANITIZE_NUMBER_INT);

$insert_contato = "INSERT INTO contatos (created, id_prop, id_inq) VALUES(NOW(), '$prop', '$inq')";
$exec_contato = mysqli_query($conn, $insert_contato);

if(mysqli_insert_id($conn)){
    $_SESSION['msg'] = "<div id='remove' class='alert alert-success mb-2' role='alert'>
    Novo contato cadastrado com sucesso!
    </div>";
    header("Location: contatos.php");
}else{
    $_SESSION['msg'] = "<div id='remove' class='alert alert-danger mb-2' role='alert'>
    Erro ao cadastrar contato!
    </div>";
    header("Location: contatos.php");
}