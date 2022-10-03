<?php

require_once '../functions/utility.php';

header('Content-Type: application/json; charset=utf-8');
session_start();

$_SESSION['user-id'] = null;
session_regenerate_id();
session_destroy();

send_json_response([
    'goto' => './login.php'
]);

?>