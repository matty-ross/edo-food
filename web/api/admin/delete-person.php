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


$id = is_valid_number($json->id ?? null) ? $json->id : null;

if (
    $id === null
)
{
    send_response_invalid_data();
    die;
}

if ($db->delete_person($id))
{
    send_response_action_success();
}
else
{
    send_response_action_failure();
}

?>