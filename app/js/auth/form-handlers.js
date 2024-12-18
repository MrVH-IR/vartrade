/**
 * Form handling utilities
 */
const formHandlers = {
    /**
     * Handles form submission
     * @param {Event} event 
     */
    handleSubmit(event) {
        event.preventDefault();
        const form = event.target;

        // Remove any existing validation states
        form.querySelectorAll('.is-invalid').forEach(input => {
            input.classList.remove('is-invalid');
        });

        // Validate form
        if (!validators.validateForm(form)) {
            return;
        }

        // Collect form data
        const formData = {
            email: form.querySelector('#email').value,
            password: form.querySelector('#password').value
        };

        const nameInput = form.querySelector('#name');
        if (nameInput && !nameInput.classList.contains('d-none')) {
            formData.name = nameInput.value;
        }

        // Here you would typically send the data to a server
        console.log('Form submitted:', formData);

        // Show success message
        this.showSuccessMessage(formData.name ? 'register' : 'login');
    },

    /**
     * Shows success message after form submission
     * @param {string} mode 
     */
    showSuccessMessage(mode) {
        const successMessage = mode === 'login' ?
            'ورود با موفقیت انجام شد!' :
            'ثبت نام با موفقیت انجام شد!';

        // Create alert element
        const alert = document.createElement('div');
        alert.className = 'alert alert-success slide-up';
        alert.role = 'alert';
        alert.textContent = successMessage;

        // Add alert to page
        const form = document.getElementById('authForm');
        form.insertAdjacentElement('beforebegin', alert);

        // Remove alert after 3 seconds
        setTimeout(() => {
            alert.remove();
        }, 3000);
    },

    /**
     * Resets form fields
     * @param {HTMLFormElement} form 
     */
    resetForm(form) {
        form.reset();
        form.querySelectorAll('.is-invalid').forEach(input => {
            input.classList.remove('is-invalid');
        });
    }
};