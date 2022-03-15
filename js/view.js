function buy() {
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
    xmlxhr.send(fd);
}