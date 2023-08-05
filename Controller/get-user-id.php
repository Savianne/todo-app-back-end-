<?php

function getUserIdByEmail($conn, $email) {
    // Check connection
    if ($conn->connect_error) {
        $flag = array(
            'error' => $conn->connect_error
        );
    
        return $flag;
        exit();
    }

    // prepare and bind
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result(); // get the mysqli result
    $id = $result->fetch_assoc(); // fetch data

    $stmt->close();
    return $id['id'];
}