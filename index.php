<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/GoogleAuth/config.php';

if(!isset($_SESSION['access_token'])) {
    header("Location: /login-with-google.php");
    exit();
} 

echo '<!doctype html><html lang="en"><head><meta charset="utf-8"/><link rel="icon" href="/favicon.png"/><meta name="viewport" content="width=device-width,initial-scale=1"/><meta name="theme-color" content="#000000"/><meta name="description" content="Web site created using create-react-app"/><link rel="apple-touch-icon" href="/logo192.png"/><link rel="stylesheet" href="./assets/css/reset.css"/><link rel="manifest" href="/manifest.json"/><title>ToDo App</title><script defer="defer" src="/static/js/app/main.d264f63d.js"></script><link href="/static/css/app/main.09248036.css" rel="stylesheet"></head><body><noscript>You need to enable JavaScript to run this app.</noscript><div id="root"></div></body></html>';