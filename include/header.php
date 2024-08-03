<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/page.css" />
    <!-- <script src="../js/about.js" defer></script> -->

    <?php
    $filename = basename($_SERVER['PHP_SELF'], '.php');
    $scriptPath = "../js/{$filename}.js";
    ?>
    <script src="<?= $scriptPath ?>" defer></script>
    <title>ZooMind - About</title>
    <?php include_once('./sidebar.php'); ?>
</head>
<body>
<header>
</header>
