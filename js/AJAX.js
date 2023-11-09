async function ajax(filename, successElement, errorElement, formdata, isContentType) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let data = this.response;
            if (data == "success") {
                successElement.innerHTML = JSON.parse(this.response);
            } else {
                errorElement.innerHTML = JSON.parse(this.response);
            }
        }
    }
    xmlhttp.open("POST", "php/" + filename + ".php", true);
    if (isContentType) {
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    }
    xmlhttp.send(formdata);
}