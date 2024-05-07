const btnEdit = document.getElementById("btn-edit");
const editableInputs = document.getElementsByClassName("editable-input");

btnEdit.addEventListener("click", () => {
  Array.from(editableInputs).forEach((editableInput) => {
    editableInput.removeAttribute("readonly");

    if (editableInput.id == "password") {
      editableInput.type = "text";
      editableInput.id = "password-show";
    } else if (editableInput.id == "password-show") {
      editableInput.type = "password";
      editableInput.id = "password";
    }
  });
});
