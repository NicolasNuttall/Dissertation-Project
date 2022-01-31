$(function(){
    $("body").on("click",'#save_note', function(e){
        var note_id= $(this).data('noteid');
        var obj = this;

        $.ajax({
            method:"POST",
            url:"/Readie/ajax/savenote.php",
            dataType:'json',
            data:{note_id:note_id},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }
        })
        .done(function(rtnData){
            if(rtnData.success == true){
                $(obj).attr('id','unsave_note');
                $(obj).toggleClass("active-like-button");
                $(obj).addClass("like-anim");
            }else{
                $("body").append('<div class="sign-in-required"><div class="box"><h4>Sign In required!</h4><button onclick="closeRequireBox()">X</button><p>You need to be logged into an account to perform that action</p><div class="buttons d-flex"><a href="/Promotion/login">Login</a><a href="/Promotion/register">Create an account</a></div></div></div>');
            }
        })
    });
    $("body").on("click",'#unsave_note', function(e){
        var note_id = $(this).data('noteid');
        var obj = this;
        $.ajax({
            method:"POST",
            url:"/Readie/ajax/savenote.php",
            dataType:'json',
            data:{note_id:note_id},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }    
        })
        .done(function(rtnData){
            if(rtnData.success == true){
                $(obj).attr('id','save_note');
                $(obj).toggleClass("active-like-button");
                $(obj).removeClass("like-anim");
            }
        })  

    });
});


