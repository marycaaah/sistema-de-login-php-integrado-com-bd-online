<?php
define('HOST', 'db4free.net:3306');
define('USUARIO', 'root_mariana');
define('SENHA', 'La791511*');
define('DB', 'localhost_m');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');