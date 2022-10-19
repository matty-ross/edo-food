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
$price = is_valid_number($json->price ?? null) ? $json->price : null;
$amount = is_valid_number($json->amount ?? null) ? $json->amount : null;
$meal_type = is_valid_meal_type($json->mealType ?? null) ? $json->mealType : null;
$allergens = is_valid_numeric_array($json->allergens ?? null) ? $json->allergens : [];

if (
    $name === null ||
    $price === null ||
    $amount === null ||
    $meal_type === null
)
{
    send_response_invalid_data();
    die;
}

if ($db->add_meal($name, $price, $amount, $meal_type, $allergens))
{
    send_response_action_success();
}
else
{
    send_response_action_failure();
}

?>