<?php

$root_dir = $_SERVER['DOCUMENT_ROOT'] . '/edo-food';

require_once $root_dir . '/functions/utility.php';
require_once $root_dir . '/functions/db.php';
require_once $root_dir . '/functions/responses.php';
require_once $root_dir . '/functions/validators.php';
require_once $root_dir . '/functions/authentification.php';


session_start();

$db = new Database();
$json = get_json_request();

if (!authentificate_admin($db, $root_dir . '/login.php'))
{
    die;
}


$id = $json->id ?? null;
$full_name = $json->fullName ?? null;
$email = $json->email ?? null;
$password = $json->password ?? null;
$credit = $json->credit ?? null;
$admin = $json->admin ?? false;

if (
    !is_valid_number($id) ||
    !is_valid_string($full_name) ||
    !is_valid_string($email) ||
    !is_valid_string($password) ||
    !is_valid_number($credit) ||
    !is_valid_bool($admin)
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