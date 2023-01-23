<?php
require_once "../conexao.php";
session_start();
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$delet_inquili = "DELETE FROM inquilinos WHERE id='$id'";
$delet_inquili_query = mysqli_query($conn, $delet_inquili);

if(mysqli_affected_rows($conn)){
    $_SESSION['msg'] = "<div id='remove' class='alert alert-success mb-2' role='alert'>
    Inquilino removido com sucesso!
    </div>";
    header("Location: inquilinos.php");
}else{
    $_SESSION['msg'] = "<div id='remove' class='alert alert-danger mb-2' role='alert'>
    Erro ao remover inquilino!
    </div>";
    header("Location: inquilinos.php");
}