<?php
include('./secure.php');
session_start();
session_unset();
session_destroy();
setcookie('is_attempt_correct', '', time() - 3600, '/');
unset($_COOKIE['is_attempt_correct']);
header("Location: ./index.html");
exit();
