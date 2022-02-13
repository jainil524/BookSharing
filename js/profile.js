const editprofile = document.querySelectorAll(".edit_icon");
const userdetails = document.querySelectorAll(".user_info");
const imgcontainer = document.querySelector(".dp");
const afterimage = document.querySelector(".dp .changeimgicon");
const done = document.querySelector(".header img");
const response = document.querySelector(".response");
const hoverefect = document.querySelectorAll("#profileinfo li");
const ProfileContainer = document.querySelector("#profile");
let formdata;
let ChangedInputs = [];

//clicking event on icon to edit info
editprofile.forEach((AllIcon, index) => {
    AllIcon.addEventListener("click", (e) => {
        done.style.visibility = "visible";
        userdetails[index].removeAttribute("disabled");
        userdetails[index].style.borderBottom = "2px solid blue";
        userdetails[index].focus();
        userdetails[index].select();
        ChangedInputs.push(userdetails[index]);
        console.log(ChangedInputs);
    });
});
//li hover effect
hoverefect.forEach((lis) => {
    lis.addEventListener("click", (e) => {
        hoverefect.forEach((lis) => {
            lis.classList.remove("active");
        });
        e.target.classList.add("active");
    });
});
//for send data after changed
done.addEventListener("click", () => {
    formdata = new FormData();

    formdata.append("ProfileData", document.querySelector("#profileForm"));
    ajax("profile", response, response, formdata, true);

});

//for logout of user
function logout() {
    let conformation = confirm("Are you really want to LogOut?");
    if (conformation) {
        window.location.assign(
            "http://localhost/BookSharing/profilepage.php?logout=true"
        );
    }
}

function userimgchanger() {
    let imginer = document.getElementById("userimg");
    let imgsource = document.getElementById("profiledp");
    var files = imgsource.files;
    var file = files[0];
    imginer.src = URL.createObjectURL(file);


}