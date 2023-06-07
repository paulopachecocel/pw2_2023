<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION["login"])) {
    header("Location: views/form_login.php");
}
