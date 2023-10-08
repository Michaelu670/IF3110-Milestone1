document.getElementById("ewallet-detail").style.display = "none";
document.getElementById("card-detail").style.display = "none";
document.getElementById("cod-detail").style.display = "none";

// INPUTS
// BILLING INPUTS
const ewalletOption = document.getElementById("ewallet-detail");
const invis = document.getElementById("invis");
const cardOption = document.getElementById("card-detail");
const codOption = document.getElementById("cod-detail");
const ewalletInput = document.getElementById('ewallet-number');
const cardNumberInput = document.getElementById('card-number');
const cardExpInput = document.getElementById('card-exp');
const cardCVVInput = document.getElementById('card-cvv');
// ADDRESS INPUTS
// const addressForm = document.getElementById('address-details');
const phoneInput = document.getElementById('phone');
const provinceInput = document.getElementById('province');
const cityInput = document.getElementById('city');
const postalInput = document.getElementById('postal-code');
const addressInput = document.getElementById('full-address');

// ALERTS
// BILLING ALERTS
const paymentMethodAlert = document.getElementById('method-alert');
const ewalletAlert = document.getElementById('ewallet-alert');
const cardNumberAlert = document.getElementById('card-number-alert');
const cardExpAlert = document.getElementById('card-exp-alert');
const cardCVVAlert = document.getElementById('card-cvv-alert');
// ADDRESS ALERTS
const phoneAlert = document.getElementById('phone-alert');
const provinceAlert = document.getElementById('province-alert');
const cityAlert = document.getElementById('city-alert');
const postalAlert = document.getElementById('postal-alert');
const addressAlert = document.getElementById('fulladdress-alert');

