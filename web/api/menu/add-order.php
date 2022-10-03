<?php

require_once '../../functions/db.php';
require_once '../../functions/utility.php';

header('Content-Type: application/json; charset=utf-8');
session_start();

$db = new Database();
$json = get_json_request();

if (!is_user_logged_in($db))
{
    send_json_response([
        'message' => 'Nie ste prihlásený.'
    ]);
    die;
}

$menu_item_id = $json->menuItemId ?? null;
$person_id = $_SESSION['user-id'] ?? null;

if (
    !is_valid_number($menu_item_id) ||
    !is_valid_number($person_id)
)
{
    send_json_response([
        'message' => 'Nevalidné údaje.'
    ]);
    die;
}

if ($db->add_order($menu_item_id, $person_id))
{
    send_json_response([
        'message' => 'Objednávka pridaná.',
        'refresh' => true
    ]);
}
else
{
    send_json_response([
        'message' => 'Nepodarilo sa pridať objednávku.'
    ]);
}

?>