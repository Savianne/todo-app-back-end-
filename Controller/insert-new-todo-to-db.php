<?php

function addNewToDo($conn, $data) {
    // Check connection
    if ($conn->connect_error) {
        $flag = array(
            'error' => $conn->connect_error
        );
    
        return $flag;
        exit();
    }

    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO todo_list (title, user) VALUES (?, ?)");
    $stmt->bind_param("si", $title, $user);

    $title = $data['title'];
    $user = $data['user'];

    $stmt->execute();

    $stmt->close();
    return true;
}