<?php

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

function is_valid_string($value)
{
    return
        !in_array($value, [null, ''], true) &&
        is_string($value);
}

function is_valid_number($value)
{
    return
        !in_array($value, [null, ''], true) &&
        is_numeric($value);
}

function is_valid_bool($value)
{
    return in_array($value, [true, false]);
}

function is_valid_meal_type($meal_type)
{
    return
        is_valid_string($meal_type) &&
        in_array($meal_type, ['soup', 'main_dish'], true);
}

?>