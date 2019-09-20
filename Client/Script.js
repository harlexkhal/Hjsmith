function LoginForm() {
    if (document.getElementsByClassName("Modal-Login")[0].style.display === "block") {
        document.getElementsByClassName("Modal-Login")[0].style.display = "none";

        for (i = 0; i < 5; i++) {
            document.getElementsByClassName("container-fluid")[i].style.filter = "blur(0)";
        }

        document.getElementsByClassName(" navbar")[0].style.filter = "blur(0)";
    }

    else {
        document.getElementsByClassName("Modal-Login")[0].style.display = "block";

        for (i = 0; i < 5; i++) {
            document.getElementsByClassName("container-fluid")[i].style.filter = "blur(5px)";
        }

        document.getElementsByClassName(" navbar")[0].style.filter = "blur(5px)";
    }

}

function DropDownClick(x) {
    if (document.getElementsByClassName("custom-dropdown")[x].style.display === "block")
        document.getElementsByClassName("custom-dropdown")[x].style.display = "none";
    else
        document.getElementsByClassName("custom-dropdown")[x].style.display = "block"
}

var myVar;

function BufferLoad() {
    myVar = setTimeout(showPage, 3000);
}

function showPage() {
    document.getElementById("loader").style.display = "none";
   
    for (i = 0; i < 8; i++) {
        document.getElementsByClassName("img")[i].style.display = "block";
    }
    for (i = 0; i < 5; i++) {
        document.getElementsByClassName("container-fluid")[i].style.display = "block";
    }
}