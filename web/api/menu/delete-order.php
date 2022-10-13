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

if (!authentificate_user($db, 'login.php'))
{
    die;
}


$id = $json->id ?? null;
$user_id = get_logged_in_user($db);

if (!is_valid_number($id))
{
    send_response_invalid_data();
    die;
}

if (!$db->order_belongs_to_user($id, $user_id))
{
    send_response_not_owning_order();
    die;
}

if ($db->delete_order($id))
{
    send_response_action_success();
}
else
{
    send_response_action_failure();
}

?>