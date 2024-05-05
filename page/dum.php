<?php
if (isset($_POST['btn-post'])) {
    $q1_statement = $_POST["q1-statement"];

    echo $q1_statement;
}

?>

<form action="./dum.php" method="post">

    <textarea name="q1-statement">
        Write your question statement here
    </textarea>
    <input type="submit" name="btn-post" value="Post">
</form>