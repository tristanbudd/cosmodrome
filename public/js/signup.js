console.log('Success | Loaded Sign-Up JavaScript.');

// Setting Up Variables
const form = document.querySelector('form');
const error_messages = document.querySelectorAll('.error-message');

const submit_button = document.querySelector('input[type="submit"]');

// Utility Functions
function hide_all_error_messages() {
    error_messages.forEach((error_message) => {
        error_message.style.display = 'none';
    });
}

function display_error_message(message) {
    error_messages.forEach((error_message) => {
        error_message.innerHTML = message;
        error_message.style.display = 'block';
    });
}

// Sign-Up Page System
function signup_page(current_page, target_page) {
    const signup_page_1 = document.getElementById('signup_page_1');
    const signup_page_2 = document.getElementById('signup_page_2');
    const signup_page_3 = document.getElementById('signup_page_3');

    hide_all_error_messages();

    if (current_page === 1 && target_page === 2) {
        const terms_agreed = document.getElementById('terms_agreed');

        if (terms_agreed.checked) {
            signup_page_1.style.display = 'none';
            signup_page_2.style.display = 'flex';
        } else {
            display_error_message('Please agree to the terms and conditions before proceeding.');
        }
    } else if (current_page === 2 && target_page === 3) {
        const first_name = document.getElementById('first_name');
        const last_name = document.getElementById('last_name');
        const upload_profile_picture_img = document.getElementById('upload_profile_picture_img');

        if (first_name.value !== '' && last_name.value !== '') {
            if (upload_profile_picture_img.files.length === 0) {
                display_error_message('Please upload a profile picture or generate one based on your initials.');
                return;
            }
            signup_page_2.style.display = 'none';
            signup_page_3.style.display = 'flex';
        } else {
            display_error_message('Please fill in all required fields.');
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
    const submitter = event.submitter || document.activeElement;
    if (submitter !== submit_button) {
        event.preventDefault();
    }
});

// Upload Custom Profile Picture
function upload_profile_picture() {
    document.getElementById("upload_profile_picture_img").click();
}

document.getElementById("upload_profile_picture_img").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (!file) return;

    const validTypes = ["image/png", "image/gif", "image/jpeg"];
    if (!validTypes.includes(file.type)) {
        display_error_message('Invalid file type. Please select a PNG, JPG or GIF image.');
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        document.getElementById("profile_picture_img").src = e.target.result;
    };
    reader.readAsDataURL(file);
});

// Generate Profile Pictures Based Upon Initials
async function generate_profile_picture() {
    const first_name = document.getElementById('first_name');
    const last_name = document.getElementById('last_name');
    const first_name_value = first_name.value.trim();
    const last_name_value = last_name.value.trim();

    if (first_name_value && last_name_value) {
        const initials = `${first_name_value[0]}${last_name_value[0]}`.toUpperCase();
        const image_url = `https://ui-avatars.com/api/?name=${initials}&background=fff&color=000&bold=true&rounded=true&size=256`;

        try {
            const response = await fetch(image_url);
            const blob = await response.blob();

            const file = new File([blob], "profile_picture.png", {type: "image/png"});

            const profile_picture_img = document.getElementById('profile_picture_img');
            profile_picture_img.src = URL.createObjectURL(blob);

            const data_transfer = new DataTransfer();
            data_transfer.items.add(file);

            const upload_profile_picture_img = document.getElementById('upload_profile_picture_img');
            upload_profile_picture_img.files = data_transfer.files;
        } catch (error) {
            display_error_message('Failed to fetch profile picture image.');
            console.error("Error | ", error);
        }
    } else {
        display_error_message('Please fill in all required fields to generate a profile picture.');
    }
}

// Password Strength Indicator
const password_input = document.getElementById('password');
const password_8characters = document.getElementById('password_8characters');
const password_1uppercase = document.getElementById('password_1uppercase');
const password_1lowercase = document.getElementById('password_1lowercase');
const password_1number = document.getElementById('password_1number');
const password_1special = document.getElementById('password_1special');

