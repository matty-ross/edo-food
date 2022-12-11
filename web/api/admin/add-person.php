<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/utility.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/responses.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/validators.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/authentification.php';


session_start();

$db = new Database();
$json = get_json_request();

if (!authentificate_admin($db, './login.php'))
{
    die;
}


$id = is_valid_number($json->id ?? null) ? $json->id : null;
$full_name = is_valid_string($json->fullName ?? null) ? $json->fullName : null;
$email = is_valid_string($json->email ?? null) ? $json->email : null;
$password = is_valid_string($json->password ?? null) ? $json->password : null;
$credit = is_valid_number($json->credit ?? null) ? $json->credit : null;
$admin = is_valid_bool($json->admin ?? null) ? $json->admin : null;

if (
    $id === null ||
    $full_name === null ||
    $email === null ||
    $password === null ||
    $credit === null ||
    $admin === null
)
{
    send_response_invalid_data();
    die;
}

$password = hash_password($password);

if ($db->add_person($id, $full_name, $email, $password, $credit, $admin))
{
    send_response_action_success();
}
else
{
    send_response_action_failure();
}

?>