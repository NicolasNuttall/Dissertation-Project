
$(document).ready(()=>{

    var timer = null;
    $('#timerStart').click(()=>{
        let h = $("#hour").val();
        let m = $("#min").val();
        let s = $("#sec").val();
        $('#timerStart').toggle();
        $("#timerStop").toggle();
        $(".timer-input").prop('disabled', true);
        startTimer(h, m, s);

    })
    $('#timerStop').click(()=>{
        clearInterval(timer);
        $('#timerStart').toggle();
        $("#timerStop").toggle();
        $(".timer-input").prop('disabled', false);
    })

    function startTimer(h, m, s){
        timer = setInterval(function(){
            if(s > 0){
                s--;
            }
            else if(s == 0 && m > 0){
                s = 59;
                m--;
            }
            else if(m == 0 && h > 0){
                m = 59;
                s= 59;
                h--;
            }
            else if (m == 0, h == 0, s == 0 ){
                finishSession();
            }
            $("#sec").val(s);
            $("#min").val(m);
            $("#hour").val(h);
        }, 1000);
    }   


    const finishSession = () =>{
        console.log("DONE");
        clearInterval(timer);
        $(".page-content").append("<div class='pop-up-box-container'><div class='edit-pop-up-box study-finish'><h4>Session Finished</h4><p>Time's up! All the notes you've created have been saved to the notes page. Meanwhile, you can use the  <span><i class='fa fa-ellipsis-v'></i></span> menu to publish, edit or delete your notes. </p><button id='cancel-button' class='cool'>Cool!</button></div></div>");
    };

})

