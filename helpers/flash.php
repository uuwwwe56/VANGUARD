<?php
function flash($key)
{
    if (isset($_SESSION[$key])) {
        echo "<div class='alert alert-info'>" . $_SESSION[$key] . "</div>";
        unset($_SESSION[$key]);
    }
}
