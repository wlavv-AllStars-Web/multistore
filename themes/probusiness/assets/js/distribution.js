document.addEventListener('DOMContentLoaded', function () {
    const careerBtns = document.querySelectorAll("#why_us_anchor .card_view_more")
    const profileBtns = document.querySelectorAll(".profile_container_cms .card_view_more")

    if(window.screen.width <= 768){
        const formdeliveryaddress = document.querySelector("#delivery-addresses")
        const parentDiv = document.querySelector('.form-group.typeofshipping.flex');
        const checkboxPickup = document.querySelector('.checkbox-pickup');

        if(formdeliveryaddress){
            parentDiv.insertBefore(formdeliveryaddress, checkboxPickup);
        }
    }
    
    
    if(careerBtns){
        careerBtns.forEach(item => {
            item.addEventListener("click", viewMore)
        })
    }
    if(profileBtns){
        profileBtns.forEach(item => {
            item.addEventListener("click", viewMore)
        })
    }
    
    
});

function onchangecountry(event) {
        // Get the selected value
        const selectedValue = event.target.value;
    
        // Check if the selected value is 229
        if (selectedValue == "243" || selectedValue == "244") {
            document.querySelector(".shipping_address .dni-input").style.display = "block"
            // document.querySelector(".shipping_address .dni-input").setAttribute("required","required")
        }else{
            document.querySelector(".shipping_address .dni-input").style.display = "none"
        }
}





function viewMore(event){
    
    const lang = document.querySelector("html").getAttribute("lang");
    const button = event.target; 

    let translateMore = '';
    let translateLess = '';

    if(lang === "en"){
        translateMore = "VIEW MORE";
        translateLess = "VIEW LESS";
    }else if(lang === "pt"){
        translateMore = "VER MAIS";
        translateLess = "VER MENOS";
    }else if(lang === "fr"){
        translateMore = "VOIR PLUS";
        translateLess = "VOIR MOINS";
    }else if(lang === "es"){
        translateMore = "VER MÁS";
        translateLess = "VER MENOS";
    }else if(lang === "it"){
        translateMore = "VEDI ALTRO";
        translateLess = "VISUALIZZA MENO";
    }
    
    if (button.innerText === "VIEW LESS" ||button.innerText === "VER MENOS" ||button.innerText === "VOIR MOINS" ||button.innerText === "VISUALIZZA MENO" ) {
        
        button.innerText = translateMore;
        const dataElement = button.previousElementSibling;
        dataElement.classList.remove("active_card");
    } else {
        
        const card_texts = document.querySelectorAll(".card_text");
        card_texts.forEach((item) => {
            if (item.classList.contains("active_card")) {
                item.classList.remove("active_card");
                item.nextElementSibling.innerText = "VIEW MORE";
            }
        });

        button.innerText = translateLess;
        const dataElement = button.previousElementSibling;
        dataElement.classList.add("active_card");
    }
    
    
}

function anchorLink(e) {
    e.preventDefault();
}

// Wrap the entire script in a function
function moveQuantityInput() {


    // Find the #quantity_wanted input element
    var quantityInput = document.querySelector('#product #quantity_wanted');
    
    // Find the .input-group-btn-vertical element
    var inputGroupVertical = document.querySelector('#product .input-group-btn-vertical');
    
    // Check if inputGroupVertical is null
    if (inputGroupVertical === null) {
        // If inputGroupVertical is null, retry after a short delay
        setTimeout(moveQuantityInput, 100);
        return; // Exit the function early
    }
    
    // Get the buttons within inputGroupVertical
    var buttons = inputGroupVertical.querySelectorAll('button');
    
    // Append the quantityInput between the buttons in inputGroupVertical
    if(quantityInput && inputGroupVertical){
        inputGroupVertical.insertBefore(quantityInput, buttons[1]);
    }

    if (buttons.length >= 2) {
        // First button
        var firstIcon = buttons[0].querySelector('i');
        if (firstIcon) {
            firstIcon.classList.remove('material-icons','touchspin-up');
            firstIcon.classList.add('fa-solid','fa-plus');
        }


        // Second button
        var secondIcon = buttons[1].querySelector('i');
        if (secondIcon) {
            secondIcon.classList.remove('material-icons','touchspin-down');
            secondIcon.classList.add('fa-solid','fa-minus');
        }
    }

}

// Call the function when DOM content is loaded
document.addEventListener("DOMContentLoaded", moveQuantityInput);

