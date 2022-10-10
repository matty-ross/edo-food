<?php

require_once '../../functions/db.php';
require_once '../../functions/utility.php';

header('Content-Type: application/json; charset=utf-8');
session_start();

$db = new Database();
$json = get_json_request();

if (!is_user_logged_in($db))
{
    send_json_response([
        'message' => 'Nie ste prihlásený.'
    ]);
    die;
}

$id = $json->id ?? null;
$user_id = $_SESSION['user-id'] ?? null;

if (!is_valid_number($id))
{
    send_json_response([
        'message' => 'Nie je uvedené ID objednávky.'
    ]);
    die;
}

if (!$db->order_belongs_to_user($id, $user_id))
{
    send_json_response([
        'message' => 'Objednávka nepatrí vám.'
    ]);
    die;
}

if ($db->delete_order($id))
{
    send_json_response([
        'message' => 'Objednávka vymazaná.',
        'refresh' => true
    ]);
}
else
{
    send_json_response([
        'message' => 'Nepodarilo sa vymazať objednávku.'
    ]);
}

?>