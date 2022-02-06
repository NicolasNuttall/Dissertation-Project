$(function () {
    const submitEntry = () =>{
        var first_question = $('#q1').val();
        var second_question = $('#q2').val();
        $.ajax({
            method: "POST",
            url: "/Readie/ajax/journalsubmit.php",
            dataType: 'json',
            data: {
                q1:first_question ,
                q2:second_question
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
        .done(function (rtnData) {
            location.reload();
        })
    }
    $('body').on('click', "#journal-submit", function () {
        if($('#q1').val()){
            submitEntry();
            console.log("b")
        }
    });

    $('.studyJournal').on('keydown', function () { //Auto resize for text area
        if ((event.keyCode == 10 || event.keyCode == 13) && event.ctrlKey){
            if($('#q1').val() != ""){
                submitEntry();
            }
        }
    });
    
    $("#archive-toggle").on("click",function(){
        $(this).next().toggleClass("d-flex");
    })

    $(document).on("click", ".delete-journal", function(){
        const a = $(this).data('journid');
        $(".page-content").append("<div class='pop-up-box-container'><div class='pop-up-box'><h4>Delete Entry?</h4><p>This can't be undone. Your journal entry will be permanently removed from our archive.</p><button id='delete-journ-button' data-journid='"+ a + "'>Delete</button><button id='cancel-button'>Cancel</button></div></div>");
    
    })

    $(document).on("click",".edit-journal", function(){
        const a = $(this).data('journid');
        const q1 = $("." + a).text();
        const q2 = $("." + a + "2").text();
        $(".page-content").append("<div class='pop-up-box-container'><div class='edit-pop-up-box'><h4>Edit Entry</h4><label for='journ-text-edit-input'></label><textarea  id='journ-text-edit-input'>" + q1 + "</textarea><label for='journ-text-edit-input2'></label><textarea id='journ-text-edit-input2'>" + q2 + "</textarea><button id='edit-journ-button' data-journid='"+ a + "'>Save Changes</button><button id='cancel-button'>Cancel</button></div></div>");
    
    })
    
    $(document).on("click","#edit-journ-button",  function(){
        var journ_id = $(this).data('journid');
        var journ_text = $("#journ-text-edit-input").val();
        var journ_text2 = $("#journ-text-edit-input2").val();
        $.ajax({
            method: "POST",
            url: "/Readie/ajax/editjourn.php",
            dataType: 'json',
            data: {
                journ_id: journ_id,
                journ_text:journ_text,
                journ_text2:journ_text2,
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
        .done(function (rtnData) {
            $(".pop-up-box-container").remove();
            $("." + journ_id).text(journ_text);
            $("." + journ_id + "2").text(journ_text2);

        })
    })
    
    $(document).on("click","#delete-journ-button",  function(){
        var journ_id = $(this).data('journid');

        $.ajax({
            method: "POST",
            url: "/Readie/ajax/deletejourn.php",
            dataType: 'json',
            data: {
                journ_id: journ_id
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
        .done(function (rtnData) {
            $(".pop-up-box-container").remove();
            $("#" + journ_id).remove();
        })
    })
});



