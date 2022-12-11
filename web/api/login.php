<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/utility.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/responses.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/validators.php';


session_start();

$db = new Database();
$json = get_json_request();


$email = is_valid_string($json->email ?? null) ? $json->email : null;
$password = is_valid_string($json->password ?? null) ? $json->password : null;
$id = is_valid_number($json->id ?? null) ? $json->id : null;
$goto = is_valid_string($json->goto ?? null) ? $json->goto : './menu.php';

if (
    $id === null &&
    ($email === null ||
    $password === null)
)
{
    send_response_invalid_data();
    die;
}

$user_id = null;

if ($id !== null)
{
    if (!$db->is_valid_user_id($id))
    {
        send_response_invalid_id();
    }
    else
    {
        $user_id = $id;
    }
}
else
{
    $password = hash_password($password);
    $user_id = $db->get_user_id($email, $password);
    if ($user_id === null)
    {
        send_response_invalid_email_or_password();
    }
}

$_SESSION['user-id'] = $user_id;
if ($user_id === null)
{
    die;
}

send_json_response([
    'goto' => $goto,
]);

?>