<?php
session_start();

// header("Access-Control-Allow-Origin: *");

header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'].'/GoogleAuth/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/db-credentials.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/GoogleAuth/get-user-info.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/get-user-id.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/select-todo-list-by-userid.php';

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

$email = getUserInfoFromGoogleClientService($client, $_SESSION['access_token'])['email'];

// Create connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

$user_id = getUserIdByEmail($conn, $email);

if(!isset($user_id['error'])) {
    $todo_list = getToDoListByUserId($conn, $user_id);
    if(!isset($todo_list['error'])) {
        $flag = array(
            'todo_list' => $todo_list
        );
    
        echo json_encode($flag, true);
        $conn->close();
    }
}