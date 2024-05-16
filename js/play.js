const heartIcon = document.getElementById("heart-icon");
const isFavouriteInput = document.getElementById("is-favourite");

heartIcon.onclick = () => {
  if (isFavouriteInput.value == "0") {
    heartIcon.classList.add("bxs-heart");
    heartIcon.classList.remove("bx-heart");
    isFavouriteInput.value = "1";
  } else {
    heartIcon.classList.add("bx-heart");
    heartIcon.classList.remove("bxs-heart");
    isFavouriteInput.value = "0";
  }
};
