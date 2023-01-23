<?php

require_once "../conexao.php";
session_start();

$contato = filter_input(INPUT_POST, 'contato', FILTER_SANITIZE_NUMBER_INT);
$inq = filter_input(INPUT_POST, 'inq', FILTER_SANITIZE_NUMBER_INT);

$edit_contato = "UPDATE contatos SET id_inq='$inq' WHERE id='$contato'";
$exec_edit = mysqli_query($conn, $edit_contato);


if(mysqli_affected_rows($conn)){
    $_SESSION['msg'] = "<div id='remove' class='alert alert-success mb-2' role='alert'>
    Contato editado com sucesso!
    </div>";
    header("Location: contatos.php");
}else{
    $_SESSION['msg'] = "<div id='remove' class='alert alert-danger mb-2' role='alert'>
    Erro ao editar contato!
    </div>";
    header("Location: contatos.php");
}