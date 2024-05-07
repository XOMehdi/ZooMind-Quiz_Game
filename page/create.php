<?php
include('../secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="../css/create.css" />
  <script src="../js/create.js" defer></script>
  <title>ZooMind - Create Quiz</title>
</head>

<body>
  <header></header>
  <main>
    <form id="create-quiz-form" action="../db/process_create.php" method="post">
      <h1>Create Quiz</h1>

      <label for="title">Title</label>
      <input id="title" type="text" name="title" />

      <label for="description">Description</label>
      <textarea id="description" name="description"></textarea>

      <label for="category">Category</label>
      <input id="category" type="text" name="category" placeholder="Cat / Dog / Bird / Fish etc" />
      <label for="difficulty">Difficulty</label>
      <select id="difficulty" name="difficulty">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <ol id="ordered-list-question">
        <li>
          <div class="question-box">
            <input class="question-statement" type="text" name="questions[0][statement]" value="Write your question statement here" />
            <ol id="ordered-list-option" class="ordered-list-option">
              <li>
                <input class="question-option" type="text" name="questions[0][options][]" value="Write your option here" />
              </li>
              <span id="add-option-icon" class="add-option-icon">+</span>
            </ol>
            <input type="number" name="questions[0][correct_option]" placeholder="Correct option number">
          </div>
        </li>
        <br>
      </ol>

      <img id="add-question-icon" src="../img/add_icon.png" alt="add new question image icon" />
      <input id="btn-post" type="submit" name="btn-post" value="Post" />
    </form>
  </main>
  <footer></footer>
</body>

</html>