<?php

require_once "../conexao.php";

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$tarefa = filter_input(INPUT_POST, 'edit', FILTER_SANITIZE_STRING);
$filtro = trim($tarefa);

if(!empty($filtro)){
    $update_task = "UPDATE tarefas SET nome='$filtro' WHERE id='$id'";
    $exec_update = mysqli_query($conn, $update_task);
}else{
    header("Location: index.php");
}

if(mysqli_affected_rows($conn)){
    header("Location: index.php");
}else{
    header("Location: index.php");
}