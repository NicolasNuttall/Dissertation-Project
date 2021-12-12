$(document).ready(function(){
    $(".note-menu-icon").click(function(){
        $(".note-menu").toggle();
    }); 

    $("body").on("click", ".loadmore", function(e){
        x = $(this).prev();
        x.toggleClass("loadedtext");
    })
})

window.addEventListener('mouseup', function(e) {
    var x = document.querySelector('.note-menu');
    if (event.target != document.querySelector(".note-menu-icon")) {
        x.style.display = "none";
    }
});