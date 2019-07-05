<?php
session_start();

include "../config/InitDb.php";
include "../config/Variables.php";
include "../config/Helpers.php";

verificarAutenticacao();

/**
 * Parte do sistema que cadastra um jogador.
 */

if (isset($_POST)){

    if(
        isset($_POST['nome_completo']) &&
        isset($_POST['idade']) &&
        isset($_POST['rg']) &&
        isset($_POST['cpf']) &&
        isset($_FILES['foto'])
    )
    {

        $nome_completo = antiSQLInjection($_POST['nome_completo']);
        $idade = antiSQLInjection($_POST['idade']);
        $rg = antiSQLInjection($_POST['rg']);
        $cpf = antiSQLInjection($_POST['cpf']);
        $usuario_id = recuperarUsuarioIdPeloUsername($_SESSION[$session_login_variable_name], $db);
        $foto = $_FILES['foto'];

        $filename = null;

        if(isFotoValida($foto))
        {
            $filename = uploadFileToServer($foto);
        }else
        {
            header("Location:" . $_SERVER['HTTP_REFERER']); exit;
        }

        $sql = "INSERT INTO jogadores ";
        $sql .= "(nome_completo, idade, rg, cpf, foto, usuario_id) ";
        $sql .= "VALUES (:nome_completo, :idade, :rg, :cpf, :foto, :usuario_id)";

        $statement = $db->pdo->prepare($sql);
        $statement->bindParam(':nome_completo', $nome_completo, PDO::PARAM_STR);
        $statement->bindParam(':idade', $idade, PDO::PARAM_STR);
        $statement->bindParam(':rg', $rg, PDO::PARAM_STR);
        $statement->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $statement->bindParam(':foto', $filename, PDO::PARAM_STR);
        $statement->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $statement->execute();

        header("Location: ../index.php?page=listar-jogadores"); exit;
    }
}
header("Location:" . $_SERVER['HTTP_REFERER']); exit;

?>