<?php
session_start();

include "../config/InitDb.php";
include "../config/Variables.php";
include "../config/Helpers.php";

verificarAutenticacao();

/**
 * Parte do sistema que cadastra um Relatorio.
 */

if (isset($_POST)){

    if(
        isset($_POST['time_atual']) &&
        isset($_POST['idade_inicio']) &&
        isset($_POST['lesao']) &&
        isset($_POST['jogador_id'])
    )
    {

        $time_atual = antiSQLInjection($_POST['time_atual']);
        $idade_inicio = antiSQLInjection($_POST['idade_inicio']);
        $lesao = antiSQLInjection($_POST['lesao']);
        $jogador_id = antiSQLInjection($_POST['jogador_id']);

        $sql = "INSERT INTO relatorios ";
        $sql .= "(time_atual, idade_inicio, lesao, jogador_id, criado_em) ";
        $sql .= "VALUES (:time_atual, :idade_inicio, :lesao, :jogador_id, :criado_em)";

        $statement = $db->pdo->prepare($sql);
        $statement->bindParam(':time_atual', $time_atual, PDO::PARAM_STR);
        $statement->bindParam(':idade_inicio', $idade_inicio, PDO::PARAM_STR);
        $statement->bindParam(':lesao', $lesao, PDO::PARAM_STR);
        $statement->bindParam(':jogador_id', $jogador_id, PDO::PARAM_STR);
        $statement->bindParam(':criado_em', date('Y-m-d'));
        $statement->execute();
    }
}
header("Location:" . $_SERVER['HTTP_REFERER']); exit;

?>