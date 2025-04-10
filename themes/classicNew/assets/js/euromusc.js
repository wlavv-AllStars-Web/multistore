// document.addEventListener('DOMContentLoaded', function() {
//     window.onload = function() {
//         const searchIconMobile = document.querySelector('.header-nav #_mobile_cart .search');
//         const searchBarMobile = document.querySelector('.header-top-right #search_widget');
    
//         if (searchIconMobile && searchBarMobile) {
//             searchIconMobile.addEventListener('click', function() {
//                 if (!searchBarMobile.style.display || searchBarMobile.style.display === "none") {
//                     searchBarMobile.style.display = "block";
//                 } else {
//                     searchBarMobile.style.display = "none";
//                 }
//             });
//         }
//     };
//     });

function toggleSearchbar() {
    const searchBarMobile = document.querySelector('.header-top-right #search_widget');

    if (!searchBarMobile.style.display || searchBarMobile.style.display === "none") {
        searchBarMobile.style.display = "block";
    } else {
        searchBarMobile.style.display = "none";
    }

}


// menu brands

document.addEventListener('DOMContentLoaded', function() {
// dropdown brands
const dropdownLi = document.querySelector(".mainmenuDesktop .dropdown.brands-drop")
const dropdownBrands = document.querySelector('a.dropdown-toggle-brands');
// const dropdownBrandsCaret = document.querySelector('li.dropdown i');
const dropdownContent = document.querySelector('ul.dropdown-content');


dropdownBrands.addEventListener('click', (e) => {
  e.stopPropagation();
  toggleDropdown();
});

if(window.screen.width > 767){
  dropdownLi.addEventListener('mouseover', (e) => {
    e.stopPropagation();
    toggleDropdown();

    document.querySelectorAll(".products-sort-order .dropdown-menu").forEach((drop) => {
      drop.style.display = "none"
    })
  });
  dropdownLi.addEventListener('mouseout', (e) => {
    e.stopPropagation();
    closeDropdown();
    document.querySelectorAll(".products-sort-order .dropdown-menu").forEach((drop) => {
      drop.style.removeProperty("display");
    })
  });

}

// Add event listener to close dropdown on clicks outside
document.addEventListener('click', (e) => {
  const isClickInsideDropdown = dropdownBrands.contains(e.target) || dropdownContent.contains(e.target);

  if (!isClickInsideDropdown) {
    closeDropdown();
  }
});

function toggleDropdown() {
  if (!dropdownContent.style.display || dropdownContent.style.display === "none") {
    dropdownContent.style.display = "flex";
    dropdownContent.style.flexWrap = "wrap";
  } else {
    closeDropdown();
  }
}

function closeDropdown() {
  dropdownContent.style.display = "none";
}

});


function openNavCarSpecs() {
  document.getElementById("sidenavCarSpecs").style.width = "20dvw";
  document.getElementById("sidenavCarSpecs").style.padding = "1rem .5rem";
  document.getElementById("sidenavCarSpecs").style.opacity = "1";

  if(window.screen.width >= 554){
    document.getElementById("sidenavCarSpecs").style.minWidth = "400px";
  }else{
    document.getElementById("sidenavCarSpecs").style.minWidth = "80dvw";
  }

  document.querySelector(".bg-sidenavCarSpecs").style.display = "block";

}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNavCarSpecs() {
  document.getElementById("sidenavCarSpecs").style.width = "0";
  document.getElementById("sidenavCarSpecs").style.padding = "1rem 0";
  document.getElementById("sidenavCarSpecs").style.opacity = "0";
  document.getElementById("sidenavCarSpecs").style.minWidth = "0";
  document.getElementById("main").style.marginLeft = "0";

  document.querySelector(".bg-sidenavCarSpecs").style.display = "none";
} 