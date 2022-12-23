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
$card_id = is_valid_number($json->cardId ?? null) ? $json->cardId : null;
$goto = is_valid_string($json->goto ?? null) ? $json->goto : './menu.php';

if (
    $card_id === null &&
    ($email === null ||
    $password === null)
)
{
    send_response_invalid_data();
    die;
}

$user_id = null;

if ($card_id !== null)
{
    $user_id = $db->get_user_id_by_card_id($card_id);
    if ($user_id === null)
    {
        send_response_invalid_id();
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