<?php

function deleteToDo($conn, $id) {
    // Check connection
    if ($conn->connect_error) {
        $flag = array(
            'error' => $conn->connect_error
        );
    
        return $flag;
        exit();
    }

    // prepare and bind
    $stmt = $conn->prepare("DELETE FROM todo_list WHERE id = ?");
    $stmt->bind_param("i", $id);

    $stmt->execute();

    $stmt->close();
    return true;
}