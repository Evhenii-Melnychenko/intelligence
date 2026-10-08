export function initContactForm() {
    const form = document.querySelector('[data-contact-form]');
    const status = document.querySelector('[data-contact-status]');
    const submitButton = form?.querySelector('[type="submit"]');

    if (!(form instanceof HTMLFormElement) || !(status instanceof HTMLElement) || !(submitButton instanceof HTMLButtonElement)) {
        return;
    }

    const fields = Array.from(form.querySelectorAll('input:not([type="hidden"]), textarea'));
    const clearFieldError = (field) => field.removeAttribute('aria-invalid');

    fields.forEach((field) => {
        field.addEventListener('input', () => clearFieldError(field));
        field.addEventListener('change', () => clearFieldError(field));
    });

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        status.textContent = '';
        fields.forEach(clearFieldError);

        const invalidField = fields.find((field) => !field.checkValidity());
        if (invalidField) {
            invalidField.setAttribute('aria-invalid', 'true');
            invalidField.reportValidity();
            return;
        }

        const config = window.futuretechContact;
        const formData = new FormData(form);

        if (!config?.ajaxUrl || !config.nonce) {
            status.textContent = config?.errors?.unavailable || 'The contact form is not available right now. Please try again later.';
            status.dataset.state = 'error';
            return;
        }

        formData.set('action', 'futuretech_contact_form');
        formData.set('nonce', config.nonce);
        submitButton.disabled = true;
        submitButton.classList.add('is-loading');
        submitButton.setAttribute('aria-busy', 'true');
        status.dataset.state = 'loading';
        status.textContent = config.errors?.sending || 'Sending your message…';

        try {
            const response = await fetch(config.ajaxUrl, {
                method: 'POST',
                credentials: 'same-origin',
                body: formData,
            });
            const result = await response.json();

            if (!response.ok || !result.success) {
                const fieldErrors = result.data?.fields || {};
                const firstInvalid = fields.find((field) => Object.prototype.hasOwnProperty.call(fieldErrors, field.name));

                if (firstInvalid) {
                    firstInvalid.setAttribute('aria-invalid', 'true');
                    firstInvalid.focus();
                }

                throw new Error(result.data?.message || config.errors?.generic || 'Your message could not be sent. Please try again.');
            }

            form.reset();
            status.dataset.state = 'success';
            status.textContent = result.data?.message || 'Thanks for reaching out. Your message has been sent.';
        } catch (error) {
            status.dataset.state = 'error';
            const genericError = config.errors?.generic || 'Your message could not be sent. Please try again.';
            status.textContent = error instanceof Error && !(error instanceof SyntaxError) && !(error instanceof TypeError)
                ? error.message
                : genericError;
        } finally {
            submitButton.disabled = false;
            submitButton.classList.remove('is-loading');
            submitButton.removeAttribute('aria-busy');
        }
    });
}
