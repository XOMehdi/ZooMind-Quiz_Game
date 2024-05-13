const heartIcon = document.getElementById("heart-icon");
const isFavouriteInput = document.getElementById("is-favourite");

heartIcon.onclick = () => {
  if (isFavouriteInput.value == "0") {
    heartIcon.classList.add('filled-heart');
    isFavouriteInput.value = "1";
  } else {
    heartIcon.classList.remove('filled-heart');
    isFavouriteInput.value = "0";
  }
};
