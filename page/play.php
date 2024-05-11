<?php

include('../secure.php');
include_once('../db/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $username = $_SESSION['username'];

    $is_favourite = $_GET['is-favourite'] ?? "0";

    $quiz_number = test_input($_GET['quiz-number']);

    $sql = "SELECT *, title AS quiz_title FROM quiz WHERE number = ?";
    $quiz_table = $conn->prepare($sql);
    $quiz_table->execute([$quiz_number]);

    $row = $quiz_table->fetch(PDO::FETCH_OBJ);

    $sql = "SELECT * FROM question WHERE quiz_number = ?";
    $question_table = $conn->prepare($sql);
    $question_table->execute([$quiz_number]);


    $sql = "SELECT * FROM progress WHERE username = ? AND quiz_number = ? ORDER BY attempt_on DESC LIMIT 1";
    $progress_table = $conn->prepare($sql);
    $progress_table->execute([$username, $quiz_number]);
    $progress_row = $progress_table->fetch(PDO::FETCH_OBJ);

    $quiz_is_attempted = false;
    if ($progress_row) {
        $quiz_is_attempted = true;
        $obtained_marks = $progress_row->obtained_marks;
        $total_marks = $progress_row->total_marks;
        $result = $progress_row->result;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/play.css" />
    <script src="../js/play.js" defer></script>
    <title>ZooMind - Play</title>
</head>

<body>
    <header></header>
    <main>
        <form action="../db/process_play.php" method="post">
            <input type="hidden" name="quiz-number" value="<?= $row->number ?>">
            <h3><?= $row->quiz_title ?></h3>
            <small>Category: <?= $row->category ?></small>
            <small>Difficulty: <?= $row->difficulty ?></small>
            <p><?= $row->description ?></p>
            <div>
                <small>Add to Favourites</small>
                <img id="heart-icon" src="../img/heart_icon.png" alt="heart icon">
                <input id="is-favourite" type="hidden" name="is-favourite" value="<?= $is_favourite ?>">
            </div>


            <?php $index = 0;
            while ($row = $question_table->fetch(PDO::FETCH_OBJ)) : ?>
                <ol>
                    <li>
                        <input type="hidden" name="question-ids[]" value="<?= $row->id ?>">
                        <p><?= $row->statement ?></p>
                        <ol>
                            <?php
                            $sql = "SELECT *, title AS option_title FROM options WHERE question_id = ? ORDER BY number ASC";
                            $option_table = $conn->prepare($sql);
                            $option_table->execute([$row->id]);

                            while ($row = $option_table->fetch(PDO::FETCH_OBJ)) {
                                echo "<li>$row->option_title</li>";
                            } ?>
                        </ol>
                        <input type="number" name="selected-options[]" placeholder="Enter your selected option number">
                        <div>
                            <?php
                            if (isset($_COOKIE['is_attempt_correct'])) {
                                $is_attempt_correct = unserialize($_COOKIE['is_attempt_correct']);
                                if ($is_attempt_correct[$index]) {
                                    echo 'Correct <span>&#10003;</span>';
                                } else {
                                    echo 'Incorrect <span>&#10007;</span>';
                                }
                            }
                            $index += 1;
                            ?>
                        </div>
                    </li>
                </ol>
            <?php endwhile; ?>

            <input type="submit" name="btn-submit-quiz" value="Evaluate">
        </form>
        <output id="quiz-result">
            <?php if ($quiz_is_attempted) : ?>
                <h3>Quiz Result</h3>
                <p>Obtained Marks: <?= $obtained_marks ?></p>
                <p>Total Marks: <?= $total_marks ?></p>
                <p>Result: <?= $result ?></p>
            <?php endif; ?>
        </output>
    </main>
    <footer></footer>
</body>

</html>