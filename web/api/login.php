<?php

require_once '../functions/db.php';
require_once '../functions/utility.php';

header('Content-Type: application/json; charset=utf-8');
session_start();

$db = new Database();
$json = get_json_request();

$email = $json->email ?? null;
$password = $json->password ?? null;
$goto = $json->goto ?? 'menu.php';

if (
    !is_valid_string($email) ||
    !is_valid_string($password)
)
{
    send_json_response([
        'message' => 'Nevalidné údaje.'
    ]);
    die;
}

$password = hash_password($password);
$user_id = $db->get_user_id($email, $password);
$_SESSION['user-id'] = $user_id;

if ($user_id === null)
{
    send_json_response([
        'message' => 'Email alebo heslo nie je správne.'
    ]);
    die;
}

send_json_response([
    'goto' => $goto
]);

?>