const urlParams = new URLSearchParams(window.location.search);
const searchTerm = urlParams.get('q');
document.querySelector('h1').textContent = 'Showing results for: \'' + searchTerm + '\'';