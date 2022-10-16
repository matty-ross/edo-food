<?php

$root_dir = $_SERVER['DOCUMENT_ROOT'] . '/edo-food';

require_once $root_dir . '/functions/db.php';
require_once $root_dir . '/functions/responses.php';


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

function authentificate_admin($db, $goto = null)
{
    $user_id = get_logged_in_user($db);
    
    if ($user_id === null)
    {
        send_response_not_logged_in($goto);
        return false;
    }
    
    if (!$db->is_user_admin($user_id))
    {
        send_response_not_admin($goto);
        return false;
    }
    
    return true;
}

function authentificate_user($db, $goto = null)
{
    $user_id = get_logged_in_user($db);

    if ($user_id === null)
    {
        send_response_not_logged_in($goto);
        return false;
    }

    return true;
}

?>