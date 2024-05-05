<?php

include_once('./connection.php');
session_start();

if (isset($_POST['btn-post'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    // $questions = array();
    // get length of the ordered list to
    // run loop from 1 to length
    // $ques[] = $_POST['ques' + i];

}
