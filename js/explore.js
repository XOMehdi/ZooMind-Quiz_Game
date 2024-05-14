const searchInput = document.getElementById("search");
const sortBySelect = document.getElementById("sort-by");
const sortByForm = document.getElementById("sort-by-form");
const quizList = document.getElementById("quiz-list");
const heartIconImg = document.getElementById("heart-icon");
const isFavouriteInput = document.getElementById("is-favourite");
// const playLink = document.querySelectorAll(".play-link");

document.addEventListener("DOMContentLoaded", () => {
  searchInput.addEventListener("input", () => {
    const keyword = searchInput.value.toLowerCase();
    filterQuizzes(keyword);
  });

  function filterQuizzes(keyword) {
    const quizzes = document.querySelectorAll(".quiz-card");

    quizzes.forEach((quiz) => {
      const quizText = quiz.innerText.toLowerCase();
      if (quizText.includes(keyword)) {
        quiz.style.display = "block";
      } else {
        quiz.style.display = "none";
      }
    });
  }
});

sortBySelect.addEventListener("change", () => {
  sortByForm.submit();
});

// heartIconImg.onclick = () => {
//   if (isFavouriteInput.value === "0") {
//     heartIconImg.src = "../img/heart_filled_icon.png";
//     heartIconImg.alt = "heart filled icon";
//     isFavouriteInput.value = "1";
//   } else {
//     heartIconImg.src = "../img/heart_icon.png";
//     heartIconImg.alt = "heart icon";
//     isFavouriteInput.value = "0";
//   }

//   playLink.href = `./play.php?quiz-number=<?= $row->number ?>&is-favourite=${isFavouriteInput.value}`;
// };
