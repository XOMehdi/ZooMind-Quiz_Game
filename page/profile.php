<?php

include('../secure.php');
include_once('../db/connection.php');

$username = $_SESSION['username'];
$password = $_SESSION['password'];

$sql = "SELECT * FROM user WHERE username = ?";
$user_table = $conn->prepare($sql);
$user_table->execute([$username]);

$row_user = $user_table->fetch(PDO::FETCH_OBJ);

$sql = "SELECT * FROM quiz WHERE upload_by = ?";
$quiz_table = $conn->prepare($sql);
$quiz_table->execute([$username]);

$count_row_quiz_user = 0;
while ($row_quiz_user = $quiz_table->fetch(PDO::FETCH_OBJ)) {
    $count_row_quiz_user += 1;
}

$sql = "SELECT * FROM progress WHERE username = ?";
$progress_table = $conn->prepare($sql);
$progress_table->execute([$username]);

$count_quiz_solved = 0;
$count_quiz_passed = 0;

$count_quiz_favourite = 0;

while ($row_progress_user = $progress_table->fetch(PDO::FETCH_OBJ)) {
    $count_quiz_solved += 1;

    if ($row_progress_user->result == "pass") {
        $count_quiz_passed += 1;
    }

    if ($row_progress_user->is_favourite == 1) {
        $count_quiz_favourite += 1;
    }
}

$sql = "SELECT * FROM progress P INNER JOIN quiz Q ON P.quiz_number = Q.number WHERE username = ? ORDER BY attempt_on DESC";
$progress_quiz_table = $conn->prepare($sql);
$progress_quiz_table->execute([$username]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/profile.css" />
    <script src="../js/profile.js" defer></script>
    <title>ZooMind - Profile</title>
    <?php include_once('../include/sidebar.php'); ?>

    <header>
        <h1>Profile</h1>
    </header>
    <main>
        <div class="outer-box">
            <h2>Personal Information</h2>
            <form id="edit-profile-form" action="../db/process_profile.php" method="post">
                <div id="personal-box">
                    <div>
                        <label for="first_name">First Name:</label>
                        <input id="first_name" class="editable-input" type="text" name="first_name" readonly value="<?= $row_user->first_name ?>" />
                    </div>
                    <div>
                        <label for="last_name">Last Name:</label>
                        <input id="last_name" class="editable-input" type="text" name="last_name" readonly value="<?= $row_user->last_name ?>" />
                    </div>
                    <div>
                        <label for="username">Username:</label>
                        <input id="username" type="text" name="username" readonly disabled value="<?= $row_user->username ?>" />
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input id="password" class="editable-input" type="password" name="password" readonly value="<?= $password ?>" />
                    </div>
                    <div>
                        <input class="btn" id="btn-edit" type="button" value="Edit">
                        <input class="btn" type="submit" value="Save" name="btn-save">
                    </div>
                </div>
            </form>
        </div>
        <div class="outer-box">
            <h2>Quiz Data</h2>
            <ul id="quiz-data-box">
                <li>Created: <?= $count_row_quiz_user ?></li>
                <li>Solved: <?= $count_quiz_solved ?></li>
                <li>Passed: <?= $count_quiz_passed ?></li>
                <li>Failed: <?= $count_quiz_solved - $count_quiz_passed ?></li>
                <li>Favourite: <?= $count_quiz_favourite ?></li>
            </ul>
        </div>
        <div class="outer-box">
            <h2>Solved Quizzes</h2>
            <div id="quiz-list">
                <?php while ($row = $progress_quiz_table->fetch(PDO::FETCH_OBJ)) : ?>
                    <div class="quiz-card">
                        <h3 class="title"><?= $row->title ?></h3>
                        <div class="quiz-info-box">
                            <small>Category: <?= $row->category ?></small>
                            <small>Difficulty: <?= $row->difficulty ?></small>
                        </div>
                        <p class="description"><?= $row->description ?></p>
                        <ul class="quiz-info-box quiz-detail">
                            <li>Pass/Fail: <b><?= $row->count_passed . "/" . $row->count_attempt - $row->count_passed ?></b></li>
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
                <?php endwhile; ?>
            </div>
        </div>
    </main>
    <footer></footer>
    </body>

</html>