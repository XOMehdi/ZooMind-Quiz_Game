<?php

// include('../secure.php');
include_once('../db/connection.php');
session_start();

// if (isset($_GET['quiz-number'])) {
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

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
    <link rel="stylesheet" type="text/css" href="./css/play.css" />
    <title>ZooMind - Play</title>
</head>

<body>
    <header></header>
    <main>
        <h3><?= $row->quiz_title ?></h3>
        <small>Category: <?= $row->category ?></small>
        <small>Difficulty: <?= $row->difficulty ?></small>
        <p><?= $row->description ?></p>

        <?php while ($row = $question_table->fetch(PDO::FETCH_OBJ)) : ?>
        <ol>
            <li>
                <p><?= $row->statement ?></p>
                <ol>
                    <?php
                        $sql = "SELECT *, title AS option_title FROM options WHERE question_id = $row->id";
                        $option_table = $conn->query($sql);

                        while ($row = $option_table->fetch(PDO::FETCH_OBJ)) {
                            echo "<li>$row->option_title</li>";
                        } ?>
                </ol>
                <input type="number" name="selected_options[]" placeholder="Enter your selected option number">
            </li>
        </ol>
        <?php endwhile; ?>

        <!-- <h2>Question 1</h2>
            <p>What is the largest domestic cat breed?</p>
            <ul>
                <li>
                    <input id="siamese" name="q1-opts" type="radio" value="Siamese" />
                    <label for="siamese"><i>Siamese</i></label>
                </li>
                <li>
                    <input id="maine_coon" name="q1-opts" type="radio" value="Maine Coon" />
                    <label for="maine_coon"><i>Maine Coon</i></label>
                </li>
                <li>
                    <input id="bengal" name="q1-opts" type="radio" value="Bengal" />
                    <label for="bengal"><i>Bengal</i></label>
                </li>
                <li>
                    <input id="persian" name="q1-opts" type="radio" value="Persian" />
                    <label for="persian"><i>Persian</i></label>
                </li>
            </ul> 
        -->
    </main>
    <footer></footer>
</body>

</html>