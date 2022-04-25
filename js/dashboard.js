let main = document.querySelector("#main");
let bookName = document.querySelector("#book-name");
let ShowcategoryCon = document.querySelector(" .filterRemove");
let ShowcategoryName = document.querySelector(" .filterRemove .Category_name");

var bookCard = document.querySelectorAll(".book-container");

function search() {
    let fd = new FormData()
    fd.append("book-name", bookName.value);
    ajax("searchBook", main, main, fd, false)
}

function Category(type) {
    ShowcategoryCon.style.visibility = "visible";
    ShowcategoryCon.style.pointerEvents = "all";

    bookCard.forEach((Book) => {
        if (Book.dataset.category != type) {
            ShowcategoryName.innerText = type.toString();
            Book.style.display = "none";

        } else {
            Book.style.display = "flex";
            ShowcategoryName.innerText = type.toString();
        }
    })
}

function RemoveCategory() {
    ShowcategoryCon.style.visibility = "hidden";
    ShowcategoryCon.style.pointerEvents = "none";

    bookCard.forEach((Book) => {
        if (Book.style.display != "none") return false;

        Book.style.display = "flex";
        ShowcategoryName.innerText = "";
    })
}