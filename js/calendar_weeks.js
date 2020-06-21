var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {

    var i;
    var slides = document.getElementsByClassName("calendar");

    if (n > slides.length) {
        slideIndex = slides.length;
        document.getElementsByClassName("next_week").style.display = "none";
    }
    if (n < 1) {
        slideIndex = 1;
        document.getElementsByClassName("prev_week").style.display = "none";
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "flex";
}
