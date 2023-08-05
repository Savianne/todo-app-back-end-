<?php

function addUserEmailToDb($conn, $email) {
    // Check connection
    if ($conn->connect_error) {
        $flag = array(
            'error' => $conn->connect_error
        );
    
        return $flag;
        exit();
    }

    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (email) VALUES (?)");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->close();
    return true;
}
