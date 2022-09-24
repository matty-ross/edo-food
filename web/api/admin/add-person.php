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
$full_name = $json->fullName ?? null;
$email = $json->email ?? null;
$password = $json->password ?? null;
$credit = $json->credit ?? null;
$admin = $json->admin ?? false;

if (
    !is_valid_number($id) ||
    !is_valid_string($full_name) ||
    !is_valid_string($email) ||
    !is_valid_string($password) ||
    !is_valid_number($credit) ||
    !is_valid_bool($admin)
)
{
    send_json_response([
        'message' => 'Nevalidné údaje.'
    ]);
    die;
}

$password = hash_password($password);

if ($db->add_person($id, $full_name, $email, $password, $credit, $admin))
{
    send_json_response([
        'message' => 'Osoba pridaná.',
        'refresh' => true
    ]);
}
else
{
    send_json_response([
        'message' => 'Nepodarilo sa pridať osobu.'
    ]);
}

?>