<?php

session_start();

if(isset($_SESSION['access_token'])) {
    header("Location: /");
    exit();
}

echo '<!doctype html><html lang="en"><head><meta charset="utf-8"/><link rel="icon" href="/favicon.png"/><meta name="viewport" content="width=device-width,initial-scale=1"/><meta name="theme-color" content="#000000"/><meta name="description" content="Web site created using create-react-app"/><link rel="apple-touch-icon" href="/logo192.png"/><link rel="stylesheet" href="./assets/css/reset.css"/><link rel="stylesheet" href="./assets/libs/fontAwesome/fontawesome-free-5.15.4-web/css/all.css"/><link rel="stylesheet" href="./assets/libs/lineAwesome/1.3.0/css/line-awesome.min.css"/><link rel="manifest" href="/manifest.json"/><title>ToDo App || Authentication Page</title><script defer="defer" src="/static/js/main.09c494cd.js"></script><link href="/static/css/main.fb7a28ba.css" rel="stylesheet"></head><body><noscript>You need to enable JavaScript to run this app.</noscript><div id="root"></div></body></html>';