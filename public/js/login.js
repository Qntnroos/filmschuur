        let emailinput = document.querySelector("#loginFormEmail");
        let emailerrorText = document.querySelector(".errorEmail");
        let passwordinput = document.querySelector("#loginPassword");
        let passworderrorText = document.querySelector(".errorPassword");
        let logbutton = document.querySelector("#inlogbtn");

        /*regex mail*/
        function regmailCheck(mailCheck) {
          let emailRegex = /^(([\-\w]+)\.?)+@(([\-\w]+)\.?)+\.[a-zA-Z]{2,6}$/;
          return (emailRegex.test(mailCheck));
        }

        /*verwijder foutbootschappen*/
        function removeErrorTextMail() {
          emailerrorText.style.display ="none"
        }

        function removeErrorTextPassword() {
          passworderrorText.style.display="none"
        }

        /*regex password*/
        function regpasswordCheck(mailCheck) {
          let passwordRegex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,13}$/;
          return (passwordRegex.test(mailCheck));
        }

        /*check mail on blur*/
        function emailVerify() {
            if (emailinput.value !== "") {
                if (regmailCheck(emailinput.value)) {
                  emailerrorText.innerHTML = ""
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

        /*check password on blur*/
        function passwordVerify() {
            if (passwordinput.value !== "") {
                if (regpasswordCheck(passwordinput.value)) { // Second Change
                  passworderrorText.innerHTML = "";
                } else {
                  passworderrorText.innerHTML = "Min. 8 karakters, 1 kleine, 1 hoofdletter en 1 cijfer &nbsp;&#x274C";
                  passworderrorText.style.display ="block";
                }
            }
            else {
              passworderrorText.innerHTML = "Paswoord is vereist&nbsp;&#x274C;";
              passworderrorText.style.display ="block";
            }
        }

        /*check all before send*/
        function CheckAll(){
          emailVerify();
          passwordVerify();
          if ((emailerrorText.textContent !== "") || (passworderrorText.textContent !== "")) {
            event.preventDefault()
          }
        }
        /*addEventListener*/
        emailinput.addEventListener('blur',emailVerify);
        passwordinput.addEventListener('blur',passwordVerify);
        emailerrorText.addEventListener('click',removeErrorTextMail);
        passworderrorText.addEventListener('click',removeErrorTextPassword);

        logbutton.addEventListener('click', CheckAll);
