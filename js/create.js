const orderedListQues = document.getElementById("ordered-list-question");

const addOptIcons = document.getElementsByClassName("add-opt-icon");
const addQuesIcon = document.getElementById("add-ques-icon");
const btnPost = document.getElementById("btn-post");

const radioOptions = document.getElementsByClassName("radio-option");

Array.from(radioOptions).forEach((radioOption) => {
  radioOption.nextElementSibling.addEventListener("keyup", () => {
    radioOption.value = radioOption.nextElementSibling.innerText;
  });
});

optNum = 2;

function handleAddOptionClick(questionBoxId) {
  Array.from(addOptIcons).forEach((addOptIcon) => {
    addOptIcon.addEventListener("click", () => {
      const questionBox = document.getElementById(questionBoxId);
      let radioInput = document.createElement("input");
      radioInput.setAttribute("id", "q1-opt" + optNum);
      radioInput.setAttribute("class", "radio-option");
      radioInput.setAttribute("name", "q1-option");
      radioInput.setAttribute("type", "radio");

      let labelRadioInput = document.createElement("label");
      labelRadioInput.setAttribute("contenteditable", "true");
      labelRadioInput.setAttribute("for", "q1-opt" + optNum);
      labelRadioInput.innerText = "Write your option here";

      optNum += 1;
      questionBox.insertBefore(document.createElement("br"), addOptIcon);
      questionBox.insertBefore(radioInput, addOptIcon);
      questionBox.insertBefore(labelRadioInput, addOptIcon);
    });
  });
}

handleAddOptionClick("q1-box");

questionNum = 2;
addQuesIcon.addEventListener("click", () => {
  let listItem = document.createElement("li");
  let questionBox = document.createElement("div");

  let questionBoxId = "q" + questionNum + "-box";
  questionBox.setAttribute("id", questionBoxId);
  questionBox.setAttribute("class", "question-box");

  let questionStatement = document.createElement("h4");
  questionStatement.setAttribute("contenteditable", "true");
  questionStatement.innerText = "Write your question statement here";

  let radioInput = document.createElement("input");
  radioInput.setAttribute("id", "q" + questionNum + "-opt1");
  radioInput.setAttribute("name", "q" + questionNum + "-opt1");
  radioInput.setAttribute("type", "radio");

  let labelRadioInput = document.createElement("label");
  labelRadioInput.setAttribute("contenteditable", "true");
  labelRadioInput.setAttribute("for", "q" + questionNum + "-opt1");
  labelRadioInput.innerText = "Write your option here";

  let addOptIcon = document.createElement("span");
  addOptIcon.classList.add("add-opt-icon");
  addOptIcon.innerText = "+";

  questionBox.appendChild(questionStatement);
  questionBox.appendChild(radioInput);
  questionBox.appendChild(labelRadioInput);
  questionBox.appendChild(addOptIcon);
  listItem.appendChild(questionBox);
  orderedListQues.appendChild(listItem);

  handleAddOptionClick(questionBoxId);

  questionNum += 1;
});

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
