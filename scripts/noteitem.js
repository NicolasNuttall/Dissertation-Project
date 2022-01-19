$(document).ready(function(){
    $(".note-menu-icon").click(function(){
        $(this).prev().toggle();
    }); 

    $("body").on("click", ".loadmore", function(e){
        x = $(this).prev();
        x.toggleClass("loadedtext");
    })
})

window.addEventListener('mouseup', function(e) {
    if($(".study-note-item").length){
        var x = document.querySelector('.note-menu');
        if (event.target != document.querySelector(".note-menu-icon")) {
            x.style.display = "none";
        }
    }
});

//
window.addEventListener('mouseup', function(e) {
    var x = $('timer-changer');
    if (event.target != document.querySelector(".timer-menu")) {
        x.toggleClass("revealed-menu");
    }
});