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

function usernameMinLength () {
    let username = document.getElementById("username").value;
    if (username.length() < 4) {
        document.getElementById("shortUsername").style.display = "block";
    }
    else {
        document.getElementById("shortUsername").style.display = "none";
    }
}

function passwordMinLength () {
    let password = document.getElementById("password").value;
    if (password.length() < 4) {
        document.getElementById("shortPassword").style.display = "block";
    }
    else {
        document.getElementById("shortPassword").style.display = "none";
    }
}

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