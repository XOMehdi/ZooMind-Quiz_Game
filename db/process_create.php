<?php

include('../secure.php');
include_once('./connection.php');

if (isset($_POST['btn-post'])) {

    $title = $_POST["title"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $difficulty = $_POST["difficulty"];
    $questions = $_POST["questions"];

    $upload_by = $_SESSION["username"];

    $upload_on = date("y/m/d");

    $sql = "INSERT INTO quiz (title, description, category, difficulty, count_attempt, count_passed, upload_by, upload_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $query = $conn->prepare($sql);
    $query->execute([$title, $description, $category, $difficulty, "0", "0", $upload_by, $upload_on]);

    $sql = "SELECT number FROM quiz ORDER BY number DESC LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_OBJ);


    foreach ($questions as $index => $question) {

        $id = "quiz" . $row->number . "_q" . ($index + 1);
        $statement = $question["statement"];
        $quiz_number = $row->number;

        $sql = "INSERT INTO question (id, statement, quiz_number) VALUES (?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->execute([$id, $statement, $quiz_number]);

        foreach ($question["options"] as $index => $option) {

            $is_answer = ($index + 1 == $question["correct_option"]) ? "1" : "0";

            $sql = "INSERT INTO options (title, is_answer, question_id) VALUES (?, ?, ?)";
            $query = $conn->prepare($sql);
            $query->execute([$option, $is_answer, $id]);
        }
    }

    header("Location: ../page/explore.php");
} else {
    echo "Form not submitted!";
}
