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


$id = $json->id ?? null;
$new_id = $json->newId ?? null;
$full_name = $json->fullName ?? null;
$email = $json->email ?? null;
$password = $json->password ?? null;
$add_credit = $json->addCredit ?? null;
$admin = $json->admin ?? false;

if (!is_valid_number($id))
{
    send_response_invalid_data();
    die;
}

if (is_valid_string($password))
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