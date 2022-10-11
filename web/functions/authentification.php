<?php

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