const numberRegex = /^[0-9]+$/;
const alphabetOnlyRegex = /^[a-zA-Z ]+$/;
const usernameRegex = /^[a-zA-Z0-9]+$/;
const passwordRegex = /^[a-zA-Z0-9!@#$%^&*]+$/;
const fullnameRegex = /^[a-zA-Z ]+$/;

// VALIDATIONS
let paymentMethodValid = false;
let ewalletValid = false;
let cardNumberValid = false;
let cardExpValid = false;
let cardCVVValid = false;
let phoneValid = false;
let provinceValid = false;
let cityValid = false;
let postalValid = false;
let addressValid = false;
let allAddressValid = false;
let allBillingValid = false;

paymentChoice = "";

function openSection(option) {
    // Get all elements with class="tabcontent" and hide them
    document.getElementById("ewallet-detail").style.display = "none";
    document.getElementById("card-detail").style.display = "none";
    document.getElementById("cod-detail").style.display = "none";

    if(option=="ewallet-detail"){
        paymentChoice = "ewallet";
    }else if(option=="card-detail"){
        paymentChoice = "card";
    }else{
        paymentChoice = "cod";
    }

    document.getElementById(option).style.display = "flex";
    paymentMethodAlert.innerText = '';
    paymentMethodAlert.className = 'alert-hide';
    paymentMethodValid = true;
}

ewalletInput && ewalletInput.addEventListener('keyup',
    debounce(() => {
        const ewallet = ewalletInput.value;

        if(!numberRegex.test(ewallet)) {
            ewalletAlert.innerText = 'Invalid number';
            ewalletAlert.className = 'alert-show';
            ewalletValid = false;
        } else{
            ewalletAlert.innerText = '';
            ewalletAlert.className = 'alert-hide';
            ewalletValid = true;
        } 
    }, DEBOUNCE_TIMEOUT)
);

cardNumberInput && cardNumberInput.addEventListener('keyup',
    debounce(() => {
        const cardNumber = cardNumberInput.value;

        if(!numberRegex.test(cardNumber)) {
            cardNumberAlert.innerText = 'Invalid card number';
            cardNumberAlert.className = 'alert-show';
            cardNumberValid = false;
        } else{
            cardNumberAlert.innerText = '';
            cardNumberAlert.className = 'alert-hide';
            cardNumberValid = true;
        } 
    }, DEBOUNCE_TIMEOUT)
);

cardExpInput && cardExpInput.addEventListener('keyup',
    debounce(() => {
        const cardExp = cardExpInput.value;

        if(!numberRegex.test(cardExp)) {
            cardExpAlert.innerText = 'Invalid expiry';
            cardExpAlert.className = 'alert-show';
            cardExpValid = false;
        } else{
            cardExpAlert.innerText = '';
            cardExpAlert.className = 'alert-hide';
            cardExpValid = true;
        } 
    }, DEBOUNCE_TIMEOUT)
);

cardCVVInput && cardCVVInput.addEventListener('keyup',
    debounce(() => {
        const cardCVV = cardCVVInput.value;

        if(!numberRegex.test(cardCVV)) {
            cardCVVAlert.innerText = 'Invalid CVV';
            cardCVVAlert.className = 'alert-show';
            cardCVVValid = false;
        } else{
            cardCVVAlert.innerText = '';
            cardCVVAlert.className = 'alert-hide';
            cardCVVValid = true;
        } 
    }, DEBOUNCE_TIMEOUT)
);

//ADRESS VALIDATIONS
phoneInput && phoneInput.addEventListener('keyup',
    debounce(() => {
        const phone = phoneInput.value;

        if(!numberRegex.test(phone)) {
            phoneAlert.innerText = 'Invalid phone number';
            phoneAlert.className = 'alert-show';
            phoneValid = false;
        } else{
            phoneAlert.innerText = '';
            phoneAlert.className = 'alert-hide';
            phoneValid = true;
        } 
    }, DEBOUNCE_TIMEOUT)
);

provinceInput && provinceInput.addEventListener('keyup',
    debounce(() => {
        const province = provinceInput.value;

        if(!alphabetOnlyRegex.test(province)) {
            provinceAlert.innerText = 'Invalid province';
            provinceAlert.className = 'alert-show';
            provinceValid = false;
        } else{
            provinceAlert.innerText = '';
            provinceAlert.className = 'alert-hide';
            provinceValid = true;
        } 
    }, DEBOUNCE_TIMEOUT)
);

cityInput && cityInput.addEventListener('keyup',
    debounce(() => {
        const city = cityInput.value;

        if(!alphabetOnlyRegex.test(city)) {
            cityAlert.innerText = 'Invalid city';
            cityAlert.className = 'alert-show';
            provinceValid = false;
        } else{
            cityAlert.innerText = '';
            cityAlert.className = 'alert-hide';
            cityValid = true;
        } 
    }, DEBOUNCE_TIMEOUT)
);

postalInput && postalInput.addEventListener('keyup',
    debounce(() => {
        const postal = postalInput.value;

        if(!numberRegex.test(postal)) {
            postalAlert.innerText = 'Invalid postal code';
            postalAlert.className = 'alert-show';
            postalValid = false;
        } else{
            postalAlert.innerText = '';
            postalAlert.className = 'alert-hide';
            postalValid = true;
        } 
    }, DEBOUNCE_TIMEOUT)
);

addressInput && addressInput.addEventListener('keyup',
    debounce(() => {
        addressAlert.innerText = '';
        addressAlert.className = 'alert-hide';
        addressValid = true;
    }, DEBOUNCE_TIMEOUT)
);

mainForm && mainForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    console.log('first');
    const method = paymentChoice;
    const phone = phoneInput.value;
    const fulladdress = addressInput.value;
    
        // CHECK BILLING
        if(!paymentMethodValid)
        {
            e.preventDefault();
            paymentMethodAlert.innerText = 'Payment method is required';
            paymentMethodAlert.className = 'alert-show';
        }else
        {
            paymentMethodAlert.className = 'alert-hide';
        }
    
        if(method=="ewallet" && !ewalletValid)
        {
            e.preventDefault();
            ewalletAlert.innerText = 'Number is required';
            ewalletAlert.className = 'alert-show';
        }else
        {
            ewalletAlert.className = 'alert-hide';
        }
    
        if(method=="card" && !cardNumberValid)
        {
            e.preventDefault();
            cardNumberAlert.innerText = 'Card number is required';
            cardNumberAlert.className = 'alert-show';
        }else
        {
            cardNumberAlert.className = 'alert-hide';
        }
    
        if(method=="card" && !cardExpValid)
        {
            e.preventDefault();
            cardExpAlert.innerText = 'Card expiry is required';
            cardExpAlert.className = 'alert-show';
        }else
        {
            cardExpAlert.className = 'alert-hide';
        }
    
        if(method=="card" && !cardCVVValid)
        {
            e.preventDefault();
            cardCVVAlert.innerText = 'Card CVV is required';
            cardCVVAlert.className = 'alert-show';
        }else
        {
            cardCVVAlert.className = 'alert-hide';
        }
    
        //CHECK ADDRESS
        if(!phoneValid)
        {
            phoneAlert.innerText = 'Phone number is required';
            phoneAlert.className = 'alert-show';
        }else
        {
            provinceAlert.className = 'alert-hide';
        }
    
        if(!provinceValid)
        {
            e.preventDefault();
            provinceAlert.innerText = 'Province is required';
            provinceAlert.className = 'alert-show';
        }else
        {
            provinceAlert.className = 'alert-hide';
        }
    
        if(!cityValid)
        {
            e.preventDefault();
            cityAlert.innerText = 'City is required';
            cityAlert.className = 'alert-show';
        }else
        {
            cityAlert.className = 'alert-hide';
        }
    
        if(!postalValid)
        {
            e.preventDefault();
            postalAlert.innerText = 'Postal is required';
            postalAlert.className = 'alert-show';
        }else
        {
            postalAlert.className = 'alert-hide';
        }
    
        if(!addressValid)
        {
            e.preventDefault();
            addressAlert.innerText = 'Address is required';
            addressAlert.className = 'alert-show';
        }else
        {
            addressAlert.className = 'alert-hide';
        }
    
        if (!paymentMethodValid || (!(method=="ewallet" && ewalletValid) && !(method=="card" && cardNumberValid && cardExpValid && cardCVVValid)))
        {
            return;
        }else{
            allBillingValid = true;
        }
        // console.log(method);
    
        if (!phoneValid || !provinceValid || !cityValid || !postalValid || !addressValid)
        {
            return;
        }else{
            allAddressValid = true;
        }
    
    
        if(!allAddressValid || !allBillingValid){
            return;
        }
    
        
        // popupWindow.style.display = "block";
        // closeButton.addEventListener("click", function() {
        //     popupWindow.style.display = "none";
        // });
    
        const xhr = new XMLHttpRequest();
        xhr.open('POST','/public/checkout');
        const formData = new FormData();
        formData.append('payment_method', method);
        formData.append('recipient_phone_number', phone);
        formData.append('delivery_address', fulladdress);
        formData.append('csrf_token', CSRF_TOKEN);
        console.log('data sent!');
        xhr.send(formData);
        xhr.onreadystatechange = function () {
            if(this.readyState === XMLHttpRequest.DONE)
            {
                console.log('Response status:', this.status);
                console.log('Response text:', this.responseText);
                if(this.status === 201)
                {
                    // document.querySelector('#register-alert').className = 'alert-hide';
                    const data = JSON.parse(this.responseText);
                    location.replace(data.redirect_url);
                }else
                {
                    // document.querySelector('#register-alert').className = 'alert-show';
                    alert('Something went wrong, please try again!');
                }
            }
        };
});

