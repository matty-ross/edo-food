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

$name = $json->name ?? null;
$price = $json->price ?? null;
$amount = $json->amount ?? null;
$meal_type = $json->mealType ?? null;
$allergens = $json->allergens ?? [];

if (
    !is_valid_string($name) ||
    !is_valid_number($price) ||
    !is_valid_number($amount) ||
    !is_valid_meal_type($meal_type) ||
    !is_valid_numeric_array($allergens)
)
{
    send_json_response([
        'message' => 'Nevalidné údaje.'
    ]);
    die;
}

if ($db->add_meal($name, $price, $amount, $meal_type, $allergens))
{
    send_json_response([
        'message' => 'Jedlo pridané.',
        'refresh' => true
    ]);
}
else
{
    send_json_response([
        'message' => 'Nepodarilo sa pridať jedlo.'
    ]);
}

?>