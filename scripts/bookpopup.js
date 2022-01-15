$(document).ready(function(){
    $(".close-window").click(function(){
        $(".pop-up-window").css("display","none");
    }); 
})

$(document).ready(function(){
    $(".close-pop-up").click(function(){
        $(".create-custom-item-container").css("display","none");
    }); 
    
    $('#create-custome-item-button').click(function(){
        $(".create-custom-item-container").css("display","flex");
    })
})