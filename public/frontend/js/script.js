/*========================================navbar js==========================================*/
const menu = document.querySelector(".menu");
 const menuMain = menu.querySelector(".menu-main");
 const goBack = menu.querySelector(".go-back");
 const menuTrigger = document.querySelector(".mobile-menu-trigger");
 const closeMenu = menu.querySelector(".mobile-menu-close");
 let subMenu;
 menuMain.addEventListener("click", (e) =>{
  if(!menu.classList.contains("active")){
    return;
  }
   if(e.target.closest(".menu-item-has-children")){
     const hasChildren = e.target.closest(".menu-item-has-children");
      showSubMenu(hasChildren);
   }
 });
 goBack.addEventListener("click",() =>{
   hideSubMenu();
 })
 menuTrigger.addEventListener("click",() =>{
   toggleMenu();
 })
 closeMenu.addEventListener("click",() =>{
   toggleMenu();
 })
 document.querySelector(".menu-overlay").addEventListener("click",() =>{
  toggleMenu();
 })
 function toggleMenu(){
  menu.classList.toggle("active");
  document.querySelector(".menu-overlay").classList.toggle("active");
 }
 function showSubMenu(hasChildren){
    subMenu = hasChildren.querySelector(".sub-menu");
    subMenu.classList.add("active");
    subMenu.style.animation = "slideLeft 0.5s ease forwards";
    const menuTitle = hasChildren.querySelector("i").parentNode.childNodes[0].textContent;
    menu.querySelector(".current-menu-title").innerHTML=menuTitle;
    menu.querySelector(".mobile-menu-head").classList.add("active");
 }

 function  hideSubMenu(){  
    subMenu.style.animation = "slideRight 0.5s ease forwards";
    setTimeout(() =>{
       subMenu.classList.remove("active");  
    },300); 
    menu.querySelector(".current-menu-title").innerHTML="";
    menu.querySelector(".mobile-menu-head").classList.remove("active");
 }
 
 window.onresize = function(){
  if(this.innerWidth >991){
    if(menu.classList.contains("active")){
      toggleMenu();
    }

  }
 }
/*========================================navbar js==========================================*/

/*=======================================testimonial js======================================*/
$(document).ready(function(){
    $("#testimonial-slider").owlCarousel({
        items:3,
        itemsDesktop:[1000,3],
        itemsDesktopSmall:[990,2],
        itemsTablet:[767,1],
        pagination:true,
        navigation:false,
        autoPlay:true
    });
});
/*=======================================testimonial js========================================*/

function setProgress(percent) {
  const circle = document.getElementById("progressCircle");
  const text = document.getElementById("progressText");
  const circumference = 2 * Math.PI * 54; // 2πr

  // Calculate offset
  const offset = circumference - (percent / 100) * circumference;
  circle.style.strokeDashoffset = offset;

  // Update text
  text.textContent = percent + "%";
}

// Example: dynamically set progress to 80%
setProgress(80);

// You can call setProgress(x) dynamically from API or input