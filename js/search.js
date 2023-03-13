console.log('Search script loaded.');

const searchButton = document.querySelector('button');
const searchInput = document.querySelector('#search-input');

searchButton.addEventListener('click', function() {
    const searchTerm = searchInput.value;
    window.location.href = 'search.php?q=' + encodeURIComponent(searchTerm);
});

searchInput.addEventListener('keyup', function(event) {
    if (event.key === 'Enter') {
        const searchTerm = searchInput.value;
        window.location.href = 'search.php?q=' + encodeURIComponent(searchTerm);
    }
});
