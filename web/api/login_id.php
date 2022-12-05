<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/utility.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/responses.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/validators.php';


session_start();

$db = new Database();
$json = get_json_request();


$id = is_valid_number($json->id ?? null) ? $json->id : null;
$goto = is_valid_string($json->goto ?? null) ? $json->goto : './menu.php';

if (
    $id === null
)
{
    send_response_invalid_data();
    die;
}

$_SESSION['user-id'] = $id;

if (!$db->is_valid_user_id($id))
{
    send_response_invalid_email_or_password(); // TODO
    die;
}

send_json_response([
    'goto' => $goto,
]);

?>