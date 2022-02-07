$(document).ready(()=>{
    let typingTimer;             
    let doneTypingInterval = 400;  

    $("#search-input").keyup(() => { 
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
        
    });

    $("#search-input").keydown(() => {
        clearTimeout(typingTimer);
    });

    function doneTyping(){
        let search = $('#search-input').val();
        $.ajax({
            method: "GET",
            url: "https://www.googleapis.com/books/v1/volumes?q=" + search,
            error: function (){
                $("div.search-results").remove();
            }
        })
        .done(function(results){
            $("div.search-results").remove();
            $(".search-bar").append("<div class='search-results'></div>");
            let counter = 0;
            jQuery.each(results.items, function(i, val){
                counter++;
                if(counter < 6){
                    let bookInfo = {
                        id:results.items[i].id,
                        title:results.items[i].volumeInfo.title,        
                        subtitle:results.items[i].volumeInfo.subtitle,
                        authors:results.items[i].volumeInfo.authors,
                    };

                    bookInfo.image = (results.items[i].volumeInfo.imageLinks === undefined ? missingimg : results.items[i].volumeInfo.imageLinks.smallThumbnail);
                    bookInfo.publishDate = (results.items[i].volumeInfo.publishedDate === undefined ? "" : results.items[i].volumeInfo.publishedDate);

                    $(".search-results").append("<a href='/Readie/summary/" + bookInfo.id + "' class='search-result'><div class='thumbnail'><img src=" + bookInfo.image + "></div><div class='text-info'><h4>" + bookInfo.title + "</h4><p>" + bookInfo.authors + "</p></div></a>")
                }
            });
        })

    };
});

window.addEventListener('click', function(evt) {
    if($(".search-result").length){
        var x = document.querySelector('.search-results');
        if (evt.target != document.querySelector("#search-input")) {
            x.style.display = "none";
        }else{
            x.style.display = "flex";
            console.log("to")
        }
    }
    
});