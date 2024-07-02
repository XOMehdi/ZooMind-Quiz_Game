<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <!-- <script src="../js/about.js" defer></script> -->
    <title>ZooMind - About</title>
    <?php include_once('../include/sidebar.php'); ?>

    <header>
    </header>
    <main id="about-box">
        <img id="site-logo" src="../img/site_logo.png">
        <div id="text-box">
            <h1>About</h1>
            <h5>ZooMind <span style="color: #FFC000">Founders</span> </h5>
            <h5>Mohammad Mehdi <span>&</span> Abdullah Khan</h5>
            <p>ZooMind is an interactive and educational web application that allows users to test their
                knowledge about animals. The game presents a series of animals-related multiple choice
                questions, ranging from animal breeds to interesting animal facts. Users can select
                answers, receive feedback on their performance, and view their final score at the end of
                the quiz.
                The project aims to entertain users while educating them about various aspects of
                animals.
            </p>
            <input type="button" id="btn" value="Contact Us">
        </div>
    </main>
    <footer></footer>
    </body>

</html>