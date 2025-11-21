window.addEventListener("DOMContentLoaded", () => {
    const contactFormName = "contact";

    const contactForm = document.querySelector(`form[name="${contactFormName}"]`);

    contactForm.addEventListener("submit", handleContactFormSubmit);

    // Add extended validation for the email address but still use the constraint validation API
    // https://html.spec.whatwg.org/multipage/form-control-infrastructure.html#the-constraint-validation-api
    contactForm.querySelector("#contact-email").addEventListener("input", (event) => {
        const email = event.target.value.trim();

        if (!isValidEmail(email)) {
            contactForm.querySelector("#contact-email").setCustomValidity("Please provide a valid email address");
            return;
        }

        contactForm.querySelector("#contact-email").setCustomValidity("");
    });

    document.querySelectorAll("*[data-prefill-contact-message]").forEach((element) => {
        const message = element.getAttribute("data-prefill-contact-message");

        element.addEventListener("click", () => {
            contactForm.querySelector("#contact-message").value = message
        });
    });
});

/**
 * @param {Event} event - The submit event.
 * @returns {void}
 */
async function handleContactFormSubmit(event) {
    event.preventDefault();
    event.stopPropagation();

    /** @type {HTMLFormElement} */
    const contactForm = event.target;

    contactForm.classList.add('was-validated');

    const firstName = contactForm.querySelector("#contact-first-name").value.trim();
    const lastName = contactForm.querySelector("#contact-last-name").value.trim();
    const email = contactForm.querySelector("#contact-email").value.trim();
    const phone = contactForm.querySelector("#contact-phone").value.trim();
    const message = contactForm.querySelector("#contact-message").value.trim();
    const turnstile = contactForm.querySelector(`input[name="cf-turnstile-response"]`)?.value;
    const submitButton = contactForm.querySelector('button[type="submit"]');

    const formData = {
        firstName,
        lastName,
        email,
        phone,
        message,
        turnstile,
    };

    try {
        submitButton.disabled = true;

        const response = await fetch("/api/contact", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(formData),
        });

        if (!response.ok) {
            contactForm.querySelector("#contact-alert").classList.remove("d-none");
            return;
        }

        contactForm.querySelector("#contact-alert").classList.add("d-none");
        contactForm.querySelector("#contact-success").classList.remove("d-none");

    } catch (error) {
        contactForm.querySelector("#contact-alert").classList.remove("d-none");
    } finally {
        submitButton.disabled = false;
    }
}

/**
 * @param {string} email
 * @returns {boolean}
 */
function isValidEmail(email) {
    const emailPattern =
        /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,}|\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])$/;

    return emailPattern.test(email);
}
