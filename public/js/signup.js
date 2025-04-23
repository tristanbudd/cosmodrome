console.log('Success | Loaded Sign-Up JavaScript.');

// Setting Up Variables
const form = document.querySelector('form');
const error_message = document.getElementById('error_message');
const signup_page_1 = document.getElementById('signup_page_1');
const signup_page_2 = document.getElementById('signup_page_2');

const terms_agreed = document.getElementById('terms_agreed');
const submit_button = document.querySelector('input[type="submit"]');

// Sign-Up Page System
function signup_page(current_page, target_page) {
    error_message.style.display = 'none';

    if (current_page === 1 && target_page === 2) {
        if (terms_agreed.checked) {
            signup_page_1.style.display = 'none';
            signup_page_2.style.display = 'flex';
        } else {
            error_message.style.display = 'block';
            error_message.innerHTML = 'Please agree to the terms and conditions before proceeding.';
        }
    } else {
        const current_page_element = document.getElementById(`signup_page_${current_page}`);
        current_page_element.style.display = 'none';
        const target_page_element = document.getElementById(`signup_page_${target_page}`);
        target_page_element.style.display = 'flex';
    }
}

// Prevent Submitting Unless Final Button
form.addEventListener('submit', (event) => {
    if (event.submitter !== submit_button) {
        event.preventDefault();
    }
});