<?php
session_start();

// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Header: *");

header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'].'/db-credentials.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/delete-todo-in-db.php';

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

$json = file_get_contents('php://input');

$params = json_decode($json, true);

// Create connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

$delete_todo = deleteToDo($conn, $params['id']);

if(isset($delete_todo['error'])) {
    $flag = array(
        'error' => $delete_todo['error'],
    );

    echo json_encode($flag, true);
    die();
}

$flag = array(
    'error' => false,
);

echo json_encode($flag, true);
die();


