

function updateThumbnail(thumbinput, thumImage){
    const file = thumbinput.files[0];
    if(file){
        const reader = new FileReader();
        reader.addEventListener("load", function(){
        document.getElementById(thumImage).setAttribute("src", this.result);
        });

        reader.readAsDataURL(file);
    }
};

function removeTag(elm){
    let deletedTag = elm.closest('.tag');
    let tagValue = $(elm).closest('.tag').text();
    $("#tagArray").val($("#tagArray").val().replace(tagValue,''));
    deletedTag.remove();
}

$('.expandText').on('keydown',function(){//Auto resize for text area
    const txt = this;
    setTimeout(function(){

        txt.style.cssText = 'height:' + txt.scrollHeight + 'px';
    },0);
});
 
$('#upload-form input').on('keyup keypress', function(e) {
    var keyCode = e.key || e.which;
    if (keyCode === 'Enter') { 
      e.preventDefault();
      return false;
    }
});

$("#tagInput").on('keyup',function(event) {
    const tagValue = this.value;
    const randomHue = Math.round(Math.random() * (255 - 0) + 0);
    $(this).val($(this).val().replace(/[^a-z0-9]/gi, ''));
    if (event.key ==='Enter' && this.value != '') {
        $("#tags").append('<div style="background-color:hsl(' + randomHue + ',30%,80%);"class="tag"><p>' + tagValue + '<span><i class="far fa-times-circle x" onclick="removeTag(this)"></i></span></p></div>')
        $("#tagArray").val($("#tagArray").val() + this.value + "?");  
        this.value='';
    }
});

