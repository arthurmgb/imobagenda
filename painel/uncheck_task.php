<?php

require_once "../conexao.php";

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$update_task = "UPDATE tarefas SET checked='0' WHERE id='$id'";
$exec_task = mysqli_query($conn, $update_task);

if(mysqli_affected_rows($conn)){
    header("Location: index.php#tasks");
}else{
    header("Location: 404.php");
}