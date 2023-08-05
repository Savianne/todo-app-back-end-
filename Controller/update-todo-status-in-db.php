<?php

function updateToDoStatus($conn, $id, $status) {
    // Check connection
    if ($conn->connect_error) {
        $flag = array(
            'error' => $conn->connect_error
        );
        return $flag;
        exit();
    }

    // prepare and bind
    $stmt = $conn->prepare("UPDATE todo_list SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    
    $flag = array(
        'error' => $conn->connect_error
    );

    $stmt->close();
    return $flag;
    exit();
}