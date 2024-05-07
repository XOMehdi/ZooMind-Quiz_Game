<?php

// include('../secure.php');
include_once('../db/connection.php');
session_start();

// $username = $_SESSION['username']

$sql = "SELECT * FROM quiz";

$quiz_table = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/explore.css" />
    <script src="../js/explore.js" defer></script>
    <title>ZooMind - Explore</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.html">Home</a></li>
                <li><a href="./create.php">Create</a></li>
                <li>
                    <input id="search" type="search" placeholder="Search" />
                    Search
                </li>
                <li><a href="./profile.php">Profile</a></li>

                <!-- change text according to user log in state -->
                <li><a href="../sign_out.php">Sign out</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Explore</h1>

        <label for="sort-by">Sort by</label>
        <select id="sort-by" name="sort-by">
            <option value="popularity">Popularity</option>
            <option value="difficulty">Difficulty</option>
            <option value="latest">Latest</option>
            <option value="oldest">Oldest</option>
        </select>
        <ol>
            <?php while ($row = $quiz_table->fetch(PDO::FETCH_OBJ)) : ?>
            <li>
                <div class="quiz-card">
                    <h3><?= $row->title ?></h3>
                    <small>Category: <?= $row->category ?></small>
                    <small>Difficulty: <?= $row->difficulty ?></small>
                    <p><?= $row->description ?></p>
                    <small>Pass/Fail: <?= $row->count_passed . "/" . $row->count_attempt - $row->count_passed ?></small>
                    <small>High Score: <?= $row->high_score ?></small>
                    <small>Uploaded By: <?= $row->upload_by ?></small>
                    <small>Uploaded On: <?= $row->upload_on ?></small>
                    <img class="heart-icon" src="../img/heart_icon.png" alt="heart icon">

                    <form action="./play.php" method="get">
                        <a class="play-link" href="./play.php?quiz-number=<?= $row->number ?>">Play</a>
                    </form>
                </div>
            </li>
            <?php endwhile; ?>
        </ol>
    </main>
    <footer></footer>
</body>

</html>