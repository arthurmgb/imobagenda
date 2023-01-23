<?php 

session_start();
ob_start();
require_once "../conexao.php";

$dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$erro = false;
$dados_st = array_map('strip_tags', $dados_rc);
$dados = array_map('trim', $dados_st);

//CADASTRO INVÁLIDO

if(in_array('',$dados)){
$erro = true;
$_SESSION['msg'] = "<div class='alert alert-danger mb-0' role='alert'>É necessário preencher todos os campos.</div>";
header("Location: cadastro.php");
}

elseif((strlen($dados['senha'])) < 6){
$erro = true;
$_SESSION['msg'] = "<div class='alert alert-danger mb-0' role='alert'>A senha deve ter no mínimo 6 caracteres.</div>";
header("Location: cadastro.php");
}

elseif(stristr($dados['senha'], "'")){
$erro = true;
$_SESSION['msg'] = "<div class='alert alert-danger mb-0' role='alert'>A senha possui caracter inválido.</div>";
header("Location: cadastro.php");
}

//VERIFICA USUÁRIO EXISTENTE

else{

$result_usuario = "SELECT id FROM users WHERE usuario='".$dados['usuario']."'";
$resultado_usuario = mysqli_query($conn, $result_usuario);

if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
    $erro = true;
    $_SESSION['msg'] = "<div class='alert alert-warning mb-0' role='alert'>
    Este usuário já foi cadastrado.
</div>";
header("Location: cadastro.php");
}

}

//CADASTRO VÁLIDO

if(!$erro){

password_hash($dados['senha'], PASSWORD_DEFAULT);
$dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);

$result_usuario = "INSERT INTO users (nome, usuario, senha) VALUES (
'".$dados['nome']."',
'".$dados['usuario']."',
'".$dados['senha']."'
)";

$resultado_usuario = mysqli_query($conn, $result_usuario);

$ultimo_id = mysqli_insert_id($conn);

//Pasta onde vai ser salvo
$_UP['pasta'] = '../registros/'.$ultimo_id.'/';

//Criar pasta
mkdir($_UP['pasta'], 0777);

if(mysqli_insert_id($conn)){
$_SESSION['msg'] = "<div class='alert alert-success' role='alert'>
Cadastro realizado com sucesso.
</div>";
header("Location: login.php");
}

else{
$_SESSION['msg'] = "<div class='alert alert-danger mb-0' role='alert'>
Erro ao cadastrar o usuário.
</div>";
header("Location: cadastro.php");
}

}