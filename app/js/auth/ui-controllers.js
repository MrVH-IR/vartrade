/**
 * UI control utilities
 */
const uiControllers = {
    /**
     * Toggles password visibility
     * @param {HTMLElement} toggleButton 
     * @param {HTMLInputElement} passwordInput 
     */
    togglePasswordVisibility(toggleButton, passwordInput) {
        const icon = toggleButton.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        } else {
            passwordInput.type = 'password';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        }
    },

    /**
     * Toggles between login and register modes
     * @param {boolean} isRegisterMode 
     */
    toggleAuthMode(isRegisterMode) {
        const nameField = document.getElementById('nameField');
        const authTitle = document.getElementById('authTitle');
        const authSubtitle = document.getElementById('authSubtitle');
        const submitText = document.getElementById('submitText');
        const toggleText = document.getElementById('toggleText');
        const submitIcon = document.querySelector('#submitButton i');

        if (isRegisterMode) {
            nameField.classList.remove('d-none');
            authTitle.textContent = 'ثبت نام کنید';
            authSubtitle.textContent = 'حساب کاربری جدید ایجاد کنید';
            submitText.textContent = 'ثبت نام';
            toggleText.textContent = 'حساب کاربری دارید؟ وارد شوید';
            submitIcon.classList.replace('bi-box-arrow-in-left', 'bi-person-plus');
        } else {
            nameField.classList.add('d-none');
            authTitle.textContent = 'خوش آمدید';
            authSubtitle.textContent = 'برای ادامه وارد شوید';
            submitText.textContent = 'ورود';
            toggleText.textContent = 'حساب کاربری ندارید؟ ثبت نام کنید';
            submitIcon.classList.replace('bi-person-plus', 'bi-box-arrow-in-left');
        }
    }
};