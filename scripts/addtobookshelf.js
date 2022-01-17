$(function(){
    $("body").on("click",'#save', function(e){
        var tutorial_id= $(this).data('bookid');
        var obj = this;
        $.ajax({
            method:"POST",
            url:"/Readie/ajax/addbook.php",
            dataType:'json',
            data:{book_id:book_id},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }
        })
        .done(function(rtnData){
            if(rtnData.success == true){
                if($(obj).hasClass("save")){
                    $(obj).toggleClass("saved");
                }else{
                    $("#mark").text("Remove from shelf");
                    $("#mark").toggleClass("save");
                }
                $("#mark").attr('id','unsave');
            }else{
                $("body").append('<div class="sign-in-required"><div class="box"><h4>Sign In required!</h4><button onclick="closeRequireBox()">X</button><p>You need to be logged into an account to perform that action</p><div class="buttons d-flex"><a href="/Promotion/login">Login</a><a href="/Promotion/register">Create an account</a></div></div></div>');
            }
        })
    });
    $("body").on("click",'#unsave', function(e){
        var book_id = $(this).data('bookid');
        var obj = this;
        $.ajax({
            method:"POST",
            url:"/Readie/addbook.php",
            dataType:'json',
            data:{book_id:book_id},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }    
        })
        .done(function(rtnData){
            if(rtnData.success == true){
                if($(obj).hasClass("save")){
                    $(obj).toggleClass("saved");
                }else{
                    $("#unMark").text("Save");
                    $("#unMark").toggleClass("save");
                }
                $("#unMark").attr('id','save');
            }
        })  

    });
});


