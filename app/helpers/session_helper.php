<?php

function isLoggedIn()
{
    session_start();
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}

?>