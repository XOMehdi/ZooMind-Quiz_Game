<?php

include_once('./connection.php');
session_start();

if (isset($_POST['btn-sign_up'])) {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];

    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = $conn->prepare("INSERT INTO user VALUES (?, ?, ?, ?)");
    $query->execute([$username, $first_name, $last_name, $password]);

    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    // $_SESSION['password'] = $hashed_password;

    header('Location: ../page/explore.php');
} else {
    $sign_in_username = $_POST['sign_in-username'];
    $sign_in_password = $_POST['sign_in-password'];

    // $hashed_sign_in_password = password_hash($sign_in_password, PASSWORD_DEFAULT);

    $query = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $query->execute([$sign_in_username]);

    $row = $query->fetch(PDO::FETCH_OBJ);

    if ($sign_in_username === $row->username && $sign_in_password === $row->password) {
        // if ($sign_in_username === $row->username && password_verify($hashed_sign_in_password, $row->password)) {

        $_SESSION['username'] = $sign_in_username;
        $_SESSION['password'] = $sign_in_password;
        // $_SESSION['password'] = $hashed_sign_in_password;

        echo "success";
    } else {
        echo 'Invalid username or password';
    }
}
