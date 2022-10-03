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

$id = $json->id ?? null;

if (!is_valid_number($id))
{
    send_json_response([
        'message' => 'Nie je uvedené ID osoby.'
    ]);
    die;
}

if ($db->delete_person($id))
{
    send_json_response([
        'message' => 'Osoba vymazaná.',
        'refresh' => true
    ]);
}
else
{
    send_json_response([
        'message' => 'Nepodarilo sa vymazať osobu.'
    ]);
}

?>