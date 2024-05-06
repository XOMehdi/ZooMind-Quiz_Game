<?php

// include('../secure.php');
include_once('./connection.php');
session_start();

if (isset($_POST['btn-save'])) {

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];

    // $username = $_SESSION["username"];
    $username = "abc";

    $password = $_POST["password"];


    // print_r($questions);


    $sql = "UPDATE user SET first_name = ?, last_name = ?, password = ? WHERE username = ?";
    $query = $conn->prepare($sql);
    $query->execute([$first_name, $last_name, $password, $username]);

    header('Location: ../page/profile.php');
}
