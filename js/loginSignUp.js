var xmlhttp = new XMLHttpRequest();

function change(fileName) {
    var bd = document.getElementById("main");

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);
            bd.innerHTML = this.response;
            bd.style.transform = "rotateY(360deg)";
            bd.style.transition = ".4s ease-in";
        } else {
            bd.style.transform = "rotateY(-360deg)";
            bd.style.transition = "1s ease-out";
        }
    }
    xmlhttp.open("GET", fileName, true);
    xmlhttp.send();
}

function ajaxFunc(fileName, location, formD) {
    var err = document.getElementById("error-msg");
    err.style.transform = "translateY(-100%)";

    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let data = xmlhttp.response;

            if (data == "success") {
                err.style.transform = "translateY(-100%)";
                err.style.display = "none";
                window.location.replace(location);

            } else {
                err.style.transform = "translateY(0%)";
                err.style.display = "block";
                err.innerText = this.responseText;
            }
        }
    }
    xmlhttp.open("POST", "php/" + fileName + ".php", true);
    xmlhttp.send(formD);
}

function loginFunction() {
    var form = document.getElementById("login");
    var err = document.getElementById("error-msg");

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            console.log(this.response);
            if (this.response.endsWith('successUser')) {
                window.location.replace("index.php");
            } else if (this.response.endsWith('successAdmin')) {
                window.location.replace("admindashboard.php");
            } else if (this.response.endsWith('successDelivery')) {
                window.location.replace("deliverys.php");
            } else {
                err.innerText = this.response;
                err.style.transform = "translateY(0%)";
                err.style.display = "block";
                setTimeout(() => {
                    err.style.transform = "translateY(-100%)";
                    err.innerText = "";
                    err.style.display = "none";
                }, 3000);
            }
        }
    }
    xmlhttp.open('POST', 'php/login.php', true);
    let FormDetails = new FormData(form);
    xmlhttp.send(FormDetails);
}

function signUpFunction() {
    var form = document.getElementById("signup");
    ajaxFunc("signup", "login.php", new FormData(form));
}

function passhw() {
    var upass = document.querySelector('.u_password');
    var pimg = document.querySelector('.passshow');

    upass.setAttribute("type", (upass.getAttribute("type") === "text" ? "password" : "text"));
    pimg.setAttribute("src", (pimg.getAttribute("src") === "img/password_not_show.svg" ? "img/password_show.svg" : "img/password_not_show.svg"));
}