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


$id = $json->id ?? null;

if (!is_valid_number($id))
{
    send_response_invalid_data();
    die;
}

if ($db->delete_menu_item($id))
{
    send_response_action_success();
}
else
{
    send_response_action_failure();
}

?>