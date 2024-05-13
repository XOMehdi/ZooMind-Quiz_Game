const heartIconImg = document.getElementById("heart-icon");
const isFavouriteInput = document.getElementById("is-favourite");

heartIconImg.onclick = () => {
  if (isFavouriteInput.value == "0") {
    heartIconImg.src = "../img/heart_filled_icon.png";
    heartIconImg.alt = "heart filled icon";

    isFavouriteInput.value = "1";
  } else {
    heartIconImg.src = "../img/heart_icon.png";
    heartIconImg.alt = "heart icon";
    isFavouriteInput.value = "0";
  }
};
