$(document).ready(function(){
    $(".icon-item").click(function(){
        $("#icon-select-preview").removeClass();
        let icon = this.children[0];
        let iconClass = icon.classList.value;
        $("#icon-select-preview").addClass(iconClass);
    })
    const iconFlag = 0;
    $(document).click((event) => {
        if (!$(event.target).closest('.icon-select-box').length) {
            $('.icon-select').hide();
        }        
    });
    $("#iconAdd").click(function(){
        $(".icon-select").toggle();
    });
    $("#nav-create").click(function(){
        $("#dashboardCreationWindow").toggle();
    })
    $(document).on('keyup',function(e){
        if(e.key = "23"){
            $(".pop-up-window").hide();
        }
    })
});