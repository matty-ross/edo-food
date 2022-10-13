<?php

$root_dir = $_SERVER['DOCUMENT_ROOT'] . '/edo-food';

require_once $root_dir . '/functions/db.php';


function get_json_request()
{
    $json = file_get_contents('php://input');
    return json_decode($json);
}

function send_json_response($json)
{
    echo(json_encode($json, JSON_FORCE_OBJECT));
}

function hash_password($password)
{
    return hash_hmac('sha256', $password, 'AL8W53EFWgbwF9BD2BTr');
}

function get_logged_in_user($db)
{
    $user_id = $_SESSION['user-id'] ?? null;
    if (
        $user_id !== null &&
        $db->is_valid_user_id($user_id)
    )
    {
        return $user_id;
    }
    
    return null;
}


// TODO: remove these:

function is_user_logged_in($db)
{
    $user_id = $_SESSION['user-id'] ?? null;
    return
        $user_id !== null &&
        $db->is_valid_user_id($user_id);
}

function is_admin_logged_in($db)
{
    $user_id = $_SESSION['user-id'] ?? null;
    return 
        $user_id !== null &&
        $db->is_valid_user_id($user_id) &&
        $db->is_user_admin($user_id);
}

?>