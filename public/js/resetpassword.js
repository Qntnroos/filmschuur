const passwordinput = document.querySelector("#resetPassword1");
const passwordinput2 = document.querySelector("#resetPassword2");
const passworderrorText = document.querySelector(".errorPassword");
const passworderrorText2 = document.querySelector(".errorPassword2");
const passwordCompareErrorText = document.querySelector (".errorPasswordCompare");
const logbutton = document.querySelector("#resetbutton");

function regpasswordCheck(passwordCheck) {
    let passwordRegex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,13}$/;
    return (passwordRegex.test(passwordCheck));
}

function removeErrorTextPassword() {
    passworderrorText.style.display="none";
    passwordinput.classList.remove("is-invalid");
}

function removeErrorTextPassword2() {
    passworderrorText2.style.display="none";
    passwordinput2.classList.remove("is-invalid");
}

function removeErrorTextPasswordCompare() {
    passwordCompareErrorText.style.display ="none";
}

/*check passwords on blur*/

function passwordVerify() {
    console.log(passwordinput.value);
    if (passwordinput.value !== "") {
        if (regpasswordCheck(passwordinput.value)) { // Second Change
            passworderrorText.innerHTML = "";
            passwordinput.classList.remove("is-invalid");
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
    console.log(passwordinput2.value)
    if (passwordinput2.value !== "") {
        if (regpasswordCheck(passwordinput2.value)) { // Second Change
            passwordinput2.classList.remove("is-invalid");
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

function CheckAll(){
    passwordVerify();
    passwordVerify2();
    if ((passworderrorText.textContent !== "") || (passworderrorText2.textContent !== "") || (passwordCompareErrorText.textContent !== "")) {
        event.preventDefault();
    }
}

/*add event listenersr*/

passwordinput.addEventListener('blur',passwordVerify);
passwordinput2.addEventListener('blur',passwordVerify2);
passworderrorText.addEventListener('click',removeErrorTextPassword);
passworderrorText2.addEventListener('click',removeErrorTextPassword2);
passwordCompareErrorText. addEventListener('click',removeErrorTextPasswordCompare);

logbutton.addEventListener('click', CheckAll);