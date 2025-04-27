console.log('Success | Loaded Common JavaScript.');

// Setting the users local timezone so that clock works internationally.
const user_timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
console.log('Success | User Timezone Set: ', user_timezone);


// Function to retrieve the last updated time from any public GitHub Repository.
async function fetch_github_last_updated(owner, repository) {
    const url = `https://api.github.com/repos/${owner}/${repository}`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            console.log(url);
            console.error('Error | Network response was not OK. (fetch_github_last_updated)');
            return null;
        }
        const data = await response.json();
        return data.updated_at;
    } catch (error) {
        console.error('Error | There was a problem with the fetch operation (fetch_github_last_updated): ', error);
        return null;
    }
}


// Function to update or create a new meta tag with the property and content provided.
function update_meta_tag(property, content, type) {
    const meta_tag = document.querySelector(`meta[${type}="${property}"]`);
    if (meta_tag) {
        meta_tag.setAttribute('content', content);
    } else {
        const new_meta_tag = document.createElement('meta');
        new_meta_tag.setAttribute(`${type}`, property);
        new_meta_tag.setAttribute('content', content);
        document.head.appendChild(new_meta_tag);
    }
}


// Function to fetch the last updated time from the GitHub Repository and update the Open Graph meta tag.
async function fetch_og_updated_time() {
    const owner = 'tristanbudd';
    const repository = 'cosmodrome';
    const updated_time = await fetch_github_last_updated(owner, repository);
    if (updated_time) {
        update_meta_tag('og:updated_time', updated_time, 'property');

        // Also updating the last updated time in the header bar.
        const last_updated_tag = document.getElementById('last-updated');
        if (last_updated_tag) {
            last_updated_tag.innerText = new Date(updated_time).toLocaleString('en-GB', {timeZone: user_timezone});
        }

        console.log('Success | Last Updated Time Retrieved: ', updated_time);
    } else {
        console.error('Error | No last updated time retrieved :( (fetch_og_updated_time)');
    }
}

fetch_og_updated_time().then(() => {}).catch((error) => {
    console.error('Error | There was a problem with the fetch operation (fetch_og_updated_time): ', error);
});


// Function to update the copyright notice meta tags with the current year.
async function update_copyright_notice() {
    const current_year = new Date().getFullYear();
    if (current_year) {
        const notice_content = "Copyright © Tristan Budd ".concat(current_year);
        update_meta_tag('copyright', notice_content, 'name');
        console.log('Success | Copyright current year updated: ', current_year);
    } else {
        console.error('Error | Copyright current year not retrieved :( (update_copyright_notice)');
    }
}

update_copyright_notice().then(() => {}).catch((error) => {
    console.error('Error | There was a problem attempting to update copyright notice (update_copyright_notice): ', error);
});


// Function to create or update cookies.
function set_cookie(name, value, days) {
    if (document.cookie.split(';').some((item) => item.trim().startsWith('cookies_accepted='))) {
        let expires = '';
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = `; expires=${date.toUTCString()}`;
        }
        document.cookie = `${name}=${value || ''}${expires}; path=/`;

        console.log('Success | Setting cookie ' + name + ' with value: ' + value + ' for ' + days + ' days.');
    } else {
        console.error('Error | Unable to set cookie ' + name + ' as cookies have not been accepted.');
    }
}

// Function to check if a cookie is already set.
function check_cookie(name) {
    return document.cookie.split(';').some((item) => item.trim().startsWith(name + '='));
}

// Detect user system theme preference and set the theme accordingly.
if (!check_cookie('user_system_theme')) {
    if (window.matchMedia) {
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            console.log('Success | Setting your default system theme preference to: Dark');
            set_cookie('user_system_theme', 'dark', 365);
        } else {
            console.log('Success | Setting your default system theme preference to: Light');
            set_cookie('user_system_theme', 'light', 365);
        }
    } else {
        console.error('Error | Media-Queries not supported, defaulting to colour scheme preference: Light');
    }
}

// Detect page scrolling to adjust page styling & toggle to-top button.
function debounce(fn, delay) {
    let timer = null;
    return function () {
        clearTimeout(timer);
        timer = setTimeout(fn, delay);
    };
}

window.addEventListener('scroll', debounce(() => {
    const scroll_position = window.pageYOffset || document.documentElement.scrollTop;
    const header = document.getElementById('header');

    if (header) {
        if (scroll_position >= 1) {
            if (!header.classList.contains('has-scrolled')) {
                header.classList.add('has-scrolled');
            }
        } else {
            if (header.classList.contains('has-scrolled')) {
                header.classList.remove('has-scrolled');
            }
        }
    }
}, 10));

// Make the dropdown menu work on the navigation bar.
const header_links = document.querySelectorAll('.header-link-a');

header_links.forEach((link) => {
    link.addEventListener('mouseover', () => {
        const link_id = link.getAttribute('id');
        const dropdown = document.getElementById(`header-${link_id}`);

        document.querySelectorAll('.dropdown-content').forEach((otherDropdown) => {
            if (otherDropdown !== dropdown) {
                otherDropdown.style.display = 'none';
            }
        });

        if (dropdown) {
            dropdown.style.display = 'flex';
        }
    });

    link.addEventListener('mouseout', () => {
        const link_id = link.getAttribute('id');
        const dropdown = document.getElementById(`header-${link_id}`);
        if (dropdown) {
            setTimeout(() => {
                if (!dropdown.matches(':hover') && !link.matches(':hover')) {
                    dropdown.style.display = 'none';
                }
            }, 200);
        }
    });

    const dropdown_id = link.getAttribute('id');
    const dropdown = document.getElementById(`header-${dropdown_id}`);
    if (dropdown) {
        dropdown.addEventListener('mouseover', () => {
            dropdown.style.display = 'flex';
        });

        dropdown.addEventListener('mouseout', () => {
            setTimeout(() => {
                if (!dropdown.matches(':hover') && !link.matches(':hover')) {
                    dropdown.style.display = 'none';
                }
            }, 200);
        });
    }
});

// Notification System
function create_notification(type = 'error', message) {
    const allowed_types = ['error', 'warning', 'success'];
    if (!allowed_types.includes(type)) {
        type = 'error';
    }

    const notification_box = document.getElementById('notification-box');

    const notification = document.createElement('div');
    notification.classList.add('notification', `notification-${type}`);

    notification.innerHTML = `
        <strong>${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
        <p>${message}</p>
        <a onclick="this.parentElement.remove()">
            <i class="fa-solid fa-xmark"></i>
        </a>
    `;

    notification_box.appendChild(notification);
}

function clear_all_notifications() {
    const notification_box = document.getElementById('notification-box');
    const notifications = notification_box.querySelectorAll('.notification');

    notifications.forEach((notification) => {
        notification.remove();
    });
}