$(function(){
    $("body").on("click",'#save', function(e){
        var book_id= $(this).data('bookid');
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
                $(obj).toggleClass("saved");
                $(obj).text("Remove from shelf");
                $(obj).toggleClass("save");
                $(obj).attr('id','unsave');
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
            url:"/Readie/ajax/addbook.php",
            dataType:'json',
            data:{book_id:book_id},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }    
        })
        .done(function(rtnData){
            if(rtnData.success == true){
                $(obj).toggleClass("saved");
                $(obj).text("Save");
                $(obj).toggleClass("save");
                $(obj).attr('id','save');
            }
        })  

    });
});


