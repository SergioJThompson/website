/**
 * @todo Store essays as files in a certain folder. Then have JS files get the names of those files
 */
window.onload = function() {
    const essaysFolder = "/html/essays/";
    const apiUrl = "/php/get_essay_names.php";
    const displayDiv = document.querySelector("#display-links");
    fetch(apiUrl)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            let hyperlinks = "";
            data.forEach(function(fileName) {
                const filePath = essaysFolder + fileName;
                hyperlinks += `<a href="${filePath}">${fileName}</a><br>`;
            });
            displayDiv.innerHTML = hyperlinks;
        })
        .catch(function(error) {
            console.error("Error retrieving file names:", error);
        });
};