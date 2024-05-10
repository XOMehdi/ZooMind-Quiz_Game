<?php

include_once('../db/connection.php');
session_start();

$user_state = (isset($_SESSION['username'])) ? "signed_in" : "signed_out";

$sort_by = "count_favourite";
$sort_direction = "DESC";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $sort_by = $_GET['sort-by'];

    switch ($sort_by) {
        case 'popularity':
            $sort_by = "count_favourite";
            break;
        case 'difficulty':
            $sort_by = "difficulty";
            break;
        case 'latest':
            $sort_by = "upload_on";
            break;
        case 'oldest':
            $sort_by = "upload_on";
            $sort_direction = "ASC";
            break;
        default:
            $sort_by = "count_favourite";
            break;
    }
}

$sql = "SELECT * FROM quiz ORDER BY $sort_by $sort_direction";
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

                <?php if ($user_state === "signed_in") {
                    echo "<li><a href='../sign_out.php'>Sign out</a></li>";
                } else {
                    echo "<li><a href='../index.html'>Sign up / Sign in</a></li>";
                } ?>

            </ul>
        </nav>
    </header>
    <main>
        <h1>Explore</h1>
        <form id="sort-by-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
            <select id="sort-by" name="sort-by">
                <option value="" selected disabled hidden>Sort by</option>
                <option value="popularity">Popularity</option>
                <option value="difficulty">Difficulty</option>
                <option value="latest">Latest</option>
                <option value="oldest">Oldest</option>
            </select>
        </form>
        <ol id="quiz-list">
            <form action="./play.php" method="get">
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
                            <img id="heart-icon" src="../img/heart_icon.png" alt="heart icon">
                            <small> <?= $row->count_favourite ?></small>

                            <input id="is-favourite" type="hidden" name="is-favourite" value="0">
                            <a class="play-link" href="./play.php?quiz-number=<?= $row->number ?>&is-favourite=0">Play</a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </form>
        </ol>
    </main>
    <footer></footer>
</body>

</html>