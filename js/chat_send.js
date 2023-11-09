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

let chatinter = false;
var xmlxhr = new XMLHttpRequest();

sendmsg.addEventListener("click", () => {
    xmlxhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            msg.value = "";
            msgcontainer.scrollBy(0, msgcontainer.offsetHeight + msgcontainer.scrollHeight + 50);
        }
    }
    xmlxhr.open("POST", "php/chatsend.php", true);
    let formD = new FormData(form);
    xmlxhr.send(formD);
})

function DeleteChat(e, userID, msgID) {
    var confirmation = confirm("Are sure to delete this msg?");
    if (confirmation) {
        xmlxhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.response.endsWith('successfully')) {
                    e.path[3].style.display = "none";
                } else {
                    console.log(this.response)
                }
            }
        }
        xmlxhr.open('POST', 'php/chatsend.php', true);
        let FormDetails = new FormData();
        FormDetails.append("Deleted", true);
        FormDetails.append("msgID", msgID);
        xmlxhr.send(FormDetails);
    }
}

function userid(id) {
    ajax("userview", rusercontainer, rusercontainer, "Rid=" + id, true);

    if (chatinter != false) clearInterval(chatinter);
    form.style.display = "flex";
    chatinter = setInterval(() => {
        ajax("view", msgcontainer, msgcontainer, "", true);
    }, 1000);
}

function usersSearches() {
    xmlxhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.response == "") {
                userlist.innerHTML = "<span class='NoUser'>No User Found</span>";
            } else {
                userlist.innerHTML = JSON.parse(this.response);
            }
        }
    }
    xmlxhr.open('POST', 'php/userview.php', true);
    let FormDetails = new FormData(searchuserform);
    xmlxhr.send(FormDetails);
}

function chttedwithusersection() {
    var hasDisplayNone = (usersshow.offsetHeight === 0 && usersshow.offsetWidth === 0)
    if (hasDisplayNone) {
        usersshow.style.display = "block";
    } else {
        usersshow.style.display = "none";
    }
}