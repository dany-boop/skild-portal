function showToast(message) {
    var toast = document.getElementById("toast");
    toast.innerHTML = message;
    toast.style.display = "block";

    setTimeout(function () {
        toast.style.display = "none";
    }, 3000);
}

function showLoginFailedToast() {
    showToast("Login failed. Please check your email and password.");
}

function handleLoginFailure() {
    showLoginFailedToast();
}