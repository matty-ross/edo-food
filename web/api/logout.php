<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/utility.php';


session_start();

$_SESSION['user-id'] = null;
session_regenerate_id();
session_destroy();

send_json_response([
    'goto' => './login.php',
]);

?>