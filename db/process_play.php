<?php

include('../secure.php');
include_once('./connection.php');

if (isset($_POST['btn-submit-quiz'])) {

    $username = $_SESSION["username"];

    $quiz_number = $_POST['quiz-number'];

    $quiz_is_attempted = $_POST['quiz-is-attempted'];

    $question_ids = $_POST['question-ids'];
    $is_favourite = $_POST['is-favourite'];
    $selected_options = $_POST['selected-options'];

    $obtained_marks = 0;
    $is_attempt_correct = array();
    foreach ($selected_options as $index => $selected_option) {

        $sql = "SELECT * FROM options WHERE question_id = ? ORDER BY number ASC";
        $option_table = $conn->prepare($sql);
        $option_table->execute([$question_ids[$index]]);

        $count = 1;
        while ($row = $option_table->fetch(PDO::FETCH_OBJ)) {

            if ($count == $selected_option) {
                if ($row->is_answer == "1") {
                    $obtained_marks += 1;
                    $is_attempt_correct[] = true;
                } else {
                    $is_attempt_correct[] = false;
                }
            }

            $count += 1;
        }
    }

    $total_marks = sizeof($question_ids);
    $percentage = $obtained_marks / $total_marks * 100;
    $result = ($percentage >= 60) ? "pass" : "fail";

    if (!$quiz_is_attempted) {
        $sql = "INSERT INTO progress (username, quiz_number, obtained_marks, total_marks, result, is_favourite) VALUES (?, ?, ?, ?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->execute([$username, $quiz_number, $obtained_marks, $total_marks, $result, $is_favourite]);
    } else {
        $sql = "UPDATE progress SET obtained_marks = ?, total_marks = ?, result = ?, is_favourite = ? WHERE username = ? AND quiz_number = ?";

        $query = $conn->prepare($sql);
        $query->execute([$obtained_marks, $total_marks, $result, $is_favourite, $username, $quiz_number]);
    }

    $serialized_array = serialize($is_attempt_correct);
    setcookie('is_attempt_correct', $serialized_array, time() + (86400 * 30), '/');

    header("Location: ../page/play.php?quiz-number=$quiz_number");
}
