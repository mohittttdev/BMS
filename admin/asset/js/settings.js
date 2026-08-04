// ==========================
// SETTINGS PAGE
// ==========================

document.addEventListener("DOMContentLoaded", () => {

    // Logo Preview
    const logoInput = document.querySelector('input[name="company_logo"]');
    const previewImg = document.querySelector(".logo-preview img");

    if (logoInput && previewImg) {

        logoInput.addEventListener("change", function () {

            const file = this.files[0];

            if (!file) return;

            const reader = new FileReader();

            reader.onload = function (e) {
                previewImg.src = e.target.result;
            };

            reader.readAsDataURL(file);

        });

    }

    // Confirm Password Validation
    const newPassword = document.querySelector('input[name="new_password"]');
    const confirmPassword = document.querySelector('input[name="confirm_password"]');
    const form = document.querySelector("form");

    if (form) {

        form.addEventListener("submit", function (e) {

            if (newPassword.value !== "" || confirmPassword.value !== "") {

                if (newPassword.value !== confirmPassword.value) {

                    alert("New Password and Confirm Password do not match.");

                    confirmPassword.focus();

                    e.preventDefault();

                }

            }

        });

    }

    // Success Message Auto Hide
    const success = document.querySelector(".success");

    if (success) {

        setTimeout(() => {

            success.style.transition = ".5s";
            success.style.opacity = "0";

            setTimeout(() => {
                success.remove();
            }, 500);

        }, 3000);

    }

    // Error Message Auto Hide
    const error = document.querySelector(".error");

    if (error) {

        setTimeout(() => {

            error.style.transition = ".5s";
            error.style.opacity = "0";

            setTimeout(() => {
                error.remove();
            }, 500);

        }, 3000);

    }

});