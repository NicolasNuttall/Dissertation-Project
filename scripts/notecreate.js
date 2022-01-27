$(function () {
    const addNote = () =>{
        var book_id = $("#createNote").data('bookid');
        var note_data = $('#noteText').val();
        $.ajax({
            method: "POST",
            url: "/Readie/ajax/createnote.php",
            dataType: 'json',
            data: {
                book_id: book_id,
                note_data: note_data
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
        .done(function (rtnData) {
            $(".study-notes-container").append('<div class="study-note-item" id ='  + rtnData["NoteID"] + '><h4><span><div class="note-menu"><ul><li><button class="edit-note" data-noteid="' + rtnData["NoteID"] + '">Edit Note</button></li><li><button class="publish-note" data-noteid="' + rtnData["NoteID"] + '">Publish Note</button></li><li><button class="delete-note" data-noteid="' + rtnData["NoteID"] + '">Delete Note</button></li></ul></div><i class="fas fa-ellipsis-v note-menu-icon"></i></span></h4><p class="' +  rtnData["NoteID"]+'">'+ note_data + '</p></div>')
            $('#noteText').val('');
            
        })
    }
    $("body").on("click", '#createNote', function (e) {
        if($('#noteText').val() != ""){
            addNote();
        }
    });

    $('.expandText').on('keydown', function () { //Auto resize for text area
        const txt = this;
        setTimeout(function () {
            txt.style.cssText = 'height:' + txt.scrollHeight + 'px';
        }, 0);
        if ((event.keyCode == 10 || event.keyCode == 13) && event.ctrlKey){
            if($('#noteText').val() != ""){
                addNote();
            }
        }
    });
    
    $(".loadmore").each(function (index) {
        const l = $(this).prev().text();
        const x = l.length;
    
        if (x < 200) {
            $(this).hide();
        }
    })
    
});



