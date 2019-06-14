let dateOfDeath = document.querySelectorAll('.dateOfDeath');
let placeOfDeath = document.querySelectorAll('.placeOfDeath');
let dateOfDeathDiv = document.querySelectorAll('.dateOfDeathDiv');
let placeOfDeathDiv = document.querySelectorAll('.placeOfDeathDiv');

dateOfDeath.forEach((date) => {
    if(date.innerHTML = ''){
        dateOfDeathDiv.innerHTML = '';
    }
})