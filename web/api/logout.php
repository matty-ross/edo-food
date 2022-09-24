<?php

require '../functions/utility.php';

header('Content-Type: application/json; charset=utf-8');
session_start();

$_SESSION['user-id'] = null;
session_destroy();

send_json_response([
    'goto' => './login.php'
]);

?>