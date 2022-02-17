const editprofile = document.querySelectorAll(".edit_icon");
const EditIcon = document.querySelector("#EditIcon");
const submitIcon = document.querySelector("#SubmitIcon");
const CloseIcon = document.querySelector("#CloseIcon");
const DpIcon = document.querySelector(".changeimgicon");
const userdetails = document.querySelectorAll(".user_info");
const imgcontainer = document.querySelector(".dp");
const afterimage = document.querySelector(".dp .changeimgicon");
const done = document.querySelector(".header img");
const response = document.querySelector(".response");
const hoverefect = document.querySelectorAll("#profileinfo li");
const ProfileContainer = document.querySelectorAll(".profile_container");
// const Links = document.querySelectorAll("#profileinfo ul li");


let ChangedInputs = [];
let OldInputValues = [];
let IsEdited = false;

// // page changer dynamicaly
// Links.forEach((LinksEle, index) => {
//     LinksEle.addEventListener("click",(e)=>{
//         e.
//     }) 
// })

//clicking event on icon to edit info
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

function MakeFormDisable() {
    IsEdited = false;
    EditIcon.classList.remove("Formactive");
    submitIcon.classList.add("Formactive");
    CloseIcon.classList.add("Formactive");
    DpIcon.classList.add("Formactive");

    userdetails.forEach((detailsInput, index) => {
        detailsInput.setAttribute("disabled", "disabled");
        detailsInput.value = OldInputValues[index];
    })
}

//li hover effect
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
        } else if (e.target.innerText == "Sold Books") {
            ProfileContainer[0].classList.remove("ProfileActive")
            ProfileContainer[1].classList.add("ProfileActive")
            ProfileContainer[2].classList.remove("ProfileActive")
        } else if (e.target.innerText == "Bought Books") {
            ProfileContainer[0].classList.remove("ProfileActive")
            ProfileContainer[1].classList.remove("ProfileActive")
            ProfileContainer[2].classList.add("ProfileActive")
        }
    });
});

//for send data after changed
function SendData() {
    if (IsEdited) {
        var xmlxhr = new XMLHttpRequest();
        xmlxhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.response.endsWith("successfully")) {
                    document.querySelector(".errorMsg").innerText = "profile Successfully Edited";
                    document.querySelector(".response div:first-child").style.backgroundColor = "darkgreen";
                    document.querySelector(".response div:first-child img").src = "img/Happy_icon.svg";
                    response.style.borderColor = "green";
                    MakeFormDisable();
                    response.classList.remove("Formactive");
                    setTimeout(() => {
                        response.classList.add("Formactive");

                    }, 3000);
                } else {
                    document.querySelector(".errorMsg").innerText = this.response;
                    response.classList.remove("Formactive");
                    setTimeout(() => {
                        response.classList.add("active");
                    }, 3000);
                }
            }
        }
        xmlxhr.open("POST", "php/profile.php", true);
        var formD = new FormData(document.querySelector("#ProfileForm"));
        xmlxhr.send(formD);
    }
    console.log(formD)
}

//for logout of user
function logout() {
    let conformation = confirm("Are you really want to LogOut?");
    console.log(conformation)
    if (conformation == true) {
        window.location.assign("http://localhost/BookSharing/profilepage.php?logout=true");
    }
}

function userimgchanger() {
    let imginer = document.getElementById("userimg");
    let imgsource = document.getElementById("profiledp");
    var files = imgsource.files;
    var file = files[0];
    imginer.src = URL.createObjectURL(file);


}