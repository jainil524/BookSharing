let main = document.querySelector("#main");
let bookName = document.querySelector("#book-name");

function search() {
    let fd = new FormData()
    fd.append("book-name", bookName.value);
    ajax("searchBook", main, main, fd, false)
}

function Category(type) {
    var bookCard = document.querySelectorAll(".book-container");
    let ShowcategoryCon = document.querySelector(" .filterRemove");
    let ShowcategoryName = document.querySelector(" .filterRemove .Category_name");

    bookCard.forEach((ele, index) => {
        ShowcategoryCon.style.visibility = "visible";
        ShowcategoryCon.style.pointerEvents = "all";
        if (ele.dataset.category != type) {
            ShowcategoryName.innerText = type.toString();
            ele.style.display = "none";

        } else {
            ele.style.display = "flex";
            ShowcategoryName.innerText = type.toString();
        }
    })
}

function RemoveCategory() {
    var bookCon = document.querySelectorAll(".book-container");
    let ShowcategoryCon = document.querySelector(".filterRemove");
    let ShowcategoryName = document.querySelector(".filterRemove .Category_name");

    bookCon.forEach((e, index) => {
        e.style.display = "flex";
        ShowcategoryCon.style.visibility = "hidden";
        ShowcategoryCon.style.pointerEvents = "none";

    })
}