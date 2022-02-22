function sellBook() {
    let sellForm = document.getElementById("sell-form");
    let error = document.querySelector("#error");
    var xmlhttp = new XMLHttpRequest();

    document.querySelector("input[type=submit]").disabled = true;
    document.querySelector("input[type=submit]").value = "Processing....";
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let data = xmlhttp.response;

            if (data == "Success") {
                document.querySelector("input[type=submit]").disabled = false;
                document.querySelector("input[type=submit]").value = "Sell";
                error.style.display = "block";
                error.style.backgroundColor = "#57c557";
                error.innerHTML = "Book Successfully uploaded";
                document.querySelector("#sell-form").reset();
            } else {
                document.querySelector("input[type=submit]").disabled = false;
                document.querySelector("input[type=submit]").value = "Sell";
                error.style.display = "block";
                error.style.backgroundColor = "#f8d7da";
                error.innerText = this.responseText;
            }
        }
    }

    xmlhttp.open("POST", "php/SellBookprocess.php", true);
    let formD = new FormData(sellForm);
    xmlhttp.send(formD);
}