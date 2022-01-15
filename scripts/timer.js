
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
    };

})

