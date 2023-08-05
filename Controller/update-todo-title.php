<?php

function updateToDoTitle($conn, $id, $title) {
    // Check connection
    if ($conn->connect_error) {
        $flag = array(
            'error' => $conn->connect_error
        );
        return $flag;
        exit();
    }

    // prepare and bind
    $stmt = $conn->prepare("UPDATE todo_list SET title = ? WHERE id = ?");
    $stmt->bind_param("si", $title, $id);
    $stmt->execute();
    
    $flag = array(
        'error' => false
    );

    $stmt->close();
    return $flag;
    exit();
}