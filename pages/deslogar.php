<?php
include "../config/Variables.php";
include "../config/Helpers.php";

deslogarAceso(
        $session_login_variable_name,
        $session_password_variable_name,
        $session_role_variable_name
);
header("Location: login.php"); exit;

?>