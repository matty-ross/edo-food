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

function html_echo($output)
{
    echo(htmlspecialchars($output, ENT_QUOTES | ENT_HTML5));
}

?>