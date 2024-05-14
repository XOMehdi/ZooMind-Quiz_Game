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
    <link rel="stylesheet" type="text/css" href="../css/favourite.css">
    <title>ZooMind - Favourites</title>
    <?php include_once('../include/sidebar.php'); ?>

    <header>
        <h1>Favourites</h1>
    </header>
    <main>
        <ol id="quiz-list">
            <?php while ($row = $progress_quiz_table->fetch(PDO::FETCH_OBJ)) : ?>
                <?php if ($row->is_favourite == "1") : ?>
                    <li class="quiz-card">
                        <h3><?= $row->title ?></h3>
                        <small>Category: <?= $row->category ?></small>
                        <small>Difficulty: <?= $row->difficulty ?></small>
                        <p><?= $row->description ?></p>
                        <small>Marks: <?= $row->obtained_marks . '/' . $row->total_marks ?></small>
                        <small>Result: <?= $row->result ?></small>
                        <small>Attempted on: <?= $row->attempt_on ?></small>
                        <img src="../img/heart_filled_icon.png" alt="filled heart icon">
                    </li>
                <?php endif; ?>
            <?php endwhile; ?>
        </ol>
    </main>
    </body>
    <footer></footer>

</html>