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

        $is_favourite = $progress_row->is_favourite;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/temp.css" />
    <script src="../js/play.js" defer></script>
    <title>ZooMind - Play</title>
    <?php include_once('../include/sidebar.php'); ?>

    <header>
        <h1>Play</h1>
    </header>
    <main class="main-text">
        <div id="outer-quiz-box">
            <form action="../db/process_play.php" method="post">
                <div id="quiz-box">
                    <input type="hidden" name="quiz-number" value="<?= $row->number ?>">
                    <input type="hidden" name="quiz-is-attempted" value="<?= $quiz_is_attempted ?>">
                    <h3 id="play-title"><?= $row->quiz_title ?></h3>
                    <div id="small-box">
                        <small>Category: <?= $row->category ?></small>
                        <small>Difficulty: <?= $row->difficulty ?></small>
                    </div>
                    <p id="play-description"><?= $row->description ?></p>
                    <div id="favourite-box">
                        <small>Add to Favourites</small>
                        <?php if ($is_favourite == "0") : ?>
                            <span><i id="heart-icon" class='bx bx-heart'></i></span>
                        <?php else : ?>
                            <span><i id="heart-icon" class='bx bxs-heart'></i></span>
                        <?php endif; ?>
                        <input id="is-favourite" type="hidden" name="is-favourite" value="<?= $is_favourite ?>">
                    </div>
                </div>

                <ol id="ordered-list-question">
                    <?php $index = 0;
                    while ($row = $question_table->fetch(PDO::FETCH_OBJ)) : ?>
                        <div class="question-box">
                            <li>
                                <input type="hidden" name="question-ids[]" value="<?= $row->id ?>">
                                <p class="play-question-statement"><?= $row->statement ?></p>
                                <ol id="ordered-list-option" class="ordered-list-option">
                                    <?php
                                    $sql = "SELECT *, title AS option_title FROM options WHERE question_id = ? ORDER BY number ASC";
                                    $option_table = $conn->prepare($sql);
                                    $option_table->execute([$row->id]);

                                    while ($row = $option_table->fetch(PDO::FETCH_OBJ)) {
                                        echo "<li class='play-question-option'>$row->option_title</li>";
                                    } ?>
                                </ol>

                                <input class="correct-option" type="number" name="selected-options[]" placeholder="Enter your selected option number">
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
                        </div>
                    <?php endwhile; ?>
                </ol>
                <div id="play-btn-box">
                    <input class="btn" type="submit" name="btn-submit-quiz" value="Evaluate">
                </div>
            </form>
            <output id="quiz-result">
                <?php if ($quiz_is_attempted) : ?>
                    <h2>Quiz Result</h2>
                    <p>Obtained Marks: <?= $obtained_marks ?></p>
                    <p>Total Marks: <?= $total_marks ?></p>
                    <p>Result: <?= $result ?></p>
                <?php endif; ?>
            </output>
        </div>
    </main>
    <footer></footer>
    </body>

</html>

<?php
setcookie('is_attempt_correct', '', time() - 3600, '/');

unset($_COOKIE['is_attempt_correct']);
