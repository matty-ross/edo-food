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


$name = is_valid_string($json->name ?? null) ? $json->name : null;

if (
    $name === null
)
{
    send_response_invalid_data();
    die;
}

if ($db->add_allergen($name))
{
    send_response_action_success();
}
else
{
    send_response_action_failure();
}

?>