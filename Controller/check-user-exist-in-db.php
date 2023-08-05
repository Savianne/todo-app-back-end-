<?php

function chechUserIfExist($conn, $email) {
    // Check connection
    if ($conn->connect_error) {
        $flag = array(
            'error' => $conn->connect_error
        );
    
        return $flag;
        exit();
    }

    // prepare and bind
    $stmt = $conn->prepare("SELECT COUNT(email) As exist FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result(); // get the mysqli result
    $user = $result->fetch_assoc(); // fetch data

    $stmt->close();
    return $user['exist']? true : false;
}


