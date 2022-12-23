<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/utility.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/responses.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/validators.php';


$db = new Database();
$json = get_json_request();


$user_id = is_valid_number($json->userId ?? null) ? $json->userId : null;

if ($user_id === null)
{
    send_response_invalid_data();
    die;
}

if (!$db->is_valid_user_id($user_id))
{
    send_response_invalid_id();
    die;
}

$orders = $db->get_user_orders($user_id);

send_json_response([
    'orders' => $orders,
]);

?>