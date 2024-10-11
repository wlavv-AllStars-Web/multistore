document.addEventListener("DOMContentLoaded", () => {
    if(document.querySelector(".grid-search-button")){
        document.querySelector(".grid-search-button").innerText= ''
        document.querySelector(".grid-search-button").innerHTML = "<i class='material-icons'>search</i>";
    }

    if(document.querySelector(".grid-reset-button")) {
        document.querySelector(".grid-reset-button").innerText= ''
        document.querySelector(".grid-reset-button").innerHTML = "<i class='material-icons'>clear</i>";
    }
});
