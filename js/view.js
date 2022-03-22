function buy(buyerid = "") {
    if (buyerid == "") {
        window.location.assign("login.php");
    } else {
        let url = window.location.search;
        let id = url.substring(4, 7);
        let errorElement = document.querySelector(".error h5");

        var xmlxhr = new XMLHttpRequest();
        xmlxhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.response.endsWith('login')) {
                    window.location.assign('login.php');
                } else {
                    errorElement.innerText = this.response;
                    errorElement.parentElement.style.display = "flex";
                }
            }
        }
        xmlxhr.open('POST', 'php/book_transaction.php', true);
        let fd = new FormData();
        fd.append("book_id", id);
        fd.append("userID", buyerid);
        xmlxhr.send(fd);
    }
}

function openPopUp(e) {
    let rc = document.querySelector(".rc");
    rc.style.display = "initial";
    rc.style.top = e.clientY + 15 + "px";
    rc.style.left = e.clientX + 15 + "px";
}
document.addEventListener("click", function(e) {
    if (e.path[0] != document.querySelector(".option")) {
        document.querySelector(".rc").style.display = "none";
    }
});

function chat(id) {
    window.location.replace("http://localhost/BookSharing/chat.php?id=" + id)
}

function showReport() {
    document.querySelector(".report-pop-up").style.display = "flex";
}

function closePopup(e) {
    if (e.path[0] == document.querySelector(".report-pop-up")) {
        document.querySelector(".report-pop-up").style.display = "none";
    }
}

function report() {
    let xmlxhr = new XMLHttpRequest();
    xmlxhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.response);

            // if (this.response.endsWith('success')) {

            // } else {

            // }
        }
    }
    xmlxhr.open('POST', 'php\report.php', true);
    let FormDetails = new FormData();
    FormDetails.append("reason", document.querySelector(".pop-up input:checked").value);
    xmlxhr.send(FormDetails);
}