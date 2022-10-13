<?php

$root_dir = $_SERVER['DOCUMENT_ROOT'] . '/edo-food';

require_once $root_dir . '/functions/utility.php';


session_start();

$_SESSION['user-id'] = null;
session_regenerate_id();
session_destroy();

send_json_response([
    'goto' => 'login.php',
]);

?>