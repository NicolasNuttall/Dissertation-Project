$(function(){
    $("body").on("click",'#createNote', function(e){     
        var book_id= $(this).data('bookid');
        var note_data =  $('#noteText').val();
        $.ajax({
            method:"POST",
            url:"/Readie/ajax/createnote.php",
            dataType:'json',
            data:{book_id:book_id, note_data:note_data},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }
        })
        .done(function(rtnData){
            
            $('#noteText').val('');
        })
    });

    $('.expandText').on('keydown',function(){//Auto resize for text area
        const txt = this;
        setTimeout(function(){
            txt.style.cssText = 'height:' + txt.scrollHeight + 'px';
        },0);
    });
});


