const btnEdit = document.getElementById("btn-edit");
const editableInputs = document.getElementsByClassName("editable-input");

btnEdit.addEventListener("click", () => {
  Array.from(editableInputs).forEach((editableInput) => {
    editableInput.removeAttribute("readonly");
  });
});