// function addInputBootstrap(){
//     var newHtml = '<div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input type="number" name="qty" id="quantity_wanted" inputmode="numeric" pattern="[0-9]*" value="1" min="1" class="input-group form-control" aria-label="Quantity" style="display: block;"><span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span><span class="input-group-btn-vertical"><button class="btn btn-touchspin js-touchspin bootstrap-touchspin-up" type="button"><i class="material-icons touchspin-up"></i></button><button class="btn btn-touchspin js-touchspin bootstrap-touchspin-down" type="button"><i class="material-icons touchspin-down"></i></button></span></div>';

//     var elements = document.querySelectorAll('.qty');
//     elements.forEach(function(element) {
//         element.innerHTML = '';
//         element.innerHTML = newHtml;
//     });
    


// }

// document.addEventListener("DOMContentLoaded", addInputBootstrap);
// document.addEventListener('DOMContentLoaded', function () {

//     document.addEventListener('click', function (event) {
//         if (event.target.classList.contains('plus')) {
//             var countInput = event.target.closest('.qty').querySelector('.count');
//             countInput.value = parseInt(countInput.value) + 1;
//         }

//         if (event.target.classList.contains('minus')) {
//             var countInput = event.target.closest('.qty').querySelector('.count');
//             countInput.value = parseInt(countInput.value) - 1;
//             if (parseInt(countInput.value) === 0) {
//                 countInput.value = 1;
//             }
//         }
//     });

// });


// document.addEventListener('DOMContentLoaded', function () {

//     // Event listener for the plus button
//     document.addEventListener('click', function (event) {
//         if (event.target.classList.contains('plus') || event.target.classList.contains('minus')) {
//             var countInput = event.target.closest('.product-quantity').querySelector('.product-quantity-input');
//             var currentValue = parseInt(countInput.value);
//             var minValue = parseInt(countInput.min);
//             var maxValue = parseInt(countInput.max);

//             if (event.target.classList.contains('plus') && currentValue < maxValue) {
//                 countInput.value = currentValue + 1;
//             }

//             if (event.target.classList.contains('minus') && currentValue > minValue) {
//                 countInput.value = currentValue - 1;
//             }

//             // Update the value attribute explicitly if needed
//             countInput.setAttribute('value', countInput.value);
//             console.log("Updated Value: ", countInput.value);
//         }
//     });

// //     // Event listener for the add to cart button
// //     document.querySelectorAll('.add-to-cart').forEach(function(button) {
// //         button.addEventListener('click', function() {
// //             var productId = this.dataset.idProduct;
// //             var quantityInput = this.closest('.product-quantity').querySelector('.product-quantity-input');
// //             var quantity = quantityInput.value;

// //             // Call the add to cart function with the specified quantity
// //             addToCart(productId, quantity);
// //         });
// //     });

// //     // Function to handle adding to cart
// //     // function addToCart(productId, quantity) {
// //     //     var formData = new FormData();
// //     //     formData.append('id_product', productId);
// //     //     formData.append('quantity', quantity);

// //     //     fetch('/order', {
// //     //         method: 'POST',
// //     //         body: formData
// //     //     }).then(response => response.json()).then(data => {
// //     //         if (data.success) {
// //     //             alert('Product added to cart!');
// //     //             // Update cart display, etc.
// //     //         } else {
// //     //             alert('Error adding product to cart.');
// //     //         }
// //     //     }).catch(error => {
// //     //         console.error('Error:', error);
// //     //     });
// //     // }

// // });
// form dealer



// function validateForm() {
        
//     var empty = $(".form-become-dealer").find('input[required]').filter(function() {
//         return this.value == '';
//     });
    
//     if (empty.length) {
//         $(".form-become-dealer").find('input[required]').css('border', '1px solid red');
//         alert("{$fill_all}");
//         return false;
//     }
        
        
//     let error = 0;
//     let site = $('#site').val();
//     let social = $('#social').val();
//     let business_type = document.querySelectorAll('input[name="business_type[]"]:checked').length;
//     let main_market   = document.querySelectorAll('input[name="main_market[]"]:checked').length;

//     if( ($('#site').val() == '') && ($('#social').val() == '')){
//         alert("{$error_1}"); 
//         error = 1;
//     }
    
//     if(business_type == 0){
//         alert("{$error_2}"); 
//         error = 1;
//     }
    
//     if(main_market == 0){
//         alert("{$error_3}"); 
//         error = 1;
//     } 
    
//     if(!ValidateEmail()){
//         error = 1;
//     }
    
//     if((site != '') && (!ValidateURL(1))){
//         error = 1;
//     } 
    
//     if((social != '') && (!ValidateURL(2))){
//         error = 1;
//     } 
    
//     if(error == 0){
//         $('.form-become-dealer').submit();
//     }else{
//         return false;
//     }

// } 

