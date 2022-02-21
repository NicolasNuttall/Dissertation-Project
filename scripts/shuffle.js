$(function () {
    $("#shuffle").on("click",()=>{
        var shuffle = 1
        $.ajax({
            method: "POST",
            url: "/Readie/ajax/browseshuffle.php",
            dataType: 'json',
            data: {
                shuffle:shuffle
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
        .done(function (rtnData) {
            console.log(rtnData);
        })
    }) 
   
    



});



