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

if (!authentificate_admin($db, 'login.php'))
{
    die;
}


$id = is_valid_number($json->id ?? null) ? $json->id : null;
$new_id = is_valid_number($json->newId ?? null) ? $json->newId : null;
$full_name = is_valid_string($json->fullName ?? null) ? $json->fullName : null;
$email = is_valid_string($json->email ?? null) ? $json->email : null;
$password = is_valid_string($json->password ?? null) ? $json->password : null;
$add_credit = is_valid_number($json->addCredit ?? null) ? $json->addCredit : null;
$admin = is_valid_bool($json->admin ?? null) ? $json->admin : null;

if (
    $id === null
)
{
    send_response_invalid_data();
    die;
}

if ($password !== null)
{
    $password = hash_password($password);
}

if ($db->update_person($id, $new_id, $full_name, $email, $password, $add_credit, $admin))
{
    send_response_action_success();
}
else
{
    send_response_action_failure();
}

?>