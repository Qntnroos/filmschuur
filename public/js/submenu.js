let subnavbarcontainer = document.querySelector(".subnavbar");

function MakeActiveAndShowContent(event) {
  if (event.target.matches(".htmlbutton")) {
    let buttonklasse = document.querySelectorAll('.htmlbutton');
    let x = event.target.id;

    buttonklasse.forEach((buttonklas)=>{
      buttonklas.classList.remove('active');
    });
    event.target.classList.add('active');

    let contentklasse = document.querySelectorAll('.content');
    console.log(contentklasse)
    contentklasse.forEach((contentklas)=>{
      contentklas.style.display ="none";
    });
    contentklasse[x].style.display ="block";
  }
}

subnavbarcontainer.addEventListener('click',MakeActiveAndShowContent);
