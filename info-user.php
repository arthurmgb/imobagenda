<?php

$query_user = "SELECT * FROM users WHERE id={$_SESSION['id']}";
$exec_user = mysqli_query($conn, $query_user);
while($row_usuario = mysqli_fetch_assoc($exec_user)){

    $user_id = $row_usuario['id'];
    $user_foto = $row_usuario['foto'];
    $user_name = $row_usuario['nome'];

}

?>