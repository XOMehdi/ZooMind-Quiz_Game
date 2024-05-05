<?php
if (isset($_POST['btn-post'])) {
    $q1_statement = $_POST["q1-statement"];

    echo $_POST['btn-post'];

    echo $q1_statement;
}

?>

<form action="./dum.php" method="post">

    <h4 contenteditable="true" name="q1-statement" value="question1">
        Write your question statement here
    </h4>
    <input type="submit" name="btn-post" value="Post">
</form>