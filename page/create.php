<?php
include('../secure.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/page.css" />
    <script src="../js/create.js" defer></script>
    <title>ZooMind - Create Quiz</title>
    <?php include_once('../include/sidebar.php'); ?>

    <header>
        <h1>Create Quiz</h1>
    </header>
    <main>
        <div id="outer-quiz-box">
            <form id="create-quiz-form" action="../db/process_create.php" method="post">
                <div id="quiz-box">
                    <input id="create-title" type="text" placeholder="Quiz Title" name="title" onmouseenter="myMouse()"
                        onmouseleave="mouse()" />
                    <!-- <textarea id="title" placeholder="Quiz Title" name="title" onmouseenter="myMouse()" onmouseleave="mouse()"></textarea>
                 -->
                    <textarea id="create-description" placeholder="Description" name="description" onmouseenter="des()"
                        onmouseleave="cription()"></textarea>
                    <input onmouseenter="cate()" onmouseleave="gory()" id="category" type="text" name="category"
                        placeholder="Category: Cat / Dog / Bird / Fish etc" />
                    <select onmouseenter="diff()" onmouseleave="ficulty()" id="difficulty" name="difficulty">
                        <option value="1" selected disabled hidden>Difficulty</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <ol id="ordered-list-question">
                    <div class="question-box">
                        <li>
                            <input id="question" onmouseenter="question()" onmouseleave="box()"
                                class="question-statement" type="text" name="questions[0][statement]"
                                placeholder="Write your question statement here" />
                            <!-- <textarea id="question" class="question-statement" name="questions[0][statement]" placeholder="Write your question statement here" onmouseenter="question()" onmouseleave="box()"></textarea> -->

                            <ol id="ordered-list-option" class="ordered-list-option">
                                <li>
                                    <input onmouseenter="option()" onmouseleave="boxes()" class="question-option"
                                        type="text" name="questions[0][options][]" id="option"
                                        placeholder="Write your option here" />
                                    <span id="add-option-icon-box"><i
                                            class='add-option-icon bx bx-plus-circle'></i></span>
                                </li>
                            </ol>
                            <input class="correct-option" onmouseenter="number()" onmouseleave="select()" type="number"
                                name="questions[0][correct_option]" placeholder="Correct option number">
                        </li>
                    </div>
                </ol>

                <div id="create-btn-box">
                    <span><i id="add-question-icon" class='bx bx-plus-circle'></i></span>
                    <input class="btn" type="submit" name="btn-post" value="Post" />
                </div>
            </form>
        </div>
    </main>
    <footer></footer>
    </body>

</html>