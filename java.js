window.onscroll = function() { scrollFunction() };

function scrollFunction() {
    var header = document.getElementById("myHeader");
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        header.style.backgroundColor = "black"; // Change this to the desired color
    } else {
        header.style.backgroundColor = "transparent"; }}