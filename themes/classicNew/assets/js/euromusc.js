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

function toggleOrderStateHistory() {
  document.querySelector(".order-state-history").classList.toggle("show-state")
}


// menu brands

document.addEventListener('DOMContentLoaded', function () {
  const dropdownLi = document.querySelector(".mainmenuDesktop .dropdown.brands-drop");
  const dropdownBrands = document.querySelector("a.dropdown-toggle-brands");
  const dropdownContent = document.querySelector("ul.dropdown-content");

  let isDropdownBrandsOpen = false; 

  dropdownBrands.addEventListener('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    console.log("click brands");
    toggleDropdown();
  });

  if (window.screen.width > 1200) {
    dropdownLi.addEventListener('mouseover', (e) => {
      e.stopPropagation();
      openDropdown();

      document.querySelectorAll(".products-sort-order .dropdown-menu").forEach((drop) => {
        drop.style.display = "none";
      });
    });

    dropdownLi.addEventListener('mouseout', (e) => {
      e.stopPropagation();
      closeDropdown();

      document.querySelectorAll(".products-sort-order .dropdown-menu").forEach((drop) => {
        drop.style.removeProperty("display");
      });
    });
  }


  document.addEventListener('click', (e) => {
    setTimeout(() => {
      if (!isDropdownBrandsOpen) return; // Only check if dropdown is open

      const isClickInsideDropdown = dropdownBrands.contains(e.target) || dropdownContent.contains(e.target);

      if (!isClickInsideDropdown) {
        console.log("click outside, closing");
        closeDropdown();
      }
    }, 0);
  });

  function toggleDropdown() {
    if (isDropdownBrandsOpen) {
      console.log("close");
      closeDropdown();
    } else {
      console.log("open");
      openDropdown();
    }
  }

  function openDropdown() {
    dropdownLi.classList.add('open');
    isDropdownBrandsOpen = true;
  }

  function closeDropdown() {
    dropdownLi.classList.remove('open');
    isDropdownBrandsOpen = false;
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


var Swipes2 = new Swiper('.products-mobile', {
  slidesPerView: 1,
  spaceBetween: 30,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    564: {
      slidesPerView: 2,
      spaceBetween: 20
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 20
    },
    992: {
      slidesPerView: 4,
      spaceBetween: 30
    }
  },
  pagination: {
    // el: ".swiper-pagination",
    clickable: true,
  },
});

var swiper = new Swiper(".swiperCars", {
  slidesPerView: 1,
  spaceBetween: 30,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  lazy: {
    loadPrevNext: true,
    loadOnTransitionStart: true,
  },
  breakpoints: {
    640: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 40,
    },
    900: {
      slidesPerView: 3,
      spaceBetween: 50,
    },
    1200: {
      slidesPerView: 4,
      spaceBetween: 50,
    },
    1550: {
      slidesPerView: 5,
      spaceBetween: 50,
    },
  },
});

function initSwiper() {
  var swiper2 = new Swiper(".mySwiper-thumb-images", {
    direction: "vertical",
    slidesPerView: 5,
    spaceBetween: 10,
    mousewheel: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  var swiperMagnify = new Swiper(".mySwiper-modal-product-images", {
    pagination: {
      el: ".swiper-pagination",
      type: "fraction",
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
  
}

var swiper3 = new Swiper(".mySwiper", {
  slidesPerView: 1,
  spaceBetween: 30,
  direction: "horizontal",
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },
});


function closeModalProductImages() {
  document.querySelector("#product-modal").style.display="none"
  document.querySelector(".modal-backdrop").remove()
  document.querySelector("#product").classList.remove("modal-open")
  document.querySelector("#product").style.padding = "0";
}