<?php

session_start();
require_once "../conexao.php";

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$usuario = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
$foto = $_FILES['img']['name'];

if($foto == ""){

    $update_usuario = "UPDATE users SET nome='$nome', usuario='$usuario' WHERE id='$id'";
    $exec_update = mysqli_query($conn, $update_usuario);

    if(mysqli_affected_rows($conn)){
        header("Location: conta.php");
        $_SESSION['msg'] = "<div id='remove' class='alert alert-success mb-0' role='alert'>
        Conta editada com sucesso.
        </div>";
    }else{
        header("Location: conta.php");
    }
}else{
    $update_usuario = "UPDATE users SET foto='$foto', nome='$nome', usuario='$usuario' WHERE id='$id'";
    $exec_update = mysqli_query($conn, $update_usuario);

    $_UP['pasta'] = '../registros/'.$id.'/';
    array_map('unlink', glob("../registros/$id/*.*"));
    move_uploaded_file($_FILES['img']['tmp_name'], $_UP['pasta'].$foto);

    if(mysqli_affected_rows($conn)){
        header("Location: conta.php");
        $_SESSION['msg'] = "<div id='remove' class='alert alert-success mb-0' role='alert'>
        Conta editada com sucesso.
        </div>";
    }else{
        header("Location: conta.php");
    }
}

