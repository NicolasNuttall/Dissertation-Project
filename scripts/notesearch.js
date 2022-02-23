$(document).ready(()=>{
    let typingTimer;             
    let doneTypingInterval = 400;  

    $("#note-search-input").keyup(() => { 
        clearTimeout(typingTimer);
        typingTimer = setTimeout(noteDoneTyping, doneTypingInterval);
    });

    $("#note-search-input").keydown(() => {
        clearTimeout(typingTimer);
    });

    function noteDoneTyping(){
        var query = ($('#note-search-input').val().length == 0) ? "show-all-notes" : $('#note-search-input').val();
        $.ajax({
            method: "POST",
            url: "/Readie/ajax/searchnotes.php",
            dataType:"json",
            data:{
                query:query
            },
            error: function (){
                console.log("A");
            }
        })
        .done(function(results){
            $(".notes-boxes").remove();
            $(".your-notes-container").append("<div class='notes-boxes'></div>");
            if(results){
                jQuery.each(results, function(i, val){
                    if(results[i].liked){
                        $(".notes-boxes").append('<div class="note-box" id="' + results[i].NoteID + '"><i class="like-button far fa-heart active-like-button" id="unsave_note" data-noteid="'+ results[i].NoteID +'" ></i><h4 class="x' + + results[i].NoteID + '">' + results[i].Note_Title + '<span> <div class="note-menu"> <ul> <li> <button class="edit-note" data-noteid="'+ results[i].NoteID +'"> Edit Note </button> </li> <li> <button class="publish-note" data-noteid="'+ results[i].NoteID +'"> Publish Note </button> </li> <li> <button class="delete-note" data-noteid="'+ results[i].NoteID +'"> Delete Note </button> </li> </ul> </div> <i class="fas fa-ellipsis-v note-menu-icon"></i> </span> </h4> <p class="noteauthor">By '+ results[i].Username +'</p> <p class="'+ results[i].NoteID +' note-text">'+ results[i].NoteContent + '}</p> <p class="loadmore">Read More</p> <p class="mt-4"><i>'+ results[i].age +'</i></p> <a href="/Readie/summary/'+ results[i].BookID +'" class="book-info"> <img src="'+ results[i].bookinfo.BookImage +'" alt="" /> </a> </div>');
                    }else{
                        $(".notes-boxes").append('<div class="note-box" id="' + results[i].NoteID + '"><i class="like-button far fa-heart" id="save_note" data-noteid="'+ results[i].NoteID +'" ></i><h4 class="x' + + results[i].NoteID + '">' + results[i].Note_Title + '<span> <div class="note-menu"> <ul> <li> <button class="edit-note" data-noteid="'+ results[i].NoteID +'"> Edit Note </button> </li> <li> <button class="publish-note" data-noteid="'+ results[i].NoteID +'"> Publish Note </button> </li> <li> <button class="delete-note" data-noteid="'+ results[i].NoteID +'"> Delete Note </button> </li> </ul> </div> <i class="fas fa-ellipsis-v note-menu-icon"></i> </span> </h4> <p class="noteauthor">By '+ results[i].Username +'</p> <p class="'+ results[i].NoteID +' note-text">'+ results[i].NoteContent + '}</p> <p class="loadmore">Read More</p> <p class="mt-4"><i>'+ results[i].age +'</i></p> <a href="/Readie/summary/'+ results[i].BookID +'" class="book-info"> <img src="'+ results[i].bookinfo.BookImage +'" alt="" /> </a> </div>');
                    }
                });
            }
        })

    };
});

