<?php
session_start();
?>

<?php include_once('../include/header.php'); ?>
<?php include_once('../include/sidebar.php'); ?>
    <main id="about-box">
        <img id="site-logo" src="../img/site_logo.png">
        <div id="text-box">
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
<?php include_once('../include/footer.php'); ?>