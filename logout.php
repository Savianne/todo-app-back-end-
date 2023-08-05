<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/GoogleAuth/config.php';

if(!isset($_SESSION['access_token'])) {
    header('Location: /login-with-google.php');
    exit();
}

$client->revokeToken();

session_destroy();

header('Location: /login-with-google.php');