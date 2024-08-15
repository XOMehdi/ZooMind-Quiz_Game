<?php
include('../secure.php');
?>

<?php include_once('../include/header.php'); ?>
<?php include_once('../include/sidebar.php'); ?>
    <main>
        <div id="outer-quiz-box">
            <form id="create-quiz-form" action="../db/process_create.php" method="post">
                <div id="quiz-box">
                    <input id="create-title" class="mouse-effect" type="text" placeholder="Quiz Title" name="title" />
                    <textarea id="create-description" class="mouse-effect" placeholder="Description" name="description"></textarea>
                    <input id="category" class="mouse-effect" type="text" name="category"
                        placeholder="Category: Cat / Dog / Bird / Fish etc" />
                    <select id="difficulty" class="mouse-effect" name="difficulty">
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
                            <input id="question" 
                                class="question-statement mouse-effect" type="text" name="questions[0][statement]"
                                placeholder="Write your question statement here" />
                            <ol id="ordered-list-option" class="ordered-list-option">
                                <li>
                                    <input id="option" class="question-option mouse-effect"
                                        type="text" name="questions[0][options][]"
                                        placeholder="Write your option here" />
                                    <span id="add-option-icon-box"><i
                                            class='add-option-icon bx bx-plus-circle'></i></span>
                                </li>
                            </ol>
                            <input class="correct-option mouse-effect" type="number"
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
<?php include_once('../include/footer.php'); ?>
