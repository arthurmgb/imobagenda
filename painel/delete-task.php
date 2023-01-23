<?php

require_once "../conexao.php";

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$delete = "DELETE FROM tarefas WHERE id='$id'";
$exec_delete = mysqli_query($conn, $delete);

if(mysqli_affected_rows($conn)){
    header("Location: index.php#tasks");
}else{
    header("Location: index.php");
}