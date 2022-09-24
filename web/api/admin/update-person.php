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
$new_id = $json->newId ?? null;
$full_name = $json->fullName ?? null;
$email = $json->email ?? null;
$password = $json->password ?? null;
$add_credit = $json->addCredit ?? null;
$admin = $json->admin ?? false;

if (!is_valid_number($id))
{
    send_json_response([
        'message' => 'Nie je uvedené ID osoby.'
    ]);
    die;
}

if (is_valid_string($password))
{
    $password = hash_password($password);
}

if ($db->update_person($id, $new_id, $full_name, $email, $password, $add_credit, $admin))
{
    send_json_response([
        'message' => 'Osoba upravená.',
        'refresh' => true
    ]);
}
else
{
    send_json_response([
        'message' => 'Nepodarilo sa upraviť osobu.'
    ]);
}

?>