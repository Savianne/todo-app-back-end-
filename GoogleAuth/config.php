<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

$client = new Google_Client();

$client->setClientId("1039577766126-hf1col2vteepfi9l8vr5u2r77pusc04v.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost:82/GoogleAuth/authenticate.php");
$client->addScope('email');
$client->addScope('profile');