window.onscroll = function() { scrollFunction() };

function scrollFunction() {
    var header = document.getElementById("myHeader");
    var buttons = document.querySelectorAll(".header button");

    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        header.style.backgroundColor = "black";
        buttons.forEach(function(button) {
            button.style.backgroundColor = "#303030";
            button.style.color= "white";
            
        });
    } else {
        header.style.backgroundColor = "transparent";
        buttons.forEach(function(button) {
            button.style.backgroundColor = "transparent";
            button.style.color= "white";
            
        });
    }
}
document.addEventListener("DOMContentLoaded", function () {
    const slider = document.querySelector(".slider");
    const slides = document.querySelectorAll(".slider img");
    const sliderNav = document.querySelector(".slider-nav");
    const intervalTime = 4000; // Set the interval time in milliseconds

    let slideIndex = 0;
    let slideInterval;

    // Function to show the current slide
    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.transform = `translateX(${100 * (i - index)}%)`;
        });
    }

    // Function to change the slide
    function changeSlide() {
        slideIndex = (slideIndex + 1) % slides.length;
        showSlide(slideIndex);
    }

    // Create navigation buttons dynamically
    slides.forEach((slide, i) => {
        const navButton = document.createElement("a");
        navButton.href = `#slide-${i + 1}`;
        navButton.addEventListener("click", (e) => {
            e.preventDefault();
            slideIndex = i;
            showSlide(slideIndex);
        });
        sliderNav.appendChild(navButton);
    });

    // Start the slide interval
    function startSlideInterval() {
        slideInterval = setInterval(changeSlide, intervalTime);
    }

    // Stop the slide interval
    function stopSlideInterval() {
        clearInterval(slideInterval);
    }

    // Event listeners for pause and resume on hover
    slider.addEventListener("mouseenter", stopSlideInterval);
    slider.addEventListener("mouseleave", startSlideInterval);

    // Initial setup
    showSlide(slideIndex);
    startSlideInterval();
});
