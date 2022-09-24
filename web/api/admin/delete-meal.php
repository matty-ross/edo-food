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

if (!is_valid_number($id))
{
    send_json_response([
        'message' => 'Nie je uvedené ID jedla.'
    ]);
    die;
}

if ($db->delete_meal($id))
{
    send_json_response([
        'message' => 'Jedlo vymazané.',
        'refresh' => true
    ]);
}
else
{
    send_json_response([
        'message' => 'Nepodarilo sa vymazať jedlo.'
    ]);
}

?>