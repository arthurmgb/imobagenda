<?php

require_once "../conexao.php";
session_start();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$delete_contato = "DELETE FROM contatos WHERE id='$id'";
$exec_delete = mysqli_query($conn, $delete_contato);

if(mysqli_affected_rows($conn)){
    $_SESSION['msg'] = "<div id='remove' class='alert alert-success mb-2' role='alert'>
    Contato removido com sucesso!
    </div>";
    header("Location: contatos.php");
}else{
    $_SESSION['msg'] = "<div id='remove' class='alert alert-danger mb-2' role='alert'>
    Erro ao remover contato!
    </div>";
    header("Location: contatos.php");
}
