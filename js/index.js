const mainBox = document.getElementById("main-box");
const inputFields = document.querySelectorAll(
  'input[type="text"], input[type="password"]'
);
const signUpForm = document.getElementById("sign_up-form");
const signUpBox = document.getElementById("sign_up-box");
const usernameInput = document.getElementById("username");
const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("confirm_password");
const passwordStrength = document.getElementById("password-strength");
const errorMessage = document.getElementById("error-message");
const signInBox = document.getElementById("sign_in-box");
const signInUsernameInput = document.getElementById("sign_in-username");
const forwardIconUsername = document.getElementById("forward-icon-username");
const signInPasswordInput = document.getElementById("sign_in-password");
const forwardIconPassword = document.getElementById("forward-icon-password");
const signInerrorMessage = document.getElementById("sign_in-error-message");

inputFields.forEach((inputField) => {
  inputField.addEventListener("keyup", () => {
    if (inputField.value.length > 0) {
      inputField.classList.add("has-text");
    } else {
      inputField.classList.remove("has-text");
    }
  });
});

document.getElementById("show-sign_in-link").onclick = () => {
  signInBox.style.display = "flex";
  mainBox.style.display = "none";
};

document.getElementById("btn-cancel").onclick = () => {
  signUpBox.style.display = "none";
  mainBox.style.display = "flex";
};

document.getElementById("show-sign_up-link").onclick = () => {
  signUpBox.style.display = "flex";
  mainBox.style.display = "none";
};

function animateFormUp() {
  signUpBox.style.display = "none";
  signInBox.style.display = "flex";
}

function animateFormDown() {
  signInBox.style.display = "none";
  signUpBox.style.display = "flex";
}

document
  .getElementById("sign_in-link")
  .addEventListener("click", animateFormUp);
document
  .getElementById("sign_up-link")
  .addEventListener("click", animateFormDown);

signUpForm.addEventListener("submit", signUp);

signInUsernameInput.addEventListener("keypress", showSignInPasswordInput);
forwardIconUsername.addEventListener("click", showSignInPasswordInput);

signInPasswordInput.addEventListener("keypress", signIn);
forwardIconPassword.addEventListener("click", signIn);

function showSignInPasswordInput(e) {
  if (e.key === "Enter" || e.type === "click") {
    e.preventDefault();

    signInPasswordInput.focus();

    signInUsernameInput.style.borderRadius = "15px 15px 0 0";
    const inputBoxPassword = document.getElementById("input-box-password");
    inputBoxPassword.style.height = "55px";

    forwardIconUsername.style.display = "none";
    forwardIconPassword.style.display = "block";
  }
}

usernameInput.addEventListener("input", isValidUsername);
passwordInput.addEventListener("input", isValidPassword);
confirmPasswordInput.addEventListener("input", isValidPassword);

if (signInPasswordInput.value.length > 0) {
  signInPasswordInput.classList.add("has-text");
}

function signUp(e) {
  e.preventDefault();

  if (isValidUsername(username) && isValidPassword(password)) {
    let formData = new FormData(signUpForm);

    fetch("./db/process_sign_up_sign_in.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data === "success") {
          alert("Account Created Successfully!");
          window.location.href = "./page/explore.php";
        } else {
          alert("Account Creation Failed!");
          errorMessage.innerText = data;
        }
      })
      .catch((error) => {
        console.error(error);
      });
  } else {
    alert("Account Creation Failed!");
  }
}

function signIn(e) {
  if (!signInUsernameInput.value || !signInPasswordInput.value) {
    signInerrorMessage.innerText = "Please provide a username and a password";
    return;
  }

  if (e.key === "Enter" || e.type === "click") {
    e.preventDefault();

    let formData = new FormData(document.getElementById("sign_in-form"));

    fetch("./db/process_sign_up_sign_in.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data === "success") {
          alert("Sign in Successful!");
          signInerrorMessage.innerText = "";
          window.location.href = "./page/explore.php";
        } else {
          alert("Sign in Failed!");
          signInerrorMessage.innerText = data;
        }
      })
      .catch((error) => {
        console.error(error);
      });
  }
}

function isValidUsername() {
  const username = usernameInput.value;
  let hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(username);

  if (hasSpecialChar) {
    errorMessage.innerText = "Username cannot have any special characters.";
    return false;
  }

  errorMessage.innerText = "";
  return true;
}

function isValidPassword() {
  const password = passwordInput.value;
  const confirmPassword = confirmPasswordInput.value;
  let hasLowercase = /[a-z]/.test(password);
  let hasUppercase = /[A-Z]/.test(password);
  let hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
  let hasNumeric = /\d/.test(password);
  let hasLength = password.length >= 8 && password.length <= 16;

  passwordStrength.innerText = "";

  if (
    !hasLowercase ||
    !hasUppercase ||
    !hasSpecialChar ||
    !hasNumeric ||
    !hasLength
  ) {
    errorMessage.innerText =
      "Password must have at least one small letter, one capital letter, one special character, one numeric character, and be 8 to 16 characters long.";
    return false;
  }

  if (confirmPassword && password != confirmPassword) {
    errorMessage.innerText = "Passwords do not match";
    return false;
  }

  errorMessage.innerText = "";

  let strength = "";
  if (password.length == 8 || password.length == 9) {
    strength = "Weak";
  } else if (password.length >= 10 && password.length <= 12) {
    strength = "Medium";
  } else {
    strength = "Hard";
  }

  passwordStrength.innerText = "Password strength: " + strength;
  return true;
}
