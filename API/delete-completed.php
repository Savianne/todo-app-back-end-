<?php
session_start();

// header("Access-Control-Allow-Origin: *");

header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'].'/GoogleAuth/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/db-credentials.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/GoogleAuth/get-user-info.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/get-user-id.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/insert-new-todo-to-db.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/delete-completed-todo-in-db.php';

if(!(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST')) {
    $flag = array(
        'error' => 'Cannot Get Request!',
    );

    echo json_encode($flag, true);
    die();
}

if(!isset($_SESSION['access_token'])) {
    $flag = array(
        'error' => 'unauthenticate',
    );

    echo json_encode($flag, true);
    die();
}

// Create connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

$email = getUserInfoFromGoogleClientService($client, $_SESSION['access_token'])['email'];
$user_id = getUserIdByEmail($conn, $email);

if(isset($user_id['error'])) {
    $flag = array(
        'error' => $user_id['error'],
    );

    echo json_encode($flag, true);
    die();
}

$delete_completed = deleteCompleted($conn, $user_id);

if(isset($delete_completed['error'])) {
    $flag = array(
        'error' => $delete_completed['error'],
    );

    echo json_encode($flag, true);
    die();
}

$flag = array(
    'error' => false,
);

echo json_encode($flag, true);
die();


