document.addEventListener("DOMContentLoaded", function () {
    const signUpForm = document.getElementById("signup");
    const signInForm = document.getElementById("signIn");

    const signUpButton = document.getElementById("signUpButton");
    const signInButton = document.getElementById("signInButton");

    if (signUpForm && signInForm && signUpButton && signInButton) {
        signUpButton.addEventListener("click", function () {
            signInForm.style.display = "none";
            signUpForm.style.display = "block";
        });

        signInButton.addEventListener("click", function () {
            signInForm.style.display = "block";
            signUpForm.style.display = "none";
        });
    }
});
