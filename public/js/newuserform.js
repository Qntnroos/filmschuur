let firstnameinput = document.querySelector("#user_registration_form_user_firstname");
let firstnameerrorText = document.querySelector(".errorfirstname");
let lastnameinput = document.querySelector("#user_registration_form_user_lastname");
let lastnameerrorText = document.querySelector(".errorlastname");

let emailinput = document.querySelector("#user_registration_form_email_first");
let emailinput2 = document.querySelector("#user_registration_form_email_second");
let emailerrorText = document.querySelector(".errorEmail");
let emailerrorText2 = document.querySelector(".errorEmail2");
let emailCompareErrorText = document.querySelector (".errorCompare");

let passwordinput = document.querySelector("#user_registration_form_plainPassword_first");
let passwordinput2 = document.querySelector("#user_registration_form_plainPassword_second");
let passworderrorText = document.querySelector(".errorPassword");
let passworderrorText2 = document.querySelector(".errorPassword2");
let passwordCompareErrorText = document.querySelector (".errorPasswordCompare");

let adressinput = document.querySelector("#user_registration_form_user_adress");
let adresserrorText = document.querySelector(".erroradress");

/* let postalnumberinput = document.querySelector("#postalnumber");
let postalnumbererrorText = document.querySelector(".errorpostalnumber"); */

let phoneinput = document.querySelector("#user_registration_form_phone");
let phoneerrorText = document.querySelector(".errorphone");

let errorBackEndText = document.querySelector(".form-error-message, .form-error-icon")

let logbutton = document.querySelector("#regbutton");


/*regex functions*/
function regfirstandlastnameCheck(nameCheck) {
    let nameRegex = /^[a-zA-Zàâçéèêëîïôûùüÿñæœ /'-]{2,}$/;
    return (nameRegex.test(nameCheck));
}

function regpasswordCheck(passwordCheck) {
    let passwordRegex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,13}$/;
    return (passwordRegex.test(passwordCheck));
}

function regmailCheck(mailCheck) {
    let emailRegex = /^(([\-\w]+)\.?)+@(([\-\w]+)\.?)+\.[a-zA-Z]{2,6}$/;
    return (emailRegex.test(mailCheck));
}

function regpostalnumberCheck(postalnumberCheck) {
    let postalnumberRegex = /^(?:(?:[1-9])(?:\d{3}))$/;
    return (postalnumberRegex.test(postalnumberCheck));
}

