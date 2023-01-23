<?php

session_start();
require_once "../conexao.php";

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$delete_conta = "DELETE FROM users WHERE id='$id'";
$exec_delete = mysqli_query($conn, $delete_conta);

if(mysqli_affected_rows($conn)){

    session_destroy();
    header("Location: ../user/login.php");

}else{

    header("Location: conta.php");
    
}