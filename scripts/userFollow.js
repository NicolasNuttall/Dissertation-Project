$(function(){
    $("body").on("click",'#follow', function(e){
        var username= $(this).data('username');
        var obj =this;
        $.ajax({
            method:"POST",
            url:"/Promotion/ajax/follow.php",
            dataType:'json',
            data:{username:username},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }
        })
        .done(function(rtnData){
            if(rtnData.success == true){
                $(obj).text("Unfollow");
                $(obj).attr('id','unFollow');
                $(obj).toggleClass("following");
            }else{
                $("body").append('<div class="sign-in-required"><div class="box"><h4>Sign In required!</h4><button onclick="closeRequireBox()">X</button><p>You need to be logged into an account to perform that action</p><div class="buttons d-flex"><a href="/Promotion/login">Login</a><a href="/Promotion/register">Create an account</a></div></div></div>');
            }
        })
    });
    $("body").on("click",'#unFollow', function(e){
        var username= $(this).data('username');
        var obj = this;
        $.ajax({
            method:"POST",
            url:"/Promotion/ajax/follow.php",
            dataType:'json',
            data:{username:username},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }
        })
        .done(function(rtnData){
            if(rtnData.success == true){
                $(obj).text("Follow")
                $(obj).attr('id','follow');
                $(obj).toggleClass("following");
            }
        })
    });
});


