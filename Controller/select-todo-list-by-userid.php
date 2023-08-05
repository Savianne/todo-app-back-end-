<?php

function getToDoListByUserId($conn, $id) {
    // Check connection
    if ($conn->connect_error) {
        $flag = array(
            'error' => $conn->connect_error
        );
    
        return $flag;
        exit();
    }

    // prepare and bind
    $stmt = $conn->prepare("SELECT * FROM todo_list WHERE user = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();

    $result = $stmt->get_result(); // get the mysqli result

    $list = array();
    while ($row = $result->fetch_assoc()) {
        array_push($list, $row);
    }

    $stmt->close();
    return $list;
}