function check_password_strength() {
    const password = password_input.value;
    const length = password.length >= 8;
    const uppercase = /[A-Z]/.test(password);
    const lowercase = /[a-z]/.test(password);
    const number = /\d/.test(password);
    const special = /[!@#$%^&*(),.?":{}|<>]/.test(password);

    password_8characters.style.color = length ? 'var(--colour-success)' : 'var(--colour-error)';
    password_1uppercase.style.color = uppercase ? 'var(--colour-success)' : 'var(--colour-error)';
    password_1lowercase.style.color = lowercase ? 'var(--colour-success)' : 'var(--colour-error)';
    password_1number.style.color = number ? 'var(--colour-success)' : 'var(--colour-error)';
    password_1special.style.color = special ? 'var(--colour-success)' : 'var(--colour-error)';

    password_8characters.innerHTML = length ? '<i class="fa-solid fa-check"></i> At Least 8 Characters' : '<i class="fa-solid fa-xmark"></i> At Least 8 Characters';
    password_1uppercase.innerHTML = uppercase ? '<i class="fa-solid fa-check"></i> At Least 1 Uppercase Letter' : '<i class="fa-solid fa-xmark"></i> At Least 1 Uppercase Letter';
    password_1lowercase.innerHTML = lowercase ? '<i class="fa-solid fa-check"></i> At Least 1 Lowercase Letter' : '<i class="fa-solid fa-xmark"></i> At Least 1 Lowercase Letter';
    password_1number.innerHTML = number ? '<i class="fa-solid fa-check"></i> At Least 1 Number' : '<i class="fa-solid fa-xmark"></i> At Least 1 Number';
    password_1special.innerHTML = special ? '<i class="fa-solid fa-check"></i> At Least 1 Special Character' : '<i class="fa-solid fa-xmark"></i> At Least 1 Special Character';
}

password_input.addEventListener('input', () => {
    check_password_strength();
});

// Password Matching Indicator
const confirm_password_input = document.getElementById('confirm_password');
const password_matching = document.getElementById('password_matching');

function check_password_matching() {
    const password = password_input.value.trim();
    const confirm_password = confirm_password_input.value.trim();

    if (password === '' || confirm_password === '') {
        password_matching.style.color = 'var(--colour-error)';
        password_matching.innerHTML = '<i class="fa-solid fa-xmark"></i> Password Field Cannot Be Empty';
    } else if (password === confirm_password) {
        password_matching.style.color = 'var(--colour-success)';
        password_matching.innerHTML = '<i class="fa-solid fa-check"></i> Passwords Match';
    } else {
        password_matching.style.color = 'var(--colour-error)';
        password_matching.innerHTML = '<i class="fa-solid fa-xmark"></i> Passwords Do Not Match';
    }
}

confirm_password_input.addEventListener('input', () => {
    check_password_matching();
});

// Show And Hide Indicators
const password_strength = document.getElementById('password_strength');
const confirm_password_strength = document.getElementById('confirm_password_strength');

password_input.addEventListener('focus', () => {
    password_strength.style.display = 'block';
});
password_input.addEventListener('blur', () => {
    password_strength.style.display = 'none';
});

confirm_password_input.addEventListener('focus', () => {
    confirm_password_strength.style.display = 'block';
});
confirm_password_input.addEventListener('blur', () => {
    confirm_password_strength.style.display = 'none';
});

// Testing Password Security
function test_password(type) {
    const encryption_enabled = document.getElementById('encryption_enabled');
    const password = password_input.value.trim();
    const confirm_password = confirm_password_input.value.trim();

    if (type === 1) {
        encryption_enabled.value = 'true';

        if (password_input.value === '' || confirm_password_input.value === '') {
            display_error_message('Please fill in all required fields.');
            return;
        } else if (password.length < 8) {
            display_error_message('Password must be at least 8 characters long.');
            return;
        } else if (!/[A-Z]/.test(password)) {
            display_error_message('Password must contain at least 1 uppercase letter.');
            return;
        } else if (!/[a-z]/.test(password)) {
            display_error_message('Password must contain at least 1 lowercase letter.');
            return;
        } else if (!/[\d]/.test(password)) {
            display_error_message('Password must contain at least 1 number.');
            return;
        } else if (!/[\W_]/.test(password)) {
            display_error_message('Password must contain at least 1 special character.');
            return;
        } else if (password.includes(' ') || confirm_password.includes(' ')) {
            display_error_message('Password cannot contain empty characters.');
            return;
        } else if (password !== confirm_password) {
            display_error_message('Passwords do not match.');
            return;
        }

        signup_page(3, 4);
    } else if (type === 2) {
        encryption_enabled.value = 'false';
        signup_page(3, 4);
    }
}

// Local File Preset Download
const download_local_file_button = document.getElementById('download_local_file');
const info_message = document.getElementById('info_message');

download_local_file_button.addEventListener('click', () => {
    hide_all_error_messages();
    const first_name = document.getElementById('first_name').value.trim();
    const last_name = document.getElementById('last_name').value.trim();

    if (!first_name || !last_name) {
        display_error_message('Please fill in both your first and last name to download the file.');
        return;
    }

    const file_name = `${first_name.toLowerCase()}${last_name.toLowerCase()}.cosmo`;
    const file_content = '';

    const blob = new Blob([file_content], { type: 'application/json' });
    const url = URL.createObjectURL(blob);

    const downloadLink = document.createElement('a');
    downloadLink.href = url;
    downloadLink.download = file_name;
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);

    info_message.style.display = 'block';
});

