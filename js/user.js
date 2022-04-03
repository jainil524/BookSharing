let userID;
let myTable;

$(document).ready(function() {
    myTable = $('.mytable').DataTable({
        paging: true,
        searching: true,
        ordering: true
    });
});

//remove books as admin 
function RemoveBook(e, id) {
    var confirmation = confirm("Are sure to delete Book?");

    if (confirmation) {
        let xmlxhr = new XMLHttpRequest();

        xmlxhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.response.endsWith('Successfully')) {
                    alert(this.response);
                    row = e.path[2];
                    myTable.row(row).remove().draw();
                    // e.path[2].style.display = "none";
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

//verfiy the user by otp for give him book
function VerifyByOtp(currentRow, bookId, userId) {
    let Otp = prompt("Enter the Book PIN:");
    if (isNaN(Otp) == false && Otp.length == 6) {
        let xmlxhr = new XMLHttpRequest();
        xmlxhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.response.endsWith('successfully')) {
                    alert("Book PIN matched");
                    document.querySelector(".mytable").row(currentRow.path[2]).remove().draw();

                } else {
                    alert(this.response);
                }
            }
        }
        xmlxhr.open('POST', 'php/user_proccess.php', true);
        let FormDetails = new FormData();
        FormDetails.append("OTP", Otp);
        FormDetails.append("bookid", bookId);
        xmlxhr.send(FormDetails);
    } else {
        alert("Book pin must be between in 0 - 9 and must have 6 digits");
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
function warnUser(name, id) {
    document.querySelector(".report-pop-up").style.display = "flex";
    document.querySelector(".heading span").innerHTML = name;
    userID = id;

}

function closePopup(e) {
    if (e == "popUp" || e.path[0] == document.querySelector(".report-pop-up")) {
        document.querySelector(".report-pop-up").style.display = "none";
    }
}

function warn() {
    let xmlxhr = new XMLHttpRequest();
    xmlxhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.response);
            closePopup("popUp");
        }
    }
    xmlxhr.open('POST', 'php/warn.php', true);
    let FormDetails = new FormData();
    FormDetails.append("reason", document.querySelector("#reason").value);
    FormDetails.append("userId", userID);
    xmlxhr.send(FormDetails);
}