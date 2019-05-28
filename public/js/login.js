        let emailinput = document.querySelector("#loginFormEmail");
        let emailerrorText = document.querySelector(".errorEmail");
        let passwordinput = document.querySelector("#loginPassword");
        let passworderrorText = document.querySelector(".errorPassword");
        let logbutton = document.querySelector("#inlogbtn");
        let emailresetinput = document.querySelector("#resetPasswordEmail");
        let emailreseterrorText = document.querySelector(".errorReset");

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

        function removeErrorTextResetMail() {
          emailreseterrorText.style.display="none"
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

        /*check resetmail on blur*/
        function emailresetVerify() {
          if (emailresetinput.value !== "") {
              if (regmailCheck(emailresetinput.value)) {
                emailreseterrorText.innerHTML = "";
                emailinput.value = cleanemail(emailresetinput.value);
              } else {
                emailreseterrorText.innerHTML = "Email heeft verkeerd formaat&nbsp;&#x274C";
                emailreseterrorText.style.display ="block";
              }
          }
          else {
            emailreseterrorText.innerHTML = "Email is vereist&nbsp;&#x274C;";
            emailreseterrorText.style.display ="block";
           }
        }

        /*check password on blur*/
        function passwordVerify() {
            if (passwordinput.value !== "") {
                if (regpasswordCheck(passwordinput.value)) { // Second Change
                  passworderrorText.innerHTML = "";
                } else {
                  passworderrorText.innerHTML = "Min. 8 karakters, 1 hoofd-, 1 kleine letter en 1 cijfer &nbsp;&#x274C";
                  passworderrorText.style.display ="block";
                }
            }
            else {
              passworderrorText.innerHTML = "Paswoord is vereist&nbsp;&#x274C;";
              passworderrorText.style.display ="block";
            }
        }
        
        /*clean email*/
        function cleanemail(string){
          return string.toLowerCase();
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
        emailresetinput.addEventListener('blur',emailresetVerify);
        emailreseterrorText.addEventListener('click',removeErrorTextResetMail);

        logbutton.addEventListener('click', CheckAll);
