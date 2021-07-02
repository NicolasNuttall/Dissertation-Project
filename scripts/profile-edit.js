function preventDefaults (e) {
    e.preventDefault()
    e.stopPropagation()
  };
function AvatarEdit(inp, ava){
    const file = inp.files[0];
    if(file){
      const reader = new FileReader();
      reader.addEventListener("load", function(){
        document.getElementById(ava).setAttribute("style", "background-image: url(" + this.result + ")");
      });
      reader.readAsDataURL(file);
    }
  };

  