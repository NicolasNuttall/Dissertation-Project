$(function(){
    $("body").on("click",'#mark', function(e){
        var tutorial_id= $(this).data('tutorialid');
        var obj = this;
        $.ajax({
            method:"POST",
            url:"/Promotion/ajax/finish.php",
            dataType:'json',
            data:{tutorial_id:tutorial_id},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }
        })
        .done(function(rtnData){
            if(rtnData.success == true){
                if($(obj).hasClass("mark-vector")){
                    $(obj).toggleClass("marked");
                }else{
                    $("#mark").text("Unmark as Finished");
                    $("#mark").toggleClass("finished");
                }
                $("#mark").attr('id','unMark');
            }else{
                $("body").append('<div class="sign-in-required"><div class="box"><h4>Sign In required!</h4><button onclick="closeRequireBox()">X</button><p>You need to be logged into an account to perform that action</p><div class="buttons d-flex"><a href="/Promotion/login">Login</a><a href="/Promotion/register">Create an account</a></div></div></div>');
            }
        })
    });
    $("body").on("click",'#unMark', function(e){
        var tutorial_id= $(this).data('tutorialid');
        var obj = this;
        $.ajax({
            method:"POST",
            url:"/Promotion/ajax/finish.php",
            dataType:'json',
            data:{tutorial_id:tutorial_id},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }    
        })
        .done(function(rtnData){
            if(rtnData.success == true){
                if($(obj).hasClass("mark-vector")){
                    $(obj).toggleClass("marked");
                }else{
                    $("#unMark").text("Mark as Finished");
                    $("#unMark").toggleClass("finished");
                }
                $("#unMark").attr('id','mark');
            }
        })  

    });
});


