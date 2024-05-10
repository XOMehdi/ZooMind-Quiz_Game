<?php

include('../secure.php');
include_once('../db/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $is_favourite = $_GET['is-favourite'] ?? "0";

    $quiz_number = $_GET['quiz-number'];

    $sql = "SELECT *, title AS quiz_title FROM quiz WHERE number = ?";
    $quiz_table = $conn->prepare($sql);
    $quiz_table->execute([$quiz_number]);

    $row = $quiz_table->fetch(PDO::FETCH_OBJ);

    $sql = "SELECT * FROM question WHERE quiz_number = ?";
    $question_table = $conn->prepare($sql);
    $question_table->execute([$quiz_number]);
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
                </small>

                <?php while ($row = $question_table->fetch(PDO::FETCH_OBJ)) : ?>
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
                        </li>
                    </ol>
                <?php endwhile; ?>

                <input type="submit" name="btn-submit-quiz" value="Submit">
        </form>
    </main>
    <footer></footer>
</body>

</html>