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

if (!is_valid_string($name))
{
    send_json_response([
        'message' => 'Nevalidné údaje.'
    ]);
    die;
}

if ($db->add_allergen($name))
{
    send_json_response([
        'message' => 'Alergén pridaný.',
        'refresh' => true
    ]);
}
else
{
    send_json_response([
        'message' => 'Nepodarilo sa pridať alergén.'
    ]);
}

?>