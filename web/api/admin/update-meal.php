<?php

require '../../functions/db.php';
require '../../functions/utility.php';

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

$id = $json->id ?? null;
$name = $json->name ?? null;
$price = $json->price ?? null;
$amount = $json->amount ?? null;

if (!is_valid_number($id))
{
    send_json_response([
        'message' => 'Nie je uvedené ID jedla.'
    ]);
    die;
}

if ($db->update_meal($id, $name, $price, $amount))
{
    send_json_response([
        'message' => 'Jedlo upravené.',
        'refresh' => true
    ]);
}
else
{
    send_json_response([
        'message' => 'Nepodarilo sa upraviť jedlo.'
    ]);
}

?>