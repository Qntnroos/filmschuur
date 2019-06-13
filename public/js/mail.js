        const resetbutton = document.querySelector("#resetbtn");
        const emailresetinput = document.querySelector("#resetPasswordEmail");
        const emailreseterrorText = document.querySelector(".errorReset");

        /*regex mail*/
        function regmailCheck(mailCheck) {
          let emailRegex = /^(([\-\w]+)\.?)+@(([\-\w]+)\.?)+\.[a-zA-Z]{2,6}$/;
          return (emailRegex.test(mailCheck));
        }

        /*verwijder foutbootschappen*/
        function removeErrorTextResetMail() {
          emailreseterrorText.style.display="none";
          emailresetinput.classList.remove("is-invalid");
        }

        /*check resetmail on blur*/
        function emailresetVerify() {
          if (emailresetinput.value !== "") {
              if (regmailCheck(emailresetinput.value)) {
                emailreseterrorText.innerHTML = "";
                emailresetinput.value = cleanemail(emailresetinput.value);
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

        /*clean email*/
        function cleanemail(string){
          return string.toLowerCase();
        }

        /*check all before send*/
        function CheckAll(){
          emailresetVerify();
          if (emailreseterrorText.textContent !== "") {
            event.preventDefault()
          }
        }

        /*addEventListener*/
        emailresetinput.addEventListener('blur',emailresetVerify);
        emailreseterrorText.addEventListener('click',removeErrorTextResetMail);

        resetbutton.addEventListener('click', CheckAll);
