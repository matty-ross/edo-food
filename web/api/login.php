<?php

$root_dir = $_SERVER['DOCUMENT_ROOT'] . '/edo-food';

require_once $root_dir . '/functions/utility.php';
require_once $root_dir . '/functions/db.php';
require_once $root_dir . '/functions/responses.php';
require_once $root_dir . '/functions/validators.php';


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
    send_response_invalid_data();
    die;
}

$password = hash_password($password);
$user_id = $db->get_user_id($email, $password);
$_SESSION['user-id'] = $user_id;

if ($user_id === null)
{
    send_response_invalid_email_or_password();
    die;
}

send_json_response([
    'goto' => $goto,
]);

?>