function regadressCheck(adressCheck) {
    let adressRegex = /^([1-9][e][\s])*([a-zA-Zàâçéèêëîïôûùüÿñ\- /']+(([.][\s])?|([\s]))?)+[1-9][0-9]*(([-]|[\/][1-9][[0-9]*)|([\s]?[a-zA-Z 1-9]+))?$/;
    return (adressRegex.test(adressCheck));
}

function regphoneCheck(phoneCheck) {
    let phoneRegex = /^0\d{1}[ ]\d{3}[ ]\d{2}[ ]\d{2}|0\d{3}[ ]\d{2}[ ]\d{2}[ ]\d{2}|0\d{2}[ ]\d{2}[ ]\d{2}[ ]\d{2}$/;
    return (phoneRegex.test(phoneCheck));
}

/*verwijder foutbootschappen*/

function removeErrorTextFirstname() {
    firstnameerrorText.style.display ="none";
}

function removeErrorTextLastname() {
    lastnameerrorText.style.display ="none";
}

function removeErrorTextMail() {
    emailerrorText.style.display ="none";
}

function removeErrorTextMail2() {
    emailerrorText2.style.display ="none";
}

function removeErrorTextMailCompare() {
    emailCompareErrorText.style.display ="none";
}

function removeErrorTextPassword() {
    passworderrorText.style.display="none";
}

function removeErrorTextPassword2() {
    passworderrorText2.style.display="none";
}

function removeErrorTextPasswordCompare() {
    passwordCompareErrorText.style.display ="none";
}

function removeErrorTextAdress() {
    adresserrorText.style.display ="none";
}

function removeErrorTextPostalnumber() {
    postalnumbererrorText.style.display ="none";
}

function removeErrorTextPhone() {
    phoneerrorText.style.display ="none";
}

function removeErrorBackEnd() {
    errorBackEndText.style.display ="none";
}

/*check inputs on blur*/

function firstnameVerify() {
    if (firstnameinput.value !== "") {
        if (regfirstandlastnameCheck(firstnameinput.value)) {
            firstnameerrorText.innerHTML = "";
            firstnameinput.value = cleanFirstName(firstnameinput.value);
        } else {
                firstnameerrorText.innerHTML = "Min 2 letters, geen cijfers &nbsp;&#x274C";
                firstnameerrorText.style.display ="block";
        }
    }
    else {
        firstnameerrorText.innerHTML = "Voornaam is vereist&nbsp;&#x274C;";
        firstnameerrorText.style.display ="block";
    }
}

function lastnameVerify() {
    if (lastnameinput.value !== "") {
        if (regfirstandlastnameCheck(lastnameinput.value)) {
            lastnameerrorText.innerHTML = "";
            lastnameinput.value = cleanLastName(lastnameinput.value);
        } else {
            lastnameerrorText.innerHTML = "Min 2 letters, geen cijfers &nbsp;&#x274C";
            lastnameerrorText.style.display ="block";
        }
    }
    else {
        lastnameerrorText.innerHTML = "Achternaam is vereist&nbsp;&#x274C;";
        lastnameerrorText.style.display ="block";
    }
}

function emailVerify() {
    if (emailinput.value !== "") {
        if (regmailCheck(emailinput.value)) {
        emailerrorText.innerHTML = "";
        emailinput.value = cleanemail(emailinput.value);
        } else {
        emailerrorText.innerHTML = "Email heeft verkeerd formaat&nbsp;&#x274C";
        emailerrorText.style.display ="block";
        }
    }
    else {
        emailerrorText.innerHTML = "Email is vereist&nbsp;&#x274C;";
        emailerrorText.style.display ="block";
    }
}

function emailVerify2() {
    if (emailinput2.value !== "") {
        if (regmailCheck(emailinput2.value)) {
            emailerrorText2.innerHTML = "";
            emailinput2.value = cleanemail(emailinput2.value);
        } else {
            emailerrorText2.innerHTML = "Email heeft verkeerd formaat&nbsp;&#x274C";
            emailerrorText2.style.display ="block";
        }
    }
    else {
        emailerrorText2.innerHTML = "Email is vereist&nbsp;&#x274C;";
        emailerrorText2.style.display ="block";
    }
    if (emailinput.value === emailinput2.value){
        emailCompareErrorText.innerHTML = "";
    } else {
        emailCompareErrorText.innerHTML = "Emails zijn niet gelijk&nbsp;&#x274C";
        emailCompareErrorText.style.display = "block";
    }
}

/*check passwords on blur*/

function passwordVerify() {
    if (passwordinput.value !== "") {
        if (regpasswordCheck(passwordinput.value)) { // Second Change
            passworderrorText.innerHTML = "";
        } else {
            passworderrorText.innerHTML = "Paswoord voldoet niet aan de regels &nbsp;&#x274C";
            passworderrorText.style.display ="block";
        }
    }
    else {
        passworderrorText.innerHTML = "Paswoord is vereist&nbsp;&#x274C;";
        passworderrorText.style.display ="block";
    }
}

function passwordVerify2() {
    if (passwordinput2.value !== "") {
        if (regpasswordCheck(passwordinput2.value)) { // Second Change
            passworderrorText2.innerHTML = "";
        } else {
            passworderrorText2.innerHTML = "Paswoord voldoet niet aan de regels&nbsp;&#x274C";
            passworderrorText2.style.display ="block";
        }
    }
    else {
        passworderrorText2.innerHTML = "Paswoord is vereist&nbsp;&#x274C;";
        passworderrorText2.style.display ="block";
    }
    if (passwordinput.value === passwordinput2.value){
        passwordCompareErrorText.innerHTML = "";
    } else {
        passwordCompareErrorText.innerHTML = "Wachtwoorden zijn niet gelijk&nbsp;&#x274C";
        passwordCompareErrorText.style.display = "block";
    }
}

function adressVerify() {
    if (adressinput.value !== "") {
        if (regadressCheck(adressinput.value)) {
            adresserrorText.innerHTML = "";
            adressinput.value = cleanadress(adressinput.value);
        } else {
            adresserrorText.innerHTML = "Geen geldige opbouw van adres. Straatnaam en nummer gescheiden door spatie&nbsp;&#x274C";
            adresserrorText.style.display ="block";
        }
    }
    else {
        adresserrorText.innerHTML = "Adres is vereist&nbsp;&#x274C;";
        adresserrorText.style.display ="block";
    }
}

function postalnumberVerify() {
    if (postalnumberinput.value !== "") {
        if (regpostalnumberCheck(postalnumberinput.value)) {
            postalnumbererrorText.innerHTML = "";
        } else {
            postalnumbererrorText.innerHTML = "Dit is geen belgisch postnummer&nbsp;&#x274C";
            postalnumbererrorText.style.display ="block";
        }
    }
    else {
        postalnumbererrorText.innerHTML = "Postnummer is vereist&nbsp;&#x274C;";
        postalnumbererrorText.style.display ="block";
    }
}

function phoneVerify() {
    if (phoneinput.value !== "") {
        if (regphoneCheck(phoneinput.value)) {
            phoneerrorText.innerHTML = "";
        } else {
            phoneerrorText.innerHTML = "Geen geldige opbouw van telefoonnummer&nbsp;&#x274C";
            phoneerrorText.style.display ="block";
        }
    }
    else {
        phoneerrorText.innerHTML = "telefoonnummer is vereist&nbsp;&#x274C;";
        phoneerrorText.style.display ="block";
    }
}


/*clean input functions*/

function cleanFirstName(string){
    string = string.trim();
    string = string.replace(/\s+/g,' ');
    let newSentence ="";
    let x = string.split(" ").length;
    var words= string.split(" ");
    var firstSubPart;

    for (let i=0; i<x; i++){
        if ((words[i].split("-")).length > 1){
            let subWords = words[i].split("-");
            let newSubSentence2 ="";
            let k = subWords.length;
            for (j=0; j < (k-1); j++){
                if (j===0) {
                    let firstSubPart1 = subWords[j].substring(0,1).toUpperCase();
                    let firstSubPart2 = (subWords[j].substring(1)).toLowerCase();
                    firstSubPart = firstSubPart1 + firstSubPart2;
                }
                else {
                    firstSubPart = "";
                }
                let lastSubPart1 = (subWords[j+1].substring(0,1)).toUpperCase();
                let lastSubPart2 = (subWords[j+1].substring(1)).toLowerCase();
                let newSubWord = firstSubPart + "-" + lastSubPart1 + lastSubPart2;
                newSubSentence2 = newSubSentence2 + newSubWord;
            }
            newSentence= newSentence + newSubSentence2 + " ";
            string = newSentence;
        }
        else{
            var firstPart = words[i].substring(0,1);
            var lastPart = words[i].substring(1);
            firstPart = (words[i].substring(0,1)).toUpperCase();
            lastPart = (words[i].substring(1)).toLowerCase();
            newWord = firstPart + lastPart;
            newSentence = newSentence + newWord + " ";
            string = newSentence}
        }
    return string;
}

function cleanLastName(string){
    string = string.trim();
    string = string.replace(/\s+/g,' ');
    let newSentence ="";
    let x = string.split(" ").length;
    var words= string.split(" ");
    var firstSubPart;
    if (string.valueOf() === string.valueOf().toUpperCase()) {
        for (let i = 0; i < x; i++){
            if ((words[i].split("-")).length > 1) {
                let subWords = words[i].split("-");
                let newSubSentence2 = "";
                let k = subWords.length;
                for (j = 0; j < (k - 1); j++) {
                    let counter = subWords[j].length;
                    if (j === 0) {
                        let firstSubPart1 = subWords[j].substring(0, 1).toUpperCase();
                        let firstSubPart2 = (subWords[j].substring(1)).toLowerCase();
                        firstSubPart = firstSubPart1 + firstSubPart2;
                    } else {
                        firstSubPart = "";
                    }
                    let lastSubPart1 = (subWords[j + 1].substring(0, 1)).toUpperCase();
                    let lastSubPart2 = (subWords[j + 1].substring(1)).toLowerCase();
                    let newSubWord = firstSubPart + "-" + lastSubPart1 + lastSubPart2;
                    newSubSentence2 = newSubSentence2 + newSubWord;
                }
                newSentence = newSentence + newSubSentence2 + " ";
                string = newSentence;
            } else {
                var firstPart = words[i].substring(0, 1);
                var lastPart = words[i].substring(1);
                firstPart = (words[i].substring(0, 1)).toUpperCase();
                lastPart = (words[i].substring(1)).toLowerCase();
                newWord = firstPart + lastPart;
                newSentence = newSentence + newWord + " ";
                string = newSentence
            }
        }
    }
    return string;
}

function cleanemail(string){
    return string.toLowerCase();
}

function cleanadress(string){
    string = string.trim();
    string = string.replace(/\s+/g,' ');
    string = string.toLowerCase();
    string = string.split(" ");
    let x = string.length;
    for (let i = 0; i < x; i++) {
       string[i] = string[i][0].toUpperCase() + string[i].substr(1);
    }
    return string.join(" ");
}

/*second check on submit*/

function CheckAll(){
    firstnameVerify();
    lastnameVerify();
    emailVerify();
    emailVerify2();
    passwordVerify();
    passwordVerify2();
    adressVerify();
    postalnumberVerify();
    phoneVerify();
    if ((emailerrorText.textContent !== "") || (emailerrorText2.textContent !== "") || (emailCompareErrorText.textContent !== "")
      || (passworderrorText.textContent !== "") || (passworderrorText2.textContent !== "") || (passwordCompareErrorText.textContent !== "")
      || (adresserrorText.textContent !== "") || (postalnumbererrorText.textContent !== "") || (phoneerrorText.textContent !== "")) {
        event.preventDefault();
    }
}

/*add event listenersr*/

firstnameinput.addEventListener('blur',firstnameVerify);
firstnameerrorText.addEventListener('click',removeErrorTextFirstname);
lastnameinput.addEventListener('blur',lastnameVerify);
lastnameerrorText.addEventListener('click',removeErrorTextLastname);
emailinput.addEventListener('blur',emailVerify);
emailerrorText.addEventListener('click',removeErrorTextMail);
emailinput2.addEventListener('blur',emailVerify2);
emailerrorText2.addEventListener('click',removeErrorTextMail2);
emailCompareErrorText. addEventListener('click',removeErrorTextMailCompare);
passwordinput.addEventListener('blur',passwordVerify);
passwordinput2.addEventListener('blur',passwordVerify2);
passworderrorText.addEventListener('click',removeErrorTextPassword);
passworderrorText2.addEventListener('click',removeErrorTextPassword2);
passwordCompareErrorText. addEventListener('click',removeErrorTextPasswordCompare);
/* postalnumberinput.addEventListener('blur',postalnumberVerify);
postalnumbererrorText.addEventListener('click',removeErrorTextPostalnumber); */
adressinput.addEventListener('blur',adressVerify);
adresserrorText.addEventListener('click',removeErrorTextAdress);
phoneinput.addEventListener('blur',phoneVerify);
phoneerrorText.addEventListener('click',removeErrorTextPhone);
errorBackEndText.addEventListener('click',removeErrorBackEnd);

logbutton.addEventListener('click', CheckAll);