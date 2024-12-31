

var Swipes = new Swiper('.swiper-container', {
    loop: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination',
    },
    autoplay: {
        delay: 5000,
    },
});

var Swipes2 = new Swiper('.products-mobile', {
  slidesPerView: 1,
  spaceBetween: 30,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoint: {
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

document.addEventListener("DOMContentLoaded", (event) => {
  if(document.querySelector('.videosContainer')){
  const videosContainer = Array.from(document.querySelector('.videosContainer').children);

  videosContainer.forEach((item) => {
    const img = item.querySelector('.play img');
    if (img) {
      item.addEventListener('mouseover', () => {
        img.setAttribute('src', "/img/youtube_play_hover.png")
      });
      item.addEventListener('mouseleave', () => {
        img.setAttribute('src', "/img/youtube_play.png")
      });
    }
  });

  if (window.screen.width < 768) {
    videosContainer.forEach((item) => {
      const img = item.querySelector('.play img');
      if (img) {
        img.setAttribute("src", "/img/youtube_play_hover.png")
      }
    })
  }

  }



  // btn wheels

  const wheelsBtn = document.querySelector(".wheels-btn")

  if(wheelsBtn){
    wheelsBtn.addEventListener("click", async (e) => {

      const title = document.getElementById('wheels-title');
      title.textContent = "SELECT YOUR WHEELS";

      const image = document.getElementById('wheels-image');
      if (image) {
        image.classList.add('fade-out');
        image.addEventListener('animationend', function() {
          image.remove(); 
        });
      }

      wheelsBtn.querySelector("span").textContent = "Filter"

      try {
        const response = await fetch(
          `${window.location.href}?ajax=1&action=getWheelsTemplate`
        );
        if (!response.ok) {
          throw new Error('Failed to fetch the template');
        }
        const jsonResponse = await response.json(); // Parse JSON response

        if (jsonResponse.success) {
          const article = document.getElementById("banner-wheels");
          const wheelsSelectors = document.querySelector(".wheels-selectors");

          // Set the parsed template content as HTML
          wheelsSelectors.innerHTML = jsonResponse.template;
        } else {
          console.error("Template loading error:", jsonResponse.message);
        }
      } catch (error) {
        console.error('Error fetching the template:', error);
      }
    })
  }

});
  


// user help

const cards = document.querySelectorAll(".card-user")

if(cards){
  cards.forEach(element => {
      const cardImg = element.querySelector('.play img')
      element.addEventListener('mouseover', () => {
          cardImg.setAttribute("src", "https://www.allstarsmotorsport.com/img/youtube_play_hover.png")
      })
      element.addEventListener('mouseout', () => {
          cardImg.setAttribute("src", "https://www.allstarsmotorsport.com/img/youtube_play.png")
      })
  });
}

const elementsToclick = document.querySelectorAll('.element-to-click')

if(elementsToclick){
    elementsToclick.forEach(element  => {
        element.addEventListener('click', () => {
            element.nextElementSibling.classList.add("show");
            element.style.display='none';
        })
    })
}

// show socials footer

function showSocials(e){
  const socials = e.parentElement.nextElementSibling
  socials.classList.toggle("show");
}

function dropdownFlags() {
  const flags = document.querySelector(".menu-languageselector-mobile")
  flags.classList.toggle("showLang")
}

function toggleMyaccountLogin(){
  const containerLoginMobile = document.querySelector(".menu-login-mobile")
  containerLoginMobile.classList.toggle("showLogin")
}


function dropdownLogos(e){
  
}


// dropdown brands
const dropdownLi = document.querySelector(".list-menu-desktop li.dropdown.brands-drop")
const dropdownBrands = document.querySelector('li .dropdown-toggle-brands');
// const dropdownBrandsCaret = document.querySelector('li.dropdown i');
const dropdownContent = document.querySelector('ul.dropdown-menu-brands');

dropdownBrands.addEventListener('click', (e) => {
  e.stopPropagation();
  toggleDropdown();
});

if(window.screen.width > 767){
  dropdownLi.addEventListener('mouseover', (e) => {
    e.stopPropagation();
    toggleDropdown();
  });
  dropdownLi.addEventListener('mouseout', (e) => {
    e.stopPropagation();
    closeDropdown();
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


// mobile

const contentBrands = document.querySelector('.content_brands');
const btnBrandsMobile = document.querySelector('.btn-brandsMobile')

if(btnBrandsMobile && contentBrands){
  btnBrandsMobile.addEventListener('click', () => {
    btnBrandsMobile.classList.toggle('activeBtnBrands')
    contentBrands.classList.toggle("showBrands")
  })
}

function dropdownSearch(){
  const search = document.querySelector(".menu-searchbar")
  search.style.display = search.style.display === 'none' ? 'flex' : 'none'
  document.querySelector(".menu-searchbar #searchbar input[name='s']").focus({ focusVisible: true });
}


function toggleFilters() {
  const filters = document.querySelector("#js-product-list-top")

  filters.classList.toggle("show-filters")
}

function toggleMenuCars(e){
  const menuCars = document.querySelector(".bannersHomeMobile #ukoocompat_search_block_1");
  menuCars.classList.toggle("show-menu-cars")
}

function hoverCart(e) {
  console.log(e)
  const cartModalTop = e.querySelector(".cart-hover-content")
  cartModalTop.classList.toggle("show-cart-top-modal")
}

function changeImgComments() {
  const img = document.querySelector("#product_reviews.desktop #empty-product-comment #new_comment_tab_btn_ img")
  img.style.cursor = "pointer";
  if(img.getAttribute("src") === "/img/asm/click.png"){
    img.setAttribute("src","/img/asm/clickw.png")
  }else{
    img.setAttribute("src","/img/asm/click.png")
  }
}

function toggleFooter(e) {
  const target = e.getAttribute("data-target")
  document.querySelector("footer #footer_sub_menu_4").classList.toggle("collapse")
}

// function setImageCover(e){
//   const srcImg = e.getAttribute("src")
//   console.log(srcImg)
//   document.querySelector(".js-qv-product-cover").setAttribute("src", `${srcImg}`)
// }

function closeQuestionBuble() {
  const bubleQuestion = document.querySelector(".container_ask_successfull")

  bubleQuestion.style.display = "none";
}

function toggleOrderStateHistory() {
  document.querySelector(".order-state-history").classList.toggle("show-state")
}

