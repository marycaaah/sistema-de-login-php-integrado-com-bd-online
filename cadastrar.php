<?php
session_start();
include("conexao.php");

$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
$senha = mysqli_real_escape_string($conexao, trim(md5($_POST['senha'])));
// Essa linha de código está realizando três ações:
// Recebendo a senha enviada pelo usuário através do método POST: $_POST['senha']

// Convertendo a senha em um hash MD5: md5($_POST['senha'])

// Preparando a senha para ser utilizada em uma consulta ao banco de dados através da 
// função mysqli_real_escape_string() que realiza a sanitização da string, evitando a injeção de SQL. 

// Essa função é utilizada para evitar que caracteres especiais ou comandos SQL maliciosos sejam interpretados 
// pelo banco de dados.

// Portanto, o objetivo dessa linha de código é garantir a segurança da aplicação ao lidar com informações 
// sensíveis como senhas.

$sql = "select count(*) as total from usuario where usuario = '$usuario'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1) {
	$_SESSION['usuario_existe'] = true;
	header('Location: cadastro.php');
	exit;
}

$sql = "INSERT INTO usuario (nome, usuario, senha, data_cadastro) VALUES ('$nome', '$usuario', '$senha', NOW())";

if($conexao->query($sql) === TRUE) {
	$_SESSION['status_cadastro'] = true;
}

$conexao->close();

header('Location: cadastro.php');
exit;
?>