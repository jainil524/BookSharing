const sendmsg = document.getElementById('sendMSG');
const searchuserform = document.getElementById('usertosearch');
const usersection = document.getElementsByClassName('chattedwithusersection')[0];
const form = document.getElementById('msgsendinginput');
let msgcontainer = document.getElementById('msgcontainer');
let rusercontainer = document.querySelector('.ConUserInfo');
const msg = document.getElementById('inputmsg');
const emptyspace = document.querySelector('.nonespace');
const usersshow = document.querySelector('.chattedwithusersection');
const userlist = document.querySelector('#allusers');

sendmsg.addEventListener("click", sendrequest);
let chatinter = false;
var xmlxhr = new XMLHttpRequest();

function sendrequest() {
    xmlxhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            msg.value = "";
            msgcontainer.scrollBy(0, msgcontainer.offsetHeight + msgcontainer.scrollHeight + 50);
        }
    }
    xmlxhr.open("POST", "php/chatsend.php", true);
    let formD = new FormData(form);
    xmlxhr.send(formD);
}

function userid(id) {
    var rid = "Rid=" + id;
    ajax("userview", rusercontainer, rusercontainer, rid, true);

    if (chatinter != false) clearInterval(chatinter);
    form.style.display = "flex";
    chatinter = setInterval(() => {
        ajax("view", msgcontainer, msgcontainer, "", true);
    }, 1000);
}

function usersSearches() {
    let xmlxhr = new XMLHttpRequest();
    xmlxhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.response == "") {
                userlist.innerHTML = "<span class='NoUser'>No User Found</span>";
            } else {
                userlist.innerHTML = this.responseText;
            }
        }
    }
    xmlxhr.open('POST', 'php/userview.php', true);
    let FormDetails = new FormData(searchuserform);
    xmlxhr.send(FormDetails);
}

function firstfocuser() {
    usersection.querySelector(".user").click();
}

function chttedwithusersection() {
    if (usersshow.style.display == "none") {
        usersshow.style.display = "block";
    } else {
        usersshow.style.display = "none";
    }
}