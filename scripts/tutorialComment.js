$(function(){
    $("body").on("click",'#comment', function(e){     
        var tutorial_id= $(this).data('tutorialid');
        var comment_data =  $('#commentText').val();
        $.ajax({
            method:"POST",
            url:"/Promotion/ajax/comment.php",
            dataType:'json',
            data:{tutorial_id:tutorial_id, comment_data:comment_data},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }
        })
        .done(function(rtnData){
            
            $('#commentText').val('');
        })
    });

});


