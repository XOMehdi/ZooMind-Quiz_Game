<?php

// include('../secure.php');
include_once('./connection.php');
session_start();

if (isset($_POST['btn-post'])) {

    $title = $_POST["title"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $difficulty = $_POST["difficulty"];
    // $upload_by = $_SESSION["username"];
    $upload_by = "abc";
    $upload_on = date("d/m/y");


    $questions = $_POST["questions"];

    print_r($questions);


    $sql = "INSERT INTO quiz (title, description, category, difficulty, upload_by, upload_on) VALUES (?, ?, ?, ?, ?, ?)";
    $query = $conn->prepare($sql);
    $query->execute([$title, $description, $category, $difficulty, $upload_by, $upload_on]);

    $sql = "SELECT number FROM quiz ORDER BY number DESC LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_OBJ);




    // Display each question and its options
    foreach ($questions as $index => $question) {



        $id = "quiz" . $row->number . "_q" . ($index + 1);
        $statement = $question["statement"];
        $quiz_number = $row->number;

        $sql = "INSERT INTO question (id, statement, quiz_number) VALUES (?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->execute([$id, $statement, $quiz_number]);










        echo "<hr>";
        echo "Question " . ($index + 1) . ": " . $question["statement"] . "<br>";

        echo "Options:<br>";







        // hardcode correct option for a question
        $is_answer = "0";
        foreach ($question["options"] as $index => $option) {




            $sql = "INSERT INTO options (title, is_answer, question_id) VALUES (?, ?, ?)";
            $query = $conn->prepare($sql);
            $query->execute([$option, $is_answer, $id]);




            echo ($index + 1) . "- " . $option . "<br>";
        }
    }
} else {
    echo "Form not submitted!";
}
