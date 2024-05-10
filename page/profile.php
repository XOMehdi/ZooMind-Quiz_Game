<?php

include('../secure.php');
include_once('../db/connection.php');

$username = $_SESSION['username'];

$sql = "SELECT * FROM user WHERE username = ?";
$user_table = $conn->prepare($sql);
$user_table->execute([$username]);

$row_user = $user_table->fetch(PDO::FETCH_OBJ);

$sql = "SELECT * FROM quiz INNER JOIN user ON upload_by = ?";
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

    <header></header>
    <main>
        <h1>Profile</h1>
        <div>
            <form id="edit-profile-form" action="../db/process_profile.php" method="post">
                <h2>Personal Information</h2>
                <label for="first_name">First Name:</label>
                <input id="first_name" class="editable-input" type="text" name="first_name" readonly value="<?= $row_user->first_name ?>" />

                <label for="last_name">Last Name:</label>
                <input id="last_name" class="editable-input" type="text" name="last_name" readonly value="<?= $row_user->last_name ?>" />

                <label for="username">Username:</label>
                <input id="username" type="text" name="username" readonly value="<?= $row_user->username ?>" />

                <label for="password">Password:</label>
                <input id="password" class="password" type="password" name="password" readonly value="<?= $row_user->password ?>" />

                <input id="btn-edit" type="button" value="Edit">
                <input type="submit" value="Save" name="btn-save">
            </form>
        </div>
        <div>
            <h2>Quiz Data</h2>

            <label>Created:</label>
            <span><?= $count_row_quiz_user ?></span>
            <br>

            <label>Solved:</label>
            <span><?= $count_quiz_solved ?></span>
            <br>

            <label>Passed:</label>
            <span><?= $count_quiz_passed ?></span>
            <br>

            <label>Failed:</label>
            <span><?= $count_quiz_solved - $count_quiz_passed ?></span>
            <br>

            <label>Favourite:</label>
            <span><?= $count_quiz_favourite ?></span>
            <br>
        </div>
        <div>
            <h2>Solved Quizzes</h2>
            <ol>
                <?php while ($row = $progress_quiz_table->fetch(PDO::FETCH_OBJ)) : ?>
                    <li>
                        <h3><?= $row->title ?></h3>
                        <small>Category: <?= $row->category ?></small>
                        <small>Difficulty: <?= $row->difficulty ?></small>
                        <p><?= $row->description ?></p>
                        <small>Marks: <?= $row->obtained_marks . '/' . $row->total_marks ?></small>
                        <small>Result: <?= $row->result ?></small>
                        <small>Attempted on: <?= $row->attempt_on ?></small>

                        <?php if ($row->is_favourite == "1") : ?>
                            <img src="../img/heart_filled_icon.png" alt="filled heart icon">
                        <?php else : ?>
                            <img src="../img/heart_icon.png" alt="heart icon">
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
            </ol>
        </div>
    </main>
    <footer></footer>
    </body>

</html>