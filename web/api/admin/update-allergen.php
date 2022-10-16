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
$name = is_valid_string($json->name ?? null) ? $json->name : null;

if (
    $id === null
)
{
    send_response_invalid_data();
    die;
}

if ($db->update_allergen($id, $name))
{
    send_response_action_success();
}
else
{
    send_response_action_failure();
}

?>