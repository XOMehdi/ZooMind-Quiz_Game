const searchInput = document.getElementById("search");
const sortBySelect = document.getElementById("sort-by");
const sortByForm = document.getElementById("sort-by-form");
const quizList = document.getElementById("quiz-list");
const heartIcons = document.getElementsByClassName("heart-icon");

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

for (let heartIcon of heartIcons) {
  heartIcon.onclick = () => {
    const isFavouriteInput = heartIcon.parentElement.nextElementSibling;
    const countFavourite = heartIcon.nextElementSibling;
    const playLink =
      heartIcon.parentElement.parentElement.parentElement.nextElementSibling;
    if (isFavouriteInput.value == "0") {
      heartIcon.classList.add("bxs-heart");
      heartIcon.classList.remove("bx-heart");
      isFavouriteInput.value = "1";
      countFavourite.innerText = Number(countFavourite.innerText) + 1;
    } else {
      heartIcon.classList.add("bx-heart");
      heartIcon.classList.remove("bxs-heart");
      isFavouriteInput.value = "0";
      countFavourite.innerText = Number(countFavourite.innerText) - 1;
    }

    const regex = /quiz-number=(\d+)/;
    const match = regex.exec(playLink.href);
    const quizNumber = match ? match[1] : "-1";

    playLink.href = `./play.php?quiz-number=${quizNumber}&is-favourite=${isFavouriteInput.value}`;
  };
}
