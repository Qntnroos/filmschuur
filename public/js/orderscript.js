const normalPrice = parseInt(document.querySelector('#normalPrice').innerHTML);
const reducedPrice = parseInt(document.querySelector('#reducedPrice').innerHTML);
const parkingPrice = parseFloat(document.querySelector('#parkingPrice').innerHTML);
const totalPrice = document.querySelector('#totalPrice');
const normalCount = document.querySelector('#normalCount');
const reducedCount = document.querySelector('#reducedCount');
const selector = document.querySelectorAll('select');
const selectorTickets = document.querySelectorAll('.price');
const parkingDiv = document.querySelector('.parking');
const parking = document.querySelector('#parking');
const ticketAmount = document.querySelector('#ticketAmount');
let result;


selectorTickets.forEach((select) => {
select.addEventListener("change",  function() {
    if(normalCount.value != 0 || reducedCount.value != 0){
        parkingDiv.classList.remove('hideDiv');
        parkingDiv.classList.add('showDiv');
    } else{
        parkingDiv.classList.remove('showDiv');
        parkingDiv.classList.add('hideDiv');
    }
    ticketAmount.innerHTML = parseInt(normalCount.value) + parseInt(reducedCount.value);
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