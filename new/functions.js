function contentCounter() {
    let content = document.getElementById("content").value;
    var length = content.length;
    document.getElementById("contentCounter").innerHTML = length.toString()+"/512";
    if (length < 400) {
        document.getElementById("contentCounter").style.color = "black";
        document.getElementById("contentCounter").style.fontWeight = "normal";
    }
    else {
        document.getElementById("contentCounter").style.color = "red";
        document.getElementById("contentCounter").style.fontWeight = "bold";
    }
}
function urlCounter() {
    let content = document.getElementById("url").value;
    var length = content.length;
    document.getElementById("urlCounter").innerHTML = length.toString()+"/512";
    if (length < 400) {
        document.getElementById("urlCounter").style.color = "black";
        document.getElementById("urlCounter").style.fontWeight = "normal";
    }
    else {
        document.getElementById("urlCounter").style.color = "red";
        document.getElementById("urlCounter").style.fontWeight = "bold";
    }
}