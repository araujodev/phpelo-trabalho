<?php
session_start();

include "../config/InitDb.php";
include "../config/Variables.php";
include "../config/Helpers.php";

/**
 * Parte do sistema que realiza login.
 */

if (isset($_POST)){
    if(isset($_POST['username']) && isset($_POST['password'])){

        $username = antiSQLInjection($_POST['username']);
        $password = antiSQLInjection(md5($_POST['password']));

        $statement = $db->pdo->prepare("SELECT * FROM usuarios WHERE username = :username AND password = :password LIMIT 1");
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->rowCount();


        if($rows == 1)
        {
            $object = $statement->fetch(PDO::FETCH_OBJ);

            //Permissao de Admin
            if($object->role !== $role_administrador)
            {
                header("Location: ../login.php"); exit;
            }

            $_SESSION[$session_login_variable_name] = $object->username;
            $_SESSION[$session_password_variable_name] = $object->password;
            $_SESSION[$session_role_variable_name] = $object->role;

            header("Location: ../index.php"); exit;
        }

        deslogarAceso(
            $session_login_variable_name,
            $session_password_variable_name,
            $session_role_variable_name
        );
        header("Location: ../login.php"); exit;
    }
}

?>