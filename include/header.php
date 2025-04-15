<?php
$filename = basename($_SERVER['PHP_SELF'], '.php');
// $css_path = ($filename === "");
$script_path = "../js/{$filename}.js";
$page_title = ucwords($filename);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="../img/site_logo.ico">
    <link rel="stylesheet" type="text/css" href="../css/page.css" />
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <script src="<?= $script_path ?>" defer></script>
    <title> ZooMind - <?= $page_title ?></title>
</head>

<body>
    <header>
        <h1><?= $page_title ?></h1>
    </header>