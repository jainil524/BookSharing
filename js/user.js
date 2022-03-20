//remove books as admin 
function RemoveBook(e, id) {
    var confirmation = confirm("Are sure to delete Book?");

    if (confirmation) {
        let xmlxhr = new XMLHttpRequest();
        xmlxhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.response.endsWith('Successfully')) {
                    alert(this.response)
                    e.path[2].style.display = "none";
                } else {
                    alert(this.response);
                }
            }
        }
        xmlxhr.open('POST', 'php/user_proccess.php', true);
        let FormDetails = new FormData();
        FormDetails.append("Delete", true);
        FormDetails.append("book_id", id);
        xmlxhr.send(FormDetails);
    }



}

//restrict user from website
function restrictUser(e, id, name) {

    var conformation = confirm("Do you really want to restrict " + name + "?");

    if (conformation) {
        let xmlxhr = new XMLHttpRequest();
        xmlxhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.response.endsWith('Successfully')) {
                    alert("" + name + " has been restricted");
                    e.path[4].querySelector(".status").innerText = "Deactive";
                    console.log(this.response)

                } else {
                    console.log(this.response)
                    alert("Failed to restrict try again");
                }
            }
        }
        xmlxhr.open('POST', 'php/user_proccess.php', true);
        let FormDetails = new FormData();
        FormDetails.append("user_id", id);
        xmlxhr.send(FormDetails);
    }
}

//warn user to their misbehaviour towrods  
function warnUser(id) {

}