<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: ../index.html");
    exit();
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
