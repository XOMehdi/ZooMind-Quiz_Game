<?php
include('../secure.php');
include_once('../db/connection.php');

$username = $_SESSION['username'];


$sql = "SELECT * FROM progress P INNER JOIN quiz Q ON P.quiz_number = Q.number WHERE username = ? ORDER BY attempt_on DESC";
$progress_quiz_table = $conn->prepare($sql);
$progress_quiz_table->execute([$username]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/page.css">
    <title>ZooMind - Favourites</title>
    <?php include_once('../include/sidebar.php'); ?>

    <header>
        <h1>Favourites</h1>
    </header>
    <main>
        <div id="quiz-list">
            <?php while ($row = $progress_quiz_table->fetch(PDO::FETCH_OBJ)) : ?>
                <?php if ($row->is_favourite == "1") : ?>
                    <div class="quiz-card">
                        <h3 class="title"><?= $row->title ?></h3>
                        <div class="quiz-info-box">
                            <small>Category: <?= $row->category ?></small>
                            <small>Difficulty: <?= $row->difficulty ?></small>
                        </div>
                        <p class="description"><?= $row->description ?></p>
                        <ul class="quiz-info-box quiz-detail">
                            <li>Pass/Fail: <b><?= $row->count_passed . "/" . ($row->count_attempt - $row->count_passed) ?></b></li>
                            <li>High Score: <b><?= $row->high_score ?></b></li>
                            <li>Uploaded By: <b><?= $row->upload_by ?></b></li>
                            <li>Uploaded On: <b><?= $row->upload_on ?></b></li>
                            <li class="favourite-box">
                                <span><i id="heart-icon" class='bx bx-heart'></i></span>
                                <b> <?= $row->count_favourite ?></b>
                                <input id="is-favourite" type="hidden" name="is-favourite" value="0">
                            </li>
                        </ul>
                        <a class="play-link" href="./play.php?quiz-number=<?= $row->number ?>&is-favourite=0">Play</a>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    </main>
    </body>
    <footer></footer>

</html>