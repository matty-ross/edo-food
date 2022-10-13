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


$meal_id = $json->mealId ?? null;
$date = $json->date ?? null;

if (
    !is_valid_number($meal_id) ||
    !is_valid_date($date)
)
{
    send_response_invalid_data();
    die;
}

if ($db->add_menu_item($meal_id, $date))
{
    send_response_action_success();
}
else
{
    send_response_action_failure();
}

?>