$(document).ready(function(){
    $("body").on("click", ".goal-option", function(){
        $(".preset-goals div").removeClass("selected-goal");
        $(this).addClass("selected-goal");
    })

    $("body").on("click","#setgoal",function(){
        let goalNumber;
        if($("#goalNumber").val()){
            goalNumber =  $("#goalNumber").val()*3600;
        }else if(!$("#goalNumber").val() && $(".selected-goal").data("goalint")){
            goalNumber = $(".selected-goal").data("goalint");
        }
        if(goalNumber > 0){
            $.ajax({
                method: "POST",
                url: "/Readie/ajax/goalset.php",
                dataType: 'json',
                data: {
                    goalNumber: goalNumber
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            })
            .done(function (rtnData) {
                $(".set-goal").append("<div class='success'><p>Goal successfully saved!</p></div>")
                    setTimeout(function(){
                        $('.success').remove();
                    }, 5000);

            })  
        }
        
    })

    $("#edit-goal").on("click",function(){
        $(".set-goal").toggleClass("d-flex");
    })

    
})


    



    




