/**
 * Form validation utilities
 */
const validators = {
    /**
     * Validates email format
     * @param {string} email 
     * @returns {boolean}
     */
    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    },

    /**
     * Validates password strength
     * @param {string} password 
     * @returns {boolean}
     */
    isValidPassword(password) {
        return password.length >= 8;
    },

    /**
     * Validates name format
     * @param {string} name 
     * @returns {boolean}
     */
    isValidName(name) {
        return name.trim().length >= 2;
    },

    /**
     * Validates the entire form
     * @param {HTMLFormElement} form 
     * @returns {boolean}
     */
    validateForm(form) {
        let isValid = true;
        const inputs = form.querySelectorAll('input[required]');

        inputs.forEach(input => {
            if (!input.value) {
                isValid = false;
                input.classList.add('is-invalid');
            } else {
                switch (input.type) {
                    case 'email':
                        if (!this.isValidEmail(input.value)) {
                            isValid = false;
                            input.classList.add('is-invalid');
                        }
                        break;
                    case 'password':
                        if (!this.isValidPassword(input.value)) {
                            isValid = false;
                            input.classList.add('is-invalid');
                        }
                        break;
                    case 'text':
                        if (input.id === 'name' && !this.isValidName(input.value)) {
                            isValid = false;
                            input.classList.add('is-invalid');
                        }
                        break;
                }
            }
        });

        return isValid;
    }
};