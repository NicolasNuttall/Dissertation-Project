$(function () {
    $("#shuffle").on("click",()=>{
        let shuffle = 1;
        $(".loading-icon").css("visibility","visible");
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
            $(".loading-icon").css("visibility",'hidden');
            $(".browse-item").remove();
            let dataone = rtnData[0];
            dataone.forEach((e) =>{
                $(".book-row").prepend('<a href="/Readie/summary/' + e.id + '" class="browse-item"><div class="front"><img src="' + e.usedImage + '" alt="" /></div><div class="back"><h4>' + e.title +'</h4><p>' + e.authors + '</p></div></a>')
            })
            rtnData[1].forEach((e) =>{
                $(".book-row").prepend('<a href="/Readie/summary/' + e.id + '" class="browse-item"><div class="front"><img src="' + e.usedImage + '" alt="" /></div><div class="back"><h4>' + e.title +'</h4><p>' + e.authors + '</p></div></a>')
            })
        })
    }) 
   
    



});



