<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/utility.php';


function send_response_invalid_email_or_password()
{
    http_response_code(401);
    header('Content-Type: application/json');

    send_json_response([
        'message' => 'Email alebo heslo nie je správne.',
    ]);
}

function send_response_not_logged_in($goto = null)
{
    http_response_code(401);
    header('Content-Type: application/json');
    
    send_json_response([
        'message' => 'Nie ste prihlásený.',
        'goto' => $goto,
    ]);
}

function send_response_not_admin($goto = null)
{
    http_response_code(403);
    header('Content-Type: application/json');
    
    send_json_response([
        'message' => 'Nemáte administrátorske oprávnenia.',
        'goto' => $goto,
    ]);
}

function send_response_invalid_data()
{
    http_response_code(400);
    header('Content-Type: application/json');
    
    send_json_response([
        'message' => 'Nevalidné údaje.',
    ]);
}

function send_response_action_success($refresh = true)
{
    http_response_code(200);
    header('Content-Type: application/json');
    
    send_json_response([
        'message' => 'Akcia prebehla úspešne.',
        'refresh' => $refresh,
    ]);
}

function send_response_action_failure()
{
    http_response_code(500);
    header('Content-Type: application/json');
    
    send_json_response([
        'message' => 'Nepodarilo sa vykonať akciu.',
    ]);
}

function send_response_not_owning_order()
{
    http_response_code(403);
    header('Content-Type: application/json');

    send_json_response([
        'message' => 'Objednávka nepatrí vám.',
    ]);
}

?>