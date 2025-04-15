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

  const questionBox = document.createElement("div");
  questionBox.classList.add("question-box");

  const correctOptionInput = document.createElement("input");
  correctOptionInput.type = "number";
  correctOptionInput.classList.add("correct-option");
  correctOptionInput.name = `questions[${questionCount}][correct_option]`;
  correctOptionInput.placeholder = "Correct option number";

  const li = document.createElement("li");

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
  
  li.appendChild(questionInput);
  li.appendChild(optionList);
  li.appendChild(correctOptionInput);
  
  questionBox.appendChild(li);
  questionList.appendChild(questionBox);
});

// css effects
const inputFields = document.querySelectorAll(".mouse-effect");
inputFields.forEach((inputField) => {
  inputField.onmouseenter = () => {
    inputField.style.borderBottom = "2px solid yellow";
  };
  
  inputField.onmouseleave = () => {
    inputField.style.borderBottom = "none";
  };
});