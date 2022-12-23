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

$menu_item_price = $db->get_menu_item_price($menu_item_id);
$user_credit = $db->get_user_credit($user_id);

if ($user_credit < $menu_item_price)
{
    send_response_not_enough_credit();
    die;
}

if (
    $db->add_order($menu_item_id, $user_id) &&
    $db->substract_user_credit($user_id, $menu_item_price)
)
{
    send_response_action_success();
}
else
{
    send_response_action_failure();
}

?>