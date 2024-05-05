const addQuestionIcon = document.getElementById("add-question-icon");
const addOptionIcon = document.getElementById("add-option-icon");

addOptionIcon.addEventListener("click", () => {
  optionList = document.getElementById("ordered-list-option");

  const newOptionListItem = document.createElement("li");
  const newOptionInput = document.createElement("input");
  newOptionInput.type = "text";
  newOptionInput.classList.add("question-option");

  newOptionInput.name = `questions[0][options][]`;
  newOptionInput.value = "Write your option here";

  newOptionListItem.appendChild(newOptionInput);
  optionList.insertBefore(newOptionListItem, addOptionIcon);
});

addQuestionIcon.addEventListener("click", function () {
  const questionList = document.getElementById("ordered-list-question");
  const questionCount = questionList.children.length;
  console.log(questionCount);

  const correctOptionInput = document.createElement("input");
  correctOptionInput.type = "number";
  correctOptionInput.name = `questions[${questionCount}][correct_option]`;
  correctOptionInput.placeholder = "Correct option number";

  const li = document.createElement("li");
  const div = document.createElement("div");
  div.classList.add("question-box");

  const questionInput = document.createElement("input");
  questionInput.type = "text";
  questionInput.classList.add("question-statement");
  questionInput.name = `questions[${questionCount}][statement]`;
  questionInput.value = "Write your question statement here";

  const optionList = document.createElement("ol");
  optionList.classList.add("ordered-list-option");

  const optionListItem = document.createElement("li");
  const optionInput = document.createElement("input");
  optionInput.type = "text";
  optionInput.classList.add("question-option");
  optionInput.name = `questions[${questionCount}][options][]`;
  optionInput.value = "Write your option here";

  optionListItem.appendChild(optionInput);
  optionList.appendChild(optionListItem);

  const addOptionButton = document.createElement("span");
  addOptionButton.classList.add("add-option-icon");
  addOptionButton.textContent = "+";
  addOptionButton.addEventListener("click", function () {
    const newOptionListItem = document.createElement("li");
    const newOptionInput = document.createElement("input");
    newOptionInput.type = "text";
    newOptionInput.classList.add("question-option");
    newOptionInput.name = `questions[${questionCount}][options][]`;
    newOptionInput.value = "Write your option here";

    newOptionListItem.appendChild(newOptionInput);
    optionList.appendChild(newOptionListItem);
    optionList.insertBefore(newOptionListItem, addOptionButton);
  });

  optionList.appendChild(addOptionButton);

  div.appendChild(questionInput);
  div.appendChild(optionList);
  div.appendChild(correctOptionInput);

  li.appendChild(div);
  questionList.appendChild(li);
  questionList.appendChild(document.createElement("br"));
});
