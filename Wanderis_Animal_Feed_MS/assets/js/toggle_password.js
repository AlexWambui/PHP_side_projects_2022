    var state = false;
    function toggle_password(){
        if(state){
            document.getElementById("password").setAttribute("type", "password");
            document.getElementById("eye").style.color='black';
            state = false;
        }
        else{
            document.getElementById("password").setAttribute("type", "text");
            document.getElementById("eye").style.color='rgb(235 0 0)';
            state = true;
        }
    }