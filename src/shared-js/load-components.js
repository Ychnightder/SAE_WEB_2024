// Load header

import {header} from "../shared-js/header.js";


function loadHeader() {
    return fetch('../shared-html/header.html')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(data => {
            document.getElementById('header-placeholder').innerHTML = data;
            header();


        })
        .catch(error => console.error('Header loading error:', error));
}



// Load footer

function loadFooter() {
    return fetch('../shared-html/footer.html')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(data => {
            document.getElementById('footer-placeholder').innerHTML = data;
        })
        .catch(error => console.error('Footer loading error:', error));
}



document.addEventListener('DOMContentLoaded', function() {
    loadHeader();
    loadFooter();
});
