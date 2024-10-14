document.addEventListener("DOMContentLoaded", () => {
    if(document.querySelector(".adminorders .grid-search-button")){
        document.querySelector(".adminorders .grid-search-button").innerText= ''
        document.querySelector(".adminorders .grid-search-button").innerHTML = "<i class='material-icons'>search</i>";
    }

    if(document.querySelector(".adminorders .grid-reset-button")) {
        document.querySelector(".adminorders .grid-reset-button").innerText= ''
        document.querySelector(".adminorders .grid-reset-button").innerHTML = "<i class='material-icons'>clear</i>";
    }
});