// async function CheckoutClick(){
//         const method = paymentChoice;
//         const phone = phoneInput.value;
//         const fulladdress = addressInput.value;
    
//         // CHECK BILLING
//         if(!paymentMethodValid)
//         {
//             // e.preventDefault();
//             paymentMethodAlert.innerText = 'Payment method is required';
//             paymentMethodAlert.className = 'alert-show';
//         }else
//         {
//             paymentMethodAlert.className = 'alert-hide';
//         }
    
//         if(method=="ewallet" && !ewalletValid)
//         {
//             // e.preventDefault();
//             ewalletAlert.innerText = 'Number is required';
//             ewalletAlert.className = 'alert-show';
//         }else
//         {
//             ewalletAlert.className = 'alert-hide';
//         }
    
//         if(method=="card" && !cardNumberValid)
//         {
//             // e.preventDefault();
//             cardNumberAlert.innerText = 'Card number is required';
//             cardNumberAlert.className = 'alert-show';
//         }else
//         {
//             cardNumberAlert.className = 'alert-hide';
//         }
    
//         if(method=="card" && !cardExpValid)
//         {
//             // e.preventDefault();
//             cardExpAlert.innerText = 'Card expiry is required';
//             cardExpAlert.className = 'alert-show';
//         }else
//         {
//             cardExpAlert.className = 'alert-hide';
//         }
    
