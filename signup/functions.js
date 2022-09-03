function checkUnique () {
    let username = document.getElementById("username").value;
    
    if (username.length == 0) { 
        document.getElementById("notUnique").style.display = "none";
        return;
    } 
    else {
        let xmlhttp = new XMLHttpRequest();
        //is unique
        xmlhttp.onload = function() {
        if(this.responseText == 1) {
            document.getElementById("notUnique").style.display = "none";
        }
        else{
            document.getElementById("notUnique").style.display = "block";
        }
        };
    xmlhttp.open("GET", "uniqueness.php?q=" + username);
    xmlhttp.send();
    }
}

/*function checkusername() {
    let username = document.getElementById("username").value
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "uniqueness.php?q=" + username);
    xmlhttp.send();
    console.log(xmlhttp.responseText)
    if(xmlhttp.responseText == 1) {
        return true
        //is unique
    }else{
        return false
        //isnt unique
    }
} */

function Submit(){
    let form = document.getElementById("signUpForm");
    let unique;
    let a = document.getElementById("notUnique").style.display;
    if(a == "block"){
        unique = false;
    }else{
        unique = true;
    }
    if(!unique || !form.checkValidity()){
        return;
    }else{
        console.log("submit");
        document.getElementById("signUpForm").submit();
    }
}