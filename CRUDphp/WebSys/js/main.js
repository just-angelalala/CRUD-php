function togglePasswordVisibility() {
    var passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
    passwordField.type = "text";
        document.querySelector(".showpass").textContent = "Hide Password";
    } else {
        passwordField.type = "password";
        document.querySelector(".showpass").textContent = "Show Password";
    }
}