// Test File Access
const test_file_access_button = document.getElementById('test_file_access');
const test_file_access_input = document.getElementById('test_file_access_input');

test_file_access_button.addEventListener('click', async () => {
    hide_all_error_messages();
    info_message.style.display = 'none';
    if ('showOpenFilePicker' in window) {
        try {
            const [fileHandle] = await window.showOpenFilePicker({
                types: [{
                    description: 'Cosmo Files',
                    accept: { 'text/plain': ['.cosmo'] }
                }],
                multiple: false
            });

            const file = await fileHandle.getFile();
            const content = await file.text();

            if (!file.name.endsWith('.cosmo')) {
                display_error_message('Invalid file type. Please select a file ending with .cosmo.');
                return;
            }

            if (content.trim() !== '') {
                display_error_message('File is not empty. Please select an empty .cosmo file.');
                return;
            }

            const writable = await fileHandle.createWritable();
            const newContent = '{}';
            await writable.write(newContent);
            await writable.close();

            info_message.innerHTML = '<i class="fa-solid fa-circle-check"></i> File read & written to successfully. You can now proceed to create your account.';
            info_message.style.color = 'var(--colour-success)';
            info_message.style.display = 'block';

        } catch (error) {
            console.error("Error | ", error);
            display_error_message('An error occurred while accessing the file.');
        }
    } else {
        test_file_access_input.click();
    }
});

test_file_access_input.addEventListener('change', (event) => {
    hide_all_error_messages();
    info_message.style.display = 'none';
    const file = event.target.files[0];
    if (!file) return;

    if (!file.name.endsWith('.cosmo')) {
        display_error_message('Invalid file type. Please select a file ending with .cosmo.');
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        const content = e.target.result;
        if (content.trim() === '') {
            info_message.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> File read successfully, but this browser does not support saving directly to the file. (This means you will need to manually save each snapshot. Chromium based browsers do not have this issue)';
            info_message.style.color = 'var(--colour-warning)';
            info_message.style.display = 'block';
        } else {
            display_error_message('File is not empty. Please select an empty .cosmo file.');
        }
    };
    reader.readAsText(file);
});

// Function Callbacks
document.addEventListener('DOMContentLoaded', () => {
    const generate_profile_picture_button = document.getElementById('generate_profile_picture');
    generate_profile_picture_button.addEventListener('click', generate_profile_picture);

    const upload_profile_picture_button = document.getElementById('upload_profile_picture');
    upload_profile_picture_button.addEventListener('click', upload_profile_picture);

    const encrypt_data_button = document.getElementById('encrypt_data');
    encrypt_data_button.addEventListener('click', () => {
        test_password(1);
    });

    const dont_encrypt_data_button = document.getElementById('dont_encrypt_data');
    dont_encrypt_data_button.addEventListener('click', () => {
        test_password(2);
    });
});