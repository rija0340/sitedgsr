var iconClose = document.querySelector(".icon-close"),
    btnOpen = document.querySelector(".btn-open"),
    modal = document.querySelector(".modal");

//Events
btnOpen.addEventListener("click", openModal);
iconClose.addEventListener("click", closeModal);



// Open Modal

function openModal() {
   modal.classList.add("open");

}

function closeModal() {
   modal.classList.add("close");

   setTimeout(function() {
      modal.classList.remove("open");
      modal.classList.remove("close");
   }, 1500);

}

      //Swiper


   var mySwiper = new Swiper(".swiper-container", {
      // Optional parameters
      direction: "horizontal",
      loop: true,
      effect: "coverflow",
      centeredSlides: true,
      speed: 800,
      coverflowEffect: {
         rotate: 60,
         stretch: 10,
         depth: 150,
         modifier: 2,
         slideShadows: false
      },

      // If we need pagination
      pagination: {
         el: ".swiper-pagination",
         clickable: true
      },

      // Navigation arrows
      navigation: {
         nextEl: ".swiper-button-next",
         prevEl: ".swiper-button-prev"
      }
   });
