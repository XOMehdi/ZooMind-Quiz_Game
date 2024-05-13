const addQuestionIcon = document.getElementById("add-question-icon");
const addOptionIconBox = document.getElementById("add-option-icon-box");

addOptionIconBox.addEventListener("click", () => {
  optionList = document.getElementById("ordered-list-option");

  const newOptionListItem = document.createElement("li");
  const newOptionInput = document.createElement("input");
  newOptionInput.type = "text";
  newOptionInput.classList.add("question-option");

  newOptionInput.name = `questions[0][options][]`;
  newOptionInput.placeholder = "Write your option here";

  newOptionListItem.classList.add("question-options-li");
  newOptionListItem.appendChild(newOptionInput);
  newOptionListItem.appendChild(addOptionIconBox);
  optionList.appendChild(newOptionListItem);
});

addQuestionIcon.addEventListener("click", function () {
  const questionList = document.getElementById("ordered-list-question");
  const questionCount = questionList.children.length;
  console.log(questionCount);

  const correctOptionInput = document.createElement("input");
  correctOptionInput.type = "number";
  correctOptionInput.classList.add("correct-option");
  correctOptionInput.name = `questions[${questionCount}][correct_option]`;
  correctOptionInput.placeholder = "Correct option number";

  const li = document.createElement("li");
  const div = document.createElement("div");
  div.classList.add("question-box");

  const questionInput = document.createElement("input");
  questionInput.type = "text";
  questionInput.classList.add("question-statement");
  questionInput.name = `questions[${questionCount}][statement]`;
  questionInput.placeholder = "Write your question statement here";

  const optionList = document.createElement("ol");
  optionList.classList.add("ordered-list-option");

  const optionListItem = document.createElement("li");

  const optionInput = document.createElement("input");
  optionInput.type = "text";
  optionInput.classList.add("question-option");
  optionInput.name = `questions[${questionCount}][options][]`;
  optionInput.placeholder = "Write your option here";

  const addOptionIcon = document.createElement("i");
  addOptionIcon.classList.add("add-option-icon");
  addOptionIcon.classList.add("bx");
  addOptionIcon.classList.add("bx-plus-circle");

  const addOptionIconSpan = document.createElement("span");
  addOptionIconSpan.appendChild(addOptionIcon);

  optionListItem.appendChild(optionInput);
  optionListItem.appendChild(addOptionIconSpan);
  optionList.appendChild(optionListItem);

  addOptionIconSpan.addEventListener("click", function () {
    const newOptionListItem = document.createElement("li");
    newOptionListItem.classList.add("question-options-li");

    const newOptionInput = document.createElement("input");
    newOptionInput.type = "text";
    newOptionInput.classList.add("question-option");
    newOptionInput.name = `questions[${questionCount}][options][]`;
    newOptionInput.placeholder = "Write your option here";

    newOptionListItem.appendChild(newOptionInput);
    newOptionListItem.appendChild(addOptionIconSpan);
    optionList.appendChild(newOptionListItem);
  });

  div.appendChild(questionInput);
  div.appendChild(optionList);
  div.appendChild(correctOptionInput);

  li.appendChild(div);
  questionList.appendChild(li);
});

// css effects
function myMouse() {
  const x = document.getElementById("title");
  x.style.borderBottom = "2px solid yellow";
}

function mouse() {
  const x = document.getElementById("title");
  x.style.borderBottom = "none";
}
//------//
function des() {
  const x = document.getElementById("description");
  x.style.borderBottom = "2px solid yellow";
}

function cription() {
  const x = document.getElementById("description");
  x.style.borderBottom = "none";
}
//-----//
function cate() {
  const x = document.getElementById("category");
  x.style.borderBottom = "2px solid yellow";
}

function gory() {
  const x = document.getElementById("category");
  x.style.borderBottom = "none";
}
//------//
function diff() {
  const x = document.getElementById("difficulty");
  x.style.borderBottom = "2px solid yellow";
}

function ficulty() {
  const x = document.getElementById("difficulty");
  x.style.borderBottom = "none";
}
//-----//
function question() {
  const x = document.getElementById("question");
  x.style.borderBottom = "2px solid yellow";
}

function box() {
  const x = document.getElementById("question");
  x.style.borderBottom = "none";
}
//-----//
function option() {
  const x = document.getElementById("option");
  x.style.borderBottom = "2px solid yellow";
}

function boxes() {
  const x = document.getElementById("option");
  x.style.borderBottom = "none";
}
//----//
