/**
 * Main application initialization
 */
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('authForm');
    const modeToggle = document.getElementById('modeToggle');
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.querySelector('.password-toggle');
    let isRegisterMode = false;

    // Form submission handler
    form.addEventListener('submit', (event) => formHandlers.handleSubmit(event));

    // Mode toggle handler
    modeToggle.addEventListener('click', () => {
        isRegisterMode = !isRegisterMode;
        uiControllers.toggleAuthMode(isRegisterMode);
        formHandlers.resetForm(form);
    });

    // Password visibility toggle
    passwordToggle.addEventListener('click', () => {
        uiControllers.togglePasswordVisibility(passwordToggle, passwordInput);
    });

    // Input validation handlers
    form.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', () => {
            input.classList.remove('is-invalid');
        });
    });
});