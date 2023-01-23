<?php

require_once "../conexao.php";

$task = filter_input(INPUT_POST, 'task', FILTER_SANITIZE_STRING);

$insert_task = "INSERT INTO tarefas (criado, nome) VALUES(NOW(), '$task')";
$exec_task = mysqli_query($conn, $insert_task);

if(mysqli_insert_id($conn)){
    header("Location: index.php#tasks");
}else{
    header("Location: index.php");
}