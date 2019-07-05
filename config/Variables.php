<?php

/**
 * Variaveis globais para padronizar o sistema.
 */

//Session
$session_login_variable_name = "sistema_session_login";
$session_password_variable_name = "sistema_session_passwd";
$session_role_variable_name = "sistema_session_role";

//Database - Usuarios Table: Roles Names
$role_administrador = "administrador";
$role_usuario = "usuario_comun";

//Pages Identifiers
$pages = [
    "dashboard" => 'pages/dashboard.php',
    "criar-jogador" => 'pages/criarJogador.php',
    "listar-jogadores" => 'pages/listarJogadores.php',
    "relatorio-jogador" => 'pages/relatorioJogador.php',
    "error" => 'pages/erroAoCarregar.php',
    "deslogar" => 'pages/deslogar.php'
];

?>