<?php

require_once '../../functions/db.php';
require_once '../../functions/utility.php';

header('Content-Type: application/json; charset=utf-8');
session_start();

$db = new Database();
$json = get_json_request();

if (!is_admin_logged_in($db))
{
    send_json_response([
        'message' => 'Nemáte administrátorske oprávnenia.'
    ]);
    die;
}

$meal_id = $json->mealId ?? null;
$date = $json->date ?? null;

if (
    !is_valid_number($meal_id) ||
    !is_valid_date($date)
)
{
    send_json_response([
        'message' => 'Nevalidné údaje.'
    ]);
    die;
}

if ($db->add_menu_item($meal_id, $date))
{
    send_json_response([
        'message' => 'Položka do menu pridaná.',
        'refresh' => true
    ]);
}
else
{
    send_json_response([
        'message' => 'Nepodarilo sa pridať poožku do menu.'
    ]);
}

?>