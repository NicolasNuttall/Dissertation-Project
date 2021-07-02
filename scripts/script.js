
function Mark(x){
    x.classList.toggle("marked");
}

$('textarea').on('keydown',function(){//Auto resize for text area
    const txt = this;
    setTimeout(function(){
        txt.style.cssText = 'height:auto; padding:0';
        txt.style.cssText = 'height:' + txt.scrollHeight + 'px';
    },0);
});

function closeRequireBox(){
    $(".sign-in-required").remove();
}


function FollowToggle(elm){  
    if (elm.innerHTML ==="Follow"){
        elm.innerHTML ="Following";
        elm.classList.add("following-anim");
        
    }
    else{
        elm.innerHTML="Follow";
        elm.classList.remove("following-anim");
    }
    
    elm.classList.toggle("following");
}

