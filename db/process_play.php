<?php

include('../secure.php');
include_once('./connection.php');
session_start();

if (isset($_POST['btn-submit-quiz'])) {

    $username = $_SESSION["username"];

    $quiz_number = $_POST['quiz-number'];

    $question_ids = $_POST['question-ids'];
    $is_favourite = $_POST['is-favourite'];
    $selected_options = $_POST['selected-options'];

    $obtained_marks = 0;
    foreach ($selected_options as $index => $selected_option) {

        $sql = "SELECT * FROM options WHERE question_id = ? ORDER BY number ASC";
        $option_table = $conn->prepare($sql);
        $option_table->execute([$question_ids[$index]]);

        $count = 1;
        while ($row = $option_table->fetch(PDO::FETCH_OBJ)) {

            if ($count == $selected_option && $row->is_answer == "1") {
                $obtained_marks += 1;
            }

            $count += 1;
        }
    }

    $total_marks = sizeof($question_ids);
    $percentage = $obtained_marks / $total_marks * 100;
    $result = ($percentage >= 60) ? "pass" : "fail";

    $sql = "INSERT INTO progress (username, quiz_number, obtained_marks, total_marks, result, is_favourite) VALUES (?, ?, ?, ?, ?, ?)";
    $query = $conn->prepare($sql);
    $query->execute([$username, $quiz_number, $obtained_marks, $total_marks, $result, $is_favourite]);

    header("Location: ../page/play.php?quiz-number=$quiz_number");
}
