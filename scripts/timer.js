
$(document).ready(()=>{
    let count = 0;
    let notecount = 0;
    let permcount = 0;
    var timer = null;
    $('#timerStart').click(()=>{
        let h = $("#hour").val();
        let m = $("#min").val();
        let s = $("#sec").val();
        $('#timerStart').toggle();
        $("#timerStop").toggle();
        $(".timer-input").prop('disabled', true);
        startTimer(h, m, s);
        count = 0;
        notecount=0;
    })
    $('#timerStop').click(()=>{
        clearInterval(timer);
        $('#timerStart').toggle();
        $("#timerStop").toggle();
        $(".timer-input").prop('disabled', false);
        updateTimer(count, notecount);
        count = 0;
        notecount=0;
    })

    function startTimer(h, m, s){
        timer = setInterval(function(){
            count++;
            permcount++;
            if(s > 0){
                s--;
            }
            else if(s == 0 && m > 0){
                s = 59;
                m--;
                updateTimer(count, notecount);
                count = 0;
            }
            else if(m == 0 && h > 0){
                m = 59;
                s= 59;
                h--;
            }
            else if (m == 0, h == 0, s == 0 ){
                finishSession(permcount, notecount);
            }
            $("#sec").val(s);
            $("#min").val(m);
            $("#hour").val(h);
        }, 1000);
    }   

    $("body").on("click", '#createNote', function (e) {
        if($('#noteText').val() != ""){
            notecount++;
        }
    });

    $('.expandText').on('keydown', function () { 
        if ((event.keyCode == 10 || event.keyCode == 13) && event.ctrlKey){
            if($('#noteText').val() != ""){
                notecount++;
            }
        }
    });

    const finishSession = (permcount, notecount) =>{
        const oldTime = parseInt($(".timer-changer").attr("data-time"));
        const oldNotes = parseInt($(".note-creation-box").attr("data-noteno"));
        clearInterval(timer);
        updateTimer(count);
        
        let newTime = oldTime + permcount;
        let newNotes = oldNotes + notecount;


        $(".page-content").append("<div class='pop-up-box-container'><div class='edit-pop-up-box study-finish'><h4>Session Finished</h4><p>Time's up! All the notes you've created have been saved to the notes page. Meanwhile, you can use the  <span><i class='fa fa-ellipsis-v'></i></span> menu to publish, edit or delete your notes. </p><p id='time-record'>"+ oldTime +"</p><p id='notes-number'>" + oldNotes +"</p><button id='cancel-button' class='cool'>Cool!</button></div></div>");
        
        $(".timer-changer").attr("data-time", newTime);   
        $(".note-creation-box").attr("data-noteno", newNotes);   
        
        $({ countNum: $("#time-record").html() }).animate({ countNum: newTime }, {
            duration: 2000,
            easing: 'swing',
            step: function () {
            $('#time-record').html(Math.floor(this.countNum) + " seconds <span>+" + permcount + "</span>");
        },
        complete: function () {
            $('#time-record').html(this.countNum + " seconds <span>+" + permcount + "</span>");
        }
        });

        $({ countNum: $("#notes-number").html() }).animate({ countNum: newNotes }, {
            duration: 2000,
            easing: 'swing',
            step: function () {
            $('#notes-number').html(Math.floor(this.countNum) + " notes <span>+" + notecount + "</span>");
        },
        complete: function () {
            $('#notes-number').html(this.countNum + " notes <span>+" + notecount + "</span>");
        }
        });


    };

    const updateTimer = (count) =>{
        let book_id = $(".submit-note").data("bookid");
        $.ajax({
            method:"POST",
            url:"/Readie/ajax/updatetime.php",
            dataType:'json',
            data:{
                book_id:book_id,
                count:count
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
        .done(function(rtnData){
            console.log(rtnData)
        })
    }



})



  


