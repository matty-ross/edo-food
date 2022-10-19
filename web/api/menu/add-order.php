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


$menu_item_id = is_valid_number($json->menuItemId ?? null) ? $json->menuItemId : null;
$user_id = get_logged_in_user($db);

if (
    $menu_item_id === null ||
    $user_id === null
)
{
    send_response_invalid_data();
    die;
}

if ($db->add_order($menu_item_id, $user_id))
{
    send_response_action_success();
}
else
{
    send_response_action_failure();
}

?>