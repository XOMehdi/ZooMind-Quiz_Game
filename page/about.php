<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/about.css" />
    <!-- <script src="../js/about.js" defer></script> -->
    <title>ZooMind - About</title>
    <?php include_once('../include/sidebar.php'); ?>

    <header>
    </header>
    <section class="about">
        <div class="main">
            <img id="site-logo" src="../img/site_logo.png">
            <div class="about-text">
                <h1>About Us</h1>
                <h5>ZooMind <span id="text-2">Founders</span> </h5>
                <h5>Mohammad Mehdi <span>&</span> Abdullah Khan</h5>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni quis illo ullam mollitia voluptatem,
                    repellat praesentium odio totam eveniet distinctio asperiores possimus consequatur ut officia quo
                    fugiat, debitis voluptate officiis?</p>
                <button type="button" id="btn">Contact us</button>
            </div>
        </div>
    </section>
    </body>

</html>