function validateForm() {
    let username = document.getElementById("username").value.trim();
    let password = document.getElementById("password").value.trim();

    let valid = true;

    // Username validation
    if (username === "") {
        document.getElementById("userError").innerText = "Username required";
        valid = false;
    } else {
        document.getElementById("userError").innerText = "";
    }

    // Password validation
    if (password === "") {
        document.getElementById("passError").innerText = "Password required";
        valid = false;
    } else {
        document.getElementById("passError").innerText = "";
    }

    return valid;
}
