const input = document.querySelector("#pwd input");
const eye = document.querySelector("#pwd .fa-eye-slash");

eye.addEventListener("click", () => {
  if(input.type === "password") {
    input.type = "text";

    eye.classList.remove("fa-eye-slash");
    eye.classList.add("fa-eye");
  } else {
    input.type = "password";

    eye.classList.remove("fa-eye");
    eye.classList.add("fa-eye-slash");
  }
});

const input2 = document.querySelector("#pwd2 input");
const eye2 = document.querySelector("#pwd2 .fa-eye-slash");

eye2.addEventListener("click", () => {
    if (input2.type === "password") {
        input2.type = "text";

        eye2.classList.remove("fa-eye-slash");
        eye2.classList.add("fa-eye");
    } else {
        input2.type = "password";

        eye2.classList.remove("fa-eye");
        eye2.classList.add("fa-eye-slash");
    }
});

const input3 = document.querySelector("#pwd3 input");
const eye3 = document.querySelector("#pwd3 .fa-eye-slash");

eye3.addEventListener("click", () => {
    if (input3.type === "password") {
        input3.type = "text";

        eye3.classList.remove("fa-eye-slash");
        eye3.classList.add("fa-eye");
    } else {
        input3.type = "password";

        eye3.classList.remove("fa-eye");
        eye3.classList.add("fa-eye-slash");
    }
});
