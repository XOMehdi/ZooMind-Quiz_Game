<?php

include_once('../db/connection.php');
session_start();

$user_state = (isset($_SESSION['username'])) ? "signed_in" : "signed_out";

$sort_by = "count_favourite";
$sort_direction = "DESC";

if (isset($_GET['sort-by'])) {

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

<?php include_once('../include/header.php'); ?>
        <nav id="nav" class="header">
            <div id="search-box">
                <input id="search" type="search" placeholder="Search" />
                <i id="search-icon" class='bx bx-search'></i>
            </div>
            <form id="sort-by-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                <select id="sort-by" name="sort-by">
                    <option value="" selected disabled hidden>Sort by</option>
                    <option value="popularity">Popularity</option>
                    <option value="difficulty">Difficulty</option>
                    <option value="latest">Latest</option>
                    <option value="oldest">Oldest</option>
                </select>
            </form>
        </nav>

<?php include_once('../include/sidebar.php'); ?>
    
    <main>
        <form action="./play.php" method="get">
            <div id="quiz-list">
                <?php while ($row = $quiz_table->fetch(PDO::FETCH_OBJ)) : ?>
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
                                <span><i class='heart-icon bx bx-heart'></i> <b><?= $row->count_favourite ?></b></span>
                                <input class="is-favourite" type="hidden" name="is-favourite" value="0">
                            </li>
                        </ul>
                        <a class="play-link" href="./play.php?quiz-number=<?= $row->number ?>&is-favourite=0">Play</a>
                    </div>
                <?php endwhile; ?>
            </div>
        </form>
    </main>
<?php include_once('../include/footer.php'); ?>
