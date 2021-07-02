$(function(){
    $("body").on("click",'#Like', function(e){
        var tutorial_id= $(this).data('tutorialid');
        var obj = this;
        $.ajax({
            method:"POST",
            url:"/Promotion/ajax/like.php",
            dataType:'json',
            data:{tutorial_id:tutorial_id},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            },

        })
        .done(function(rtnData){    
            if(rtnData.success == true){
                $(obj).children('span').text(parseInt($(obj).children('span').text()) + 1);
                $(obj).attr('id','unLike');
                $(obj).children().toggleClass("liked");
            }else{
                $("body").append('<div class="sign-in-required"><div class="box"><h4>Sign In required!</h4><button onclick="closeRequireBox()">X</button><p>You need to be logged into an account to perform that action</p><div class="buttons d-flex"><a href="/Promotion/login">Login</a><a href="/Promotion/register">Create an account</a></div></div></div>');
            }
        })
        
    });
    $("body").on("click",'#unLike', function(e){
        var tutorial_id= $(this).data('tutorialid');
        var obj = this;
        $.ajax({
            method:"POST",
            url:"/Promotion/ajax/like.php",
            dataType:'json',
            data:{tutorial_id:tutorial_id},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            },

        })
        .done(function(rtnData){
            if(rtnData.success == true){
                $(obj).children('span').text(parseInt($(obj).children('span').text()) - 1);
                $(obj).attr('id','Like');
                $(obj).children().toggleClass("liked");
            }else{
       
            }
        })  
    

        
    });
});