function ValidateEmail() {

    let message = "{$error_4}";
    const validatorString = "^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$";
    
    if($('#email').val().indexOf(' ') >= 0){
        alert(message);
        return (false);
    }
    
    if ( !validatorString.test($('#email').val()) ){
        alert(message);
        return (false); 
    }
    
    return true;
}

// function ValidateURL(tipoURL) {

//     let message = "{$error_6}";
//     if(tipoURL == 1) message = "{$error_5}";
    
//     let url = $('#social').val();
//     if(tipoURL == 1) url = $('#site').val();
      
//     if(url.indexOf(' ') >= 0){
//         alert(message);
//         return (false);
//     } 
//     var validatorString = /((http|https)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?\:@\-_=#])*/g;

//     if ( validatorString.test(url) ){
//         return (true);
//     }else{
//         alert(message);
//         return (false);        
//     }
// }


// Select all input elements within the #checkout div
var inputs = document.querySelectorAll('#checkout input');

// Loop through each input element and add the keydown event listener
inputs.forEach(function(input) {
    input.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            return false; // Explicitly return false to stop any other handlers
        }
    });
});


function selectcheckbox(e) {
    const hiddencheckbox = e.querySelector("input");
    const selectcheckbox = e.querySelector("i");

    // Uncheck all other checkboxes when this one is checked
    const allCheckboxes = document.querySelectorAll(".typeofshipping input[type='checkbox']");
    const allIcons = document.querySelectorAll(".typeofshipping i");

    // If the current checkbox is already checked, uncheck it and reset its icon
    if (hiddencheckbox.checked) {
        hiddencheckbox.checked = false; // Uncheck the current checkbox
        selectcheckbox.classList.remove("fa-square-check"); // Remove the checked icon
        selectcheckbox.classList.add("fa-square"); // Add the unchecked icon
    } else {
        // Uncheck all checkboxes and reset their icons first
        allCheckboxes.forEach((checkbox, index) => {
            checkbox.checked = false; // Uncheck all
            allIcons[index].classList.remove("fa-square-check"); // Remove checked icon
            allIcons[index].classList.add("fa-square"); // Add unchecked icon
        });

        // Check the clicked checkbox and update its icon
        hiddencheckbox.checked = true; // Set this checkbox as checked
        selectcheckbox.classList.remove("fa-square");
        selectcheckbox.classList.add("fa-square-check");
    }
}






// function changecheckicon(e){
//  if(e.classList.contains("fa-square")){
//     e.classList.remove("fa-square")
//     e.classList.add("fa-square-check")
//  }else{
//     e.classList.remove("fa-square-check")
//     e.classList.add("fa-square")
//  }
// }

// function clicklabelcheck(e) {
//     const square = document.querySelectorAll(".typeofshipping  .fa-square-check")
//     if(square){
//         square.forEach((item) => {
//             item.classList.remove("fa-square-check")
//             item.classList.add("fa-square")
//         })
//     }
//     e.parentElement.querySelector("i").click();
// }

// function clicklabelterms(e) {
//     e.parentElement.querySelector("i").click();
// }




function openShippingtab(url,shipping){
    const modifiedUrl = `${url}?tab=${shipping}`;
    window.location.href = modifiedUrl;

    // add login of wait for page load here
}


function toggleAddress(e) {
    const checkbox = e.checked;
    document.getElementById("form_deliver_address").style.display = checkbox === true ? "block" : "none";
}
function togglePayment(e) {
    const checkbox = e.checked;
    document.getElementById("payment_checkout").style.display = checkbox === true ? "block" : "none";
}


function expandText(e) {
    
    e.previousElementSibling.classList.toggle("expandText")

    const lang = document.querySelector("html").getAttribute("lang");
    const button = e; 

    let translateMore = '';
    let translateLess = '';

    if(lang === "en"){
        translateMore = "VIEW MORE";
        translateLess = "VIEW LESS";
    }else if(lang === "pt"){
        translateMore = "VER MAIS";
        translateLess = "VER MENOS";
    }else if(lang === "fr"){
        translateMore = "VOIR PLUS";
        translateLess = "VOIR MOINS";
    }else if(lang === "es"){
        translateMore = "VER MÁS";
        translateLess = "VER MENOS";
    }else if(lang === "it"){
        translateMore = "VEDI ALTRO";
        translateLess = "VISUALIZZA MENO";
    }

    if (button.innerText === "VIEW LESS" ||button.innerText === "VER MENOS" ||button.innerText === "VOIR MOINS" ||button.innerText === "VISUALIZZA MENO" ) {
        
        button.innerText = translateMore;
        
        
    } else {
        button.innerText = translateLess;
        
    }
}