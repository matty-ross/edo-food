<?php

$root_dir = $_SERVER['DOCUMENT_ROOT'] . '/edo-food';

require_once $root_dir . '/functions/utility.php';
require_once $root_dir . '/functions/db.php';
require_once $root_dir . '/functions/responses.php';


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

?>