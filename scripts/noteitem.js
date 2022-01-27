$(document).ready(function(){
    $(".note-menu-icon").click(function(){
        $(this).prev().toggle();
    }); 

    $("body").on("click", ".loadmore", function(e){
        x = $(this).prev();
        x.toggleClass("loadedtext");
    })
    $(".delete-note").on("click", function(){
        const a = $(this).data('noteid');
        $(".page-content").append("<div class='pop-up-box-container'><div class='pop-up-box'><h4>Delete Note?</h4><p>This can't be undone. Your note will be permanently removed from our archive.</p><button id='delete-button' data-noteid='"+ a + "'>Delete</button><button id='cancel-button'>Cancel</button></div></div>");
    
    })
    $(".publish-note").on("click", function(){
        const a = $(this).data('noteid');
        $(".page-content").append("<div class='pop-up-box-container'><div class='pop-up-box'><h4>Publish Note</h4><input placeholder='Note Title' id='note-title-input' type='text'><button id='publish-button' data-noteid='"+ a + "'>Publish</button><button id='cancel-button'>Cancel</button></div></div>");
    
    })
    $(document).on("click","#cancel-button", function(){
        $(".pop-up-box-container").remove();
    })

    $(document).on("click","#publish-button",  function(){
        var note_id = $(this).data('noteid');
        var note_title = $("#note-title-input").val();
        $.ajax({
            method: "POST",
            url: "/Readie/ajax/publishnote.php",
            dataType: 'json',
            data: {
                note_id: note_id,
                note_title:note_title
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
        .done(function (rtnData) {
            $(".pop-up-box-container").remove();

        })
    })
    
    $(document).on("click","#delete-button",  function(){
        var note_id = $(this).data('noteid');

        $.ajax({
            method: "POST",
            url: "/Readie/ajax/deletenote.php",
            dataType: 'json',
            data: {
                note_id: note_id
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
        .done(function (rtnData) {
            $(".pop-up-box-container").remove();
            $("#" + note_id).remove();
        })
    })
})

window.addEventListener('mouseup', function(e) {
    if($(".study-note-item").length){
        var x = document.querySelector('.note-menu');
        if (event.target != document.querySelector(".note-menu-icon")) {
            x.style.display = "none";
        }
    }
});

//
window.addEventListener('mouseup', function(e) {
    var x = $('timer-changer');
    if (event.target != document.querySelector(".timer-menu")) {
        x.toggleClass("revealed-menu");
    }
});

