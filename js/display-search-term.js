const urlParams = new URLSearchParams(window.location.search);
let searchTerm = urlParams.get('q');
if (searchTerm === null)
    searchTerm = "";
document.querySelector('h1').textContent = 'Showing results for: \'' + searchTerm + '\'';