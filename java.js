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
