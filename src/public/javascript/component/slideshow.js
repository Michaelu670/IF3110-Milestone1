let slideIndex = 1;
showSlides(slideIndex);

function nextSlide() {
    showSlides(slideIndex + 1);
}

function prevSlide() {
    showSlides(slideIndex - 1);
}

function toSlide(n) {
    showSlides(n);
}

function showSlides(newSlide) {
    let slides = document.getElementsByClassName("mySlides");
    // hide old slide
    slides[slideIndex-1].style.display = "none";

    // calculate new slide number
    slideIndex = (newSlide - 1 + slides.length) % slides.length + 1;

    // show new slide
    slides[slideIndex-1].style.display = "block";
}