<?php

function deleteCompleted($conn, $user) {
    // Check connection
    if ($conn->connect_error) {
        $flag = array(
            'error' => $conn->connect_error
        );
    
        return $flag;
        exit();
    }

    // prepare and bind
    $stmt = $conn->prepare("DELETE FROM todo_list WHERE user = ? AND status = ?");
    $stmt->bind_param("is", $user, $status);

    $user = $user;
    $status = 'done';
    $stmt->execute();

    $stmt->close();
    return true;
}