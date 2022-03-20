const editprofile = document.querySelectorAll(".edit_icon");
const EditIcon = document.querySelector("#EditIcon");
const submitIcon = document.querySelector("#SubmitIcon");
const CloseIcon = document.querySelector("#CloseIcon");
const DpIcon = document.querySelector(".changeimgicon");
const userdetails = document.querySelectorAll(".user_info");
const imgcontainer = document.querySelector(".dp");
const afterimage = document.querySelector(".dp .changeimgicon");
const done = document.querySelector(".header img");
const hoverefect = document.querySelectorAll("#profileinfo .slider");
const ProfileContainer = document.querySelectorAll(".profile_container");

let ChangedInputs = [];
let OldInputValues = [];
let NewInputValues = [];
let IsEdited = false;
let IsSubmited = false;

var Msgresponse = document.querySelector(".response");

//hover effect and container change for all option at side bar
hoverefect.forEach((lis) => {
    lis.addEventListener("click", (e) => {
        hoverefect.forEach((lis) => {
            lis.classList.remove("active");
        });
        e.target.classList.add("active");
        if (e.target.innerText == "Profile") {
            ProfileContainer[0].classList.add("ProfileActive")
            ProfileContainer[1].classList.remove("ProfileActive")
            ProfileContainer[2].classList.remove("ProfileActive")
            ProfileContainer[3].classList.remove("ProfileActive")
        } else if (e.target.innerText == "Sell Books") {
            ProfileContainer[0].classList.remove("ProfileActive")
            ProfileContainer[1].classList.add("ProfileActive")
            ProfileContainer[2].classList.remove("ProfileActive")
            ProfileContainer[3].classList.remove("ProfileActive")
        } else if (e.target.innerText == "Sold Books") {
            ProfileContainer[0].classList.remove("ProfileActive")
            ProfileContainer[1].classList.remove("ProfileActive")
            ProfileContainer[2].classList.add("ProfileActive")
            ProfileContainer[3].classList.remove("ProfileActive")
        } else if (e.target.innerText == "Bought Books") {
            ProfileContainer[0].classList.remove("ProfileActive")
            ProfileContainer[1].classList.remove("ProfileActive")
            ProfileContainer[2].classList.remove("ProfileActive")
            ProfileContainer[3].classList.add("ProfileActive")
        }
    });
});


//logout user from current account
function logout() {
    let conformation = confirm("Are you really want to Log out?");
    if (conformation) {
        window.location.assign(
            "http://localhost/BookSharing/profilepage.php?logout=true"
        );
    } else {
        return false;
    }
}

//make form editable to update the information  
function MakeFormEditable() {
    IsEdited = true;
    EditIcon.classList.add("Formactive");
    submitIcon.classList.remove("Formactive");
    CloseIcon.classList.remove("Formactive");
    DpIcon.classList.remove("Formactive");

    userdetails.forEach((detailsInput, index) => {
        detailsInput.removeAttribute("disabled");
        OldInputValues.push(detailsInput.value);
    })
    userdetails[1].focus();
}

//make form disable if user don't want to edit details  
function MakeFormDisable() {

    EditIcon.classList.remove("Formactive");
    submitIcon.classList.add("Formactive");
    CloseIcon.classList.add("Formactive");
    DpIcon.classList.add("Formactive");

    userdetails.forEach((detailsInput, index) => {
        detailsInput.setAttribute("disabled", "disabled");
        if (IsEdited == true || IsSubmited == false) {
            detailsInput.value = OldInputValues[index];
            IsSubmited = false;
            IsEdited = false;
        }
    })
}

//show user a preview of an image before user uploaded it
function ImgPreview() {
    let imginer = document.getElementById("userimg");
    let imgsource = document.getElementById("profiledp");
    var files = imgsource.files;
    var file = files[0];
    imginer.src = URL.createObjectURL(file);
}


//sending the data to php page for update the details of user
function SendData() {
    if (IsEdited) {
        IsSubmited = true;
        var xmlxhr = new XMLHttpRequest();
        xmlxhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var Msgresponse = document.querySelector(".response");
                if (this.response.endsWith("successfully")) {
                    document.querySelector(".errorMsg").innerText = "profile Successfully Edited";
                    document.querySelector(".response div:first-child").style.backgroundColor = "darkgreen";
                    document.querySelector(".response div:first-child img").src = "img/Happy_icon.svg";
                    Msgresponse.style.borderColor = "green";
                    IsSubmited = false;
                    MakeFormDisable();
                    Msgresponse.classList.remove("Formactive");
                    setTimeout(() => { Msgresponse.classList.add("Formactive"); }, 3000);
                } else {
                    document.querySelector(".errorMsg").innerText = this.response;
                    Msgresponse.classList.remove("Formactive");
                    setTimeout(() => { Msgresponse.classList.add("Formactive"); }, 3000);
                }
            }
        }
        xmlxhr.open("POST", "php/profile.php", true);
        var formD = new FormData(document.querySelector("#ProfileForm"));
        xmlxhr.send(formD);
    }
    console.log(formD)
}

//update of the owner's information of an perticuler book 
function EditBookInfo(e, BookId) {
    window.location.assign("SellBook.php?Bid=" + BookId);
}

//delete the book 
function DeleteBook(e, BookId) {
    var confirmation = confirm("Do you really want to delete book?");
    if (confirmation) {
        var xmlxhr = new XMLHttpRequest();
        xmlxhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var Msgresponse = document.querySelector(".response");

                if (this.response.endsWith('successfully')) {
                    e.path[3].style.display = "none";
                    document.querySelector(".errorMsg").innerText = "Book Deleted Successfully";
                    document.querySelector(".response div:first-child").style.backgroundColor = "darkgreen";
                    document.querySelector(".response div:first-child img").src = "img/Happy_icon.svg";
                    Msgresponse.style.borderColor = "green";
                    setTimeout(() => { Msgresponse.classList.add("Formactive"); }, 3000);
                    Msgresponse.classList.remove("Formactive");
                    MakeFormDisable();
                } else {
                    document.querySelector(".errorMsg").innerText = this.response;
                    Msgresponse.classList.remove("Formactive");
                    setTimeout(() => { Msgresponse.classList.add("Formactive"); }, 3000);
                }
            }
        }
        xmlxhr.open('POST', 'php/profile.php', true);
        let FormDetails = new FormData();
        FormDetails.append("DeleteRequest", true);
        FormDetails.append("Book_id", BookId);
        xmlxhr.send(FormDetails);
    }
}

//for delete the account of current user
function DeleteAccount() {
    var password = prompt("Enter you account password");
    if (!password) {
        return false;
    } else if (password == null) {
        var password = prompt("Enter you account password");
    } else {
        var xmlxhr = new XMLHttpRequest();
        xmlxhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.response.trim() == "success".trim()) {
                    console.log(this.responseText.trim())
                    window.location.replace("login.php");
                } else {
                    document.querySelector(".errorMsg").innerText = this.response;
                    console.log(this.responseText.trim() == "success".trim())
                    Msgresponse.classList.remove("Formactive");
                    setTimeout(() => { Msgresponse.classList.add("Formactive"); }, 3000);
                }
            }
        }
        xmlxhr.open('POST', 'php/deleteAcc.php', true);
        let FormDetails = new FormData();
        FormDetails.append("password", password);
        xmlxhr.send(FormDetails);
    }
}