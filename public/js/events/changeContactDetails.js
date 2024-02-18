// Show spinner immediately when the page starts loading
document.addEventListener('DOMContentLoaded', function() {
    var spinner = document.getElementById('spinner');
    spinner.style.display = 'block';
});

// Hide spinner when the page has fully loaded
window.addEventListener('load', function() {
    var spinner = document.getElementById('spinner');
    spinner.style.display = 'none';
});
