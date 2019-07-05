<?php

/**
 * Verifica Autenticacao.
 */
function verificarAutenticacao()
{
    global $session_login_variable_name;
    global $session_password_variable_name;
    global $session_role_variable_name;

    if(isset($session_login_variable_name) && isset($session_password_variable_name))
    {
        if( !isset($_SESSION[$session_login_variable_name]) || !isset($_SESSION[$session_password_variable_name]) || !isset($_SESSION[$session_role_variable_name]) )
        {
            header("Location: login.php");
            exit; //force stop!
        }
    }
}

/**
 * @param $parametro
 * @return string
 */
function antiSQLInjection($parametro)
{
    $param = strip_tags($parametro);
    return htmlentities($param, ENT_QUOTES, 'UTF-8');
}

/**
 * @param $loginSession
 * @param $passwdSession
 * @param $roleSession
 */
function deslogarAceso($loginSession, $passwdSession, $roleSession)
{
    unset($_SESSION[$loginSession]);
    unset($_SESSION[$passwdSession]);
    unset($_SESSION[$roleSession]);
}

/**
 * Recupera o UsuarioID pelo Username contido na Session.
 *
 * @param $username
 * @param $db
 * @return null
 */
function recuperarUsuarioIdPeloUsername($username, $db)
{

    $statement = $db->pdo->prepare("SELECT * FROM usuarios WHERE username = :username LIMIT 1");
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();
    $rows = $statement->rowCount();

    if($rows == 1)
    {
        $object = $statement->fetch(PDO::FETCH_OBJ);
        return $object->id;
    }
    return null;
}

/**
 * @param $resource
 * @return bool
 */
function isFotoValida($resource)
{
    if(isset($resource['error'])){
        if($resource['error'] !== 0){
            return false;
        }else{
            $extensao = pathinfo ( $resource['name'], PATHINFO_EXTENSION );
            $extensao = strtolower ( $extensao );
            if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
                return true;
            }
            return false;
        }
    }
    return false;
}

function uploadFileToServer($resource)
{

    $arquivo_tmp = $resource[ 'tmp_name' ];
    $nome = $resource[ 'name' ];
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
    $extensao = strtolower ( $extensao );

    $novoNome = uniqid ( time () ) . '.' . $extensao;
    $destino = '../images/' . $novoNome;

    if ( move_uploaded_file ( $arquivo_tmp, $destino ) ) {
        return $novoNome;
    }
    else
        return false;
}


?>