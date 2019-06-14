const orderButton = document.querySelector('.orderbutton');
const form = document.querySelector('.overview-form');

form.addEventListener("change", function() {
    if(form.value != 0){
        orderButton.classList.remove('hide');
        orderButton.classList.add('show');
    } else{
        orderButton.classList.remove('show');
        orderButton.classList.add('hide');       
    }
});