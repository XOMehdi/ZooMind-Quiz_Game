<?php

include_once('./connection.php');
session_start();

$action = $_POST['action'];

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($action === "sign_up") {
    $username = test_input($_POST['username']);
    $first_name = test_input($_POST['first_name']);
    $last_name = test_input($_POST['last_name']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $query = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $query->execute([$username]);

    if ($query->rowCount() > 0) {
        echo "Username already exists. Please use a different username";
    } elseif ($password != $confirm_password) {
        echo "Passwords do not match";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = $conn->prepare("INSERT INTO user VALUES (?, ?, ?, ?)");
        $query->execute([$username, $first_name, $last_name, $hashed_password]);

        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

        echo "success";
    }
} elseif ($action === "sign_in") {
    $sign_in_username = test_input($_POST['sign_in-username']);
    $sign_in_password = $_POST['sign_in-password'];

    if (empty($sign_in_username) || empty($sign_in_password)) {
        echo "Please provide a username and a password";
    } else {
        $query = $conn->prepare("SELECT * FROM user WHERE username = ?");
        $query->execute([$sign_in_username]);

        if ($query->rowCount() > 0) {
            $row = $query->fetch(PDO::FETCH_OBJ);

            if (password_verify($sign_in_password, $row->password)) {

                $_SESSION['username'] = $sign_in_username;
                $_SESSION['password'] = $sign_in_password;

                echo "success";
            } else {
                echo "Password is incorrect";
            }
        } else {
            echo "Username does not exist";
        }
    }
} else {
    echo "failed";
}
