const mainBox = document.getElementById("main-box");
const signUpForm = document.getElementById("sign_up-form");
const showSignUpLink = document.getElementById("show-sign_up-link");
const showSignInLink = document.getElementById("show-sign_in-link");
const signInLink = document.getElementById("sign_in-link");
const signUpLink = document.getElementById("sign_up-link");
const signUpBox = document.getElementById("sign_up-box");
const signInBox = document.getElementById("sign_in-box");
const usernameInput = document.getElementById("username");
const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("confirm_password");
const signInUsernameInput = document.getElementById("sign_in-username");
const signInPasswordInput = document.getElementById("sign_in-password");
const errorMessage = document.getElementById("error-message");
const signInerrorMessage = document.getElementById("sign_in-error-message");
const passwordStrength = document.getElementById("password-strength");
const btnCancel = document.getElementById("btn-cancel");
const btnSignUp = document.getElementById("btn-sign_up");
const inputFields = document.querySelectorAll(
  'input[type="text"], input[type="password"]'
);
const forwardIcon = document.getElementById("forward-icon");


showSignUpLink.onclick = () => {
  signUpBox.style.display = "flex";
  mainBox.style.display = "none";
};

showSignInLink.onclick = () => {
  signInBox.style.display = "flex";
  mainBox.style.display = "none";
};

Array.from(inputFields).forEach((inputField) => {
  inputField.addEventListener("keyup", () => {
    if (inputField.value.length > 0) {
      inputField.classList.add("has-text");
    } else {
      inputField.classList.remove("has-text");
    }
  });
});

btnCancel.onclick = () => {
  signUpBox.style.display = "none";
  mainBox.style.display = "flex";
};

signUpForm.addEventListener("submit", signUp);

signInUsernameInput.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    e.preventDefault();

    signInPasswordInput.focus();

    signInUsernameInput.style.borderRadius = "15px 15px 0 0";
    const inputBoxPassword = document.getElementById("input-box-password");
    inputBoxPassword.style.height = "55px";

    forwardIcon.style.bottom = "14px";
    forwardIcon.style.right = "85px";
  }
});

signInPasswordInput.addEventListener("keypress", signIn);
forwardIcon.addEventListener("click", signIn);

usernameInput.addEventListener("input", isValidUsername);
passwordInput.addEventListener("input", isValidPassword);
confirmPasswordInput.addEventListener("input", isValidPassword);

signInLink.addEventListener("click", animateFormUp);
signUpLink.addEventListener("click", animateFormDown);

if (signInPasswordInput.value.length > 0) {
  signInPasswordInput.classList.add("has-text");
}

function animateFormUp() {
  signUpBox.style.display = "none";
  signInBox.style.display = "flex";
}

function animateFormDown() {
  signInBox.style.display = "none";
  signUpBox.style.display = "flex";
}

function signUp(e) {
  errorMessage.innerText = "";
  passwordStrength.innerText = "";

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
  signInerrorMessage.innerText = "";

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
          window.location.href = "./page/explore.php";
        } else {
          alert("Sign in Failed!");
          document.getElementById("sign_in-error-message").innerText = data;
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

  errorMessage.innerText = "";
  passwordStrength.innerText = "";

  if (hasSpecialChar) {
    errorMessage.innerText = "Username cannot have any special characters.";
    return false;
  }

  return true;
}

function isValidPassword() {
  const password = passwordInput.value;
  const confirmPassword = confirmPasswordInput.value;
  var hasLowercase = /[a-z]/.test(password);
  var hasUppercase = /[A-Z]/.test(password);
  var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
  var hasNumeric = /\d/.test(password);
  var hasLength = password.length >= 8 && password.length <= 16;

  errorMessage.innerText = "";
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
    passwordStrength.innerText = "";
    return false;
  }

  if (password != confirmPassword) {
    errorMessage.innerText = "Passwords do not match";
    return false;
  }

  let strength = "";
  if (password.length >= 8 && password.length <= 9) {
    strength = "Weak";
  } else if (password.length >= 10 && password.length <= 12) {
    strength = "Medium";
  } else {
    strength = "Hard";
  }

  errorMessage.innerText = "";
  passwordStrength.innerText = "Password strength: " + strength;
  return true;
}
