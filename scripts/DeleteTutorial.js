$(function(){
    $("body").on("click",'#deleteTutorial', function(e){
        var confirmDelete = confirm("Delete this Tutorial?");
        if(confirmDelete == true){
            var tutorial_id= $(this).data('tutorialid');
            $.ajax({
                method:"POST",
                url:"/Promotion/ajax/deleteTutorial.php",
                dataType:'json',
                data:{tutorial_id:tutorial_id},
                success:function(data){
                    if(data.link){
                        window.location.href = data.link
                    };
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            })
            .done(function(rtnData){
                console.log(rtnData);
                
            })
        }
    });

});


