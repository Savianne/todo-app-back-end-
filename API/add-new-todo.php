<?php
session_start();

// header("Access-Control-Allow-Origin: *");

header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'].'/GoogleAuth/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/db-credentials.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/GoogleAuth/get-user-info.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/get-user-id.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/insert-new-todo-to-db.php';

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

$json = file_get_contents('php://input');

$params = json_decode($json, true);

if(isset($user_id['error'])) {
    $flag = array(
        'error' => $user_id['error'],
    );  

    echo json_encode($flag, true);
    die();
}

$params['user'] = $user_id;

$add_to_db = addNewToDo($conn, $params);

if(isset($add_to_db['error'])) {
    $flag = array(
        'error' => add_to_db['error'],
    );

    echo json_encode($flag, true);
    die();
}

$flag = array(
    'error' => false,
);

echo json_encode($flag, true);
die();


