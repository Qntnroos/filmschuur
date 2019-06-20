const normalPrice = parseFloat(document.querySelector('#normalPrice').innerHTML);
const reducedPrice = parseFloat(document.querySelector('#reducedPrice').innerHTML);
const parkingPrice = parseFloat(document.querySelector('#parkingPrice').innerHTML);
const totalPrice = document.querySelector('#totalPrice');
const normalCount = document.querySelector('#normalCount');
const reducedCount = document.querySelector('#reducedCount');
const selector = document.querySelectorAll('select');
const selectorTickets = document.querySelectorAll('.price');
const parkingDiv = document.querySelector('.parking');
const parking = document.querySelector('#parking');
const ticketAmount = document.querySelector('#ticketAmount');
const nextButton = document.querySelector('.order-button')
let result;


selectorTickets.forEach((select) => {
select.addEventListener("change",  function() {
    if(normalCount.value != 0 || reducedCount.value != 0){
        parkingDiv.classList.remove('hideDiv');
        parkingDiv.classList.add('showDiv');

        nextButton.classList.remove('hideDiv');
        nextButton.classList.add('showDiv');
    } else{
        parkingDiv.classList.remove('showDiv');
        parkingDiv.classList.add('hideDiv');

        nextButton.classList.remove('showDiv');
        nextButton.classList.add('hideDiv');
    }
    ticketAmount.value = parseInt(normalCount.value) + parseInt(reducedCount.value);
    result = normalCount.value * normalPrice + reducedCount.value * reducedPrice;
    totalPrice.innerHTML = '€ ' + result;
})});

selector.forEach((select) => {
    select.addEventListener('change',  function() {
        if(parking.value != 0){
            result += parkingPrice;
        }
        totalPrice.innerHTML = '€ ' + result;
})});
parking.addEventListener('change',function(){
    if(parking.value == 0){
        result -= parkingPrice;
    }
    totalPrice.innerHTML = '€ ' + result;
})