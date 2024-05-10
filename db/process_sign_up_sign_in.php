<?php

include_once('./connection.php');
session_start();

$action = $_POST['action'];

if ($action === "sign_up") {
    $username = test_input($_POST['username']);
    $first_name = test_input($_POST['first_name']);
    $last_name = test_input($_POST['last_name']);
    $password = test_input($_POST['password']);
    $confirm_password = test_input($_POST['confirm_password']);

    if ($password === $confirm_password) {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = $conn->prepare("INSERT INTO user VALUES (?, ?, ?, ?)");

        // $query->execute([$username, $first_name, $last_name, $password]);
        $query->execute([$username, $first_name, $last_name, $hashed_password]);

        $_SESSION['username'] = $username;
        // $_SESSION['password'] = $password;

        $_SESSION['password'] = $hashed_password;

        echo "success";
    } else {
        echo "Passwords do not match";
    }
} elseif ($action === "sign_in") {
    $sign_in_username = test_input($_POST['sign_in-username']);
    $sign_in_password = test_input($_POST['sign_in-password']);

    $hashed_sign_in_password = password_hash($sign_in_password, PASSWORD_DEFAULT);

    $query = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $query->execute([$sign_in_username]);

    $row = $query->fetch(PDO::FETCH_OBJ);

    // if ($sign_in_username === $row->username && $sign_in_password === $row->password) {
    if ($sign_in_username === $row->username && password_verify($sign_in_password, $row->password)) {

        $_SESSION['username'] = $sign_in_username;

        // $_SESSION['password'] = $sign_in_password;
        $_SESSION['password'] = $hashed_sign_in_password;

        echo "success";
    } else {
        echo 'Invalid username or password';
    }
} else {
    // Handle invalid action
}
