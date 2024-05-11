const heartIconImg = document.getElementById("heart-icon");
const isFavouriteInput = document.getElementById("is-favourite");

if (isFavouriteInput.value == "1") {
  heartIconImg.src = "../img/heart_filled_icon.png";
  heartIconImg.alt = "heart filled icon";
} else {
  heartIconImg.src = "../img/heart_icon.png";
  heartIconImg.alt = "heart icon";
}

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
