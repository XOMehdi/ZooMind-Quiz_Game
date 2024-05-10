<?php

include('../secure.php');
include_once('./connection.php');

if (isset($_POST['btn-save'])) {

    $first_name = test_input($_POST["first_name"]);
    $last_name = test_input($_POST["last_name"]);

    $username = $_SESSION["username"];
    $password = test_input($_POST["password"]);

    $sql = "UPDATE user SET first_name = ?, last_name = ?, password = ? WHERE username = ?";
    $query = $conn->prepare($sql);
    $query->execute([$first_name, $last_name, $password, $username]);

    header('Location: ../page/profile.php');
}
