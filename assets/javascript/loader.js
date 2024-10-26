document.getElementById('form').addEventListener('submit', function(event) {
    // Show loader on form submission
    document.querySelector('.loader').style.display = 'flex';

});

// Hide loader after page reload or when the page fully loads
window.onload = function() {
    document.querySelector('.loader').style.display = 'none';            
};