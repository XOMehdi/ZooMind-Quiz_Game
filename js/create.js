const orderedListQuestion = document.getElementById("ordered-list-question");
const orderedListOption = document.getElementById("ordered-list-option");

const addOptionIcons = document.getElementsByClassName("add-option-icon");
const addQuestionIcon = document.getElementById("add-question-icon");
const btnPost = document.getElementById("btn-post");

const radioOptions = document.getElementsByClassName("question-option");

Array.from(radioOptions).forEach((radioOption) => {
  radioOption.nextElementSibling.addEventListener("keyup", () => {
    radioOption.value = radioOption.nextElementSibling.innerText;
  });
});

questionNum = orderedListQuestion.childElementCount;
optionNum = orderedListOption.childElementCount;

function handleAddOptionClick(questionBoxId) {
  Array.from(addOptionIcons).forEach((addOptIcon) => {
    addOptIcon.addEventListener("click", () => {
      const questionBox = document.getElementById(questionBoxId);
      let radioInput = document.createElement("input");

      updateoptionNum();

      radioInput.setAttribute("id", "q1-opt" + optionNum);
      radioInput.setAttribute("class", "question-option");
      radioInput.setAttribute("name", "q1-option");
      radioInput.setAttribute("type", "radio");

      let labelRadioInput = document.createElement("label");
      labelRadioInput.setAttribute("contenteditable", "true");
      labelRadioInput.setAttribute("for", "q1-opt" + optionNum);
      labelRadioInput.innerText = "Write your option here";

      questionBox.insertBefore(document.createElement("br"), addOptIcon);
      questionBox.insertBefore(radioInput, addOptIcon);
      questionBox.insertBefore(labelRadioInput, addOptIcon);
    });
  });
}

/* <li>
<div id="q1-box" class="question-box">
<!-- assign name attribute dynamically -->
<input
  class="question-statement"
  type="text"
  name="q1-statement"
  value="Write your question statement here"
/>

<!-- assign id attribute dynamically -->
<!-- assign name attribute dynamically -->
<ol id="ordered-list-option">
  <li>
    <input
      id="q1-opt1"
      class="question-option"
      type="radio"
      name="q1-option"
      value=""
    />

    <!-- assign for attribute dynamically -->
    <label for="q1-opt1" contenteditable="true"
      >Write your option here</label
    >
  </li>
   */
addQuestionIcon.addEventListener("click", () => {
  let listItem = document.createElement("li");
  let questionBox = document.createElement("div");

  updateQuestionNum();
  let questionBoxId = "q" + questionNum + "-box";
  questionBox.setAttribute("id", questionBoxId);
  questionBox.setAttribute("class", "question-box");

  let questionStatement = document.createElement("input");
  questionStatement.setAttribute("class", "question-statement");
  questionStatement.setAttribute("name", "q" + questionNum + "statement");
  questionStatement.setAttribute("type", "text");
  questionStatement.value = "Write your question statement here";

  let radioInput = document.createElement("input");
  radioInput.setAttribute("id", "q" + questionNum + "-opt" + optionNum);
  radioInput.setAttribute("class", "question-option");
  radioInput.setAttribute("name", "q" + questionNum + "-option");
  radioInput.setAttribute("type", "radio");

  let labelRadioInput = document.createElement("label");
  labelRadioInput.setAttribute("contenteditable", "true");
  labelRadioInput.setAttribute("for", "q" + questionNum + "-opt" + optionNum);
  labelRadioInput.innerText = "Write your option here";

  let addOptIcon = document.createElement("span");
  addOptIcon.classList.add("add-option-icon");
  addOptIcon.innerText = "+";

  questionBox.appendChild(questionStatement);
  questionBox.appendChild(radioInput);
  questionBox.appendChild(labelRadioInput);
  questionBox.appendChild(addOptIcon);
  listItem.appendChild(questionBox);
  orderedListQuestion.appendChild(listItem);

  handleAddOptionClick(questionBoxId);
});

function updateQuestionNum() {
  questionNum = orderedListQuestion.childElementCount + 1;
}

function updateoptionNum() {
  optionNum = orderedListOption.childElementCount + 1;
}

btnPost.addEventListener("submit", (e) => {
  e.preventDefault();

  let formData = new FormData(document.getElementById("create-quiz-form"));

  fetch("./db/process_create.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "success") {
        alert("Quiz Posted Successful!");
        window.location.href = "./page/explore.php";
      } else {
        alert("Quiz Post Failed!");
        document.getElementById("sign_in-error-message").innerText = data;
      }
    })
    .catch((error) => {
      console.error(error);
    });
});
