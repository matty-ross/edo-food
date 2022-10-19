<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/utility.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/responses.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/validators.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/authentification.php';


session_start();

$db = new Database();
$json = get_json_request();

if (!authentificate_user($db, './login.php'))
{
    die;
}


$id = is_valid_number($json->id ?? null) ? $json->id : null;
$user_id = get_logged_in_user($db);

if (
    $id === null ||
    $user_id === null
)
{
    send_response_invalid_data();
    die;
}

if (!$db->order_belongs_to_user($id, $user_id))
{
    send_response_not_owning_order();
    die;
}

if ($db->delete_order($id))
{
    send_response_action_success();
}
else
{
    send_response_action_failure();
}

?>