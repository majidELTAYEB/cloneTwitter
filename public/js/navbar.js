/// headerMobile
const header = document.querySelector("header");
window.addEventListener("scroll", (event) => {
  if (window.scrollY > 0)
    header.classList.add("header-fixed");
   else 
    header.classList.remove("header-fixed");
  
});

// headerMobile active
const navbarBottom = document.querySelectorAll(".navbarBottom a");
navbarBottom.forEach((links) => {
  let iconName;
  links.addEventListener("click", (event) => {

    // navbarBottom.forEach((links) => {
    //   let lin = links.firstChild.name.search('-');
    //   console.log(lin);
    //   if(lin !== -1){
    //     console.log("iconName",links.firstChild.name+ "-outline");
    //     links.firstChild.name + "-outline";
    //   }
    // })

    iconName = links.firstChild.name.split('-');
    links.firstChild.name = iconName[0];
  }) 
  // links.firstChild.name + "-outline";
})

// headerMobile modal
const modalAccount = document.querySelector(".modalAccount");
const removeModalAccount = document.querySelector("#removeModalAccount");

if (removeModalAccount != null) {
  removeModalAccount.addEventListener("click", () => {
    modalAccount.classList.remove("active");
  });
}
const avatar = document.querySelector("#avatar");
avatar.addEventListener("click", function () {
  modalAccount.classList.add("active");
});


const subItemBox = document.querySelector('.sub-items-boxx');
const moreBtn = document.querySelector('#moreBtn');
const overlay = document.querySelector('.overlay');
moreBtn.addEventListener('click',function(){
  subItemBox.classList.add('active');
  overlay.classList.add('active');
})

overlay.addEventListener('click',function(){
  subItemBox.classList.remove('active');
  overlay.classList.remove('active');
})