//         if(method=="card" && !cardCVVValid)
//         {
//             // e.preventDefault();
//             cardCVVAlert.innerText = 'Card CVV is required';
//             cardCVVAlert.className = 'alert-show';
//         }else
//         {
//             cardCVVAlert.className = 'alert-hide';
//         }
    
//         //CHECK ADDRESS
//         if(!phoneValid)
//         {
//             phoneAlert.innerText = 'Phone number is required';
//             phoneAlert.className = 'alert-show';
//         }else
//         {
//             provinceAlert.className = 'alert-hide';
//         }
    
//         if(!provinceValid)
//         {
//             // e.preventDefault();
//             provinceAlert.innerText = 'Province is required';
//             provinceAlert.className = 'alert-show';
//         }else
//         {
//             provinceAlert.className = 'alert-hide';
//         }
    
//         if(!cityValid)
//         {
//             // e.preventDefault();
//             cityAlert.innerText = 'City is required';
//             cityAlert.className = 'alert-show';
//         }else
//         {
//             cityAlert.className = 'alert-hide';
//         }
    
//         if(!postalValid)
//         {
//             // e.preventDefault();
//             postalAlert.innerText = 'Postal is required';
//             postalAlert.className = 'alert-show';
//         }else
//         {
//             postalAlert.className = 'alert-hide';
//         }
    
//         if(!addressValid)
//         {
//             // e.preventDefault();
//             addressAlert.innerText = 'Address is required';
//             addressAlert.className = 'alert-show';
//         }else
//         {
//             addressAlert.className = 'alert-hide';
//         }
    
//         if (!paymentMethodValid || (!(method=="ewallet" && ewalletValid) && !(method=="card" && cardNumberValid && cardExpValid && cardCVVValid)))
//         {
//             return;
//         }else{
//             allBillingValid = true;
//         }
//         // console.log(method);
    
//         if (!phoneValid || !provinceValid || !cityValid || !postalValid || !addressValid)
//         {
//             return;
//         }else{
//             allAddressValid = true;
//         }
    
    
//         if(!allAddressValid || !allBillingValid){
//             return;
//         }
    
        
//         // popupWindow.style.display = "block";
//         // closeButton.addEventListener("click", function() {
//         //     popupWindow.style.display = "none";
//         // });
    
//         const xhr = new XMLHttpRequest();
//         xhr.open('POST','/public/checkout');
//         const formData = new FormData();
//         formData.append('payment_method', method);
//         formData.append('recipient_phone_number', phone);
//         formData.append('delivery_address', fulladdress);
//         formData.append('csrf_token', CSRF_TOKEN);
//         console.log('data sent!');
//         xhr.send(formData);
//         xhr.onreadystatechange = function () {
//             if(this.readyState === XMLHttpRequest.DONE)
//             {
//                 console.log('Response status:', this.status);
//                 console.log('Response text:', this.responseText);
//                 if(this.status === 201)
//                 {
//                     // document.querySelector('#register-alert').className = 'alert-hide';
//                     const data = JSON.parse(this.responseText);
//                     location.replace(data.redirect_url);
//                 }else
//                 {
//                     // document.querySelector('#register-alert').className = 'alert-show';
//                     alert('Something went wrong, please try again!');
//                 }
//             }
//         };
// }
