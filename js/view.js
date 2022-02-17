function buy() {
    let url = window.location.search;
    let id = url.substring(4, 7);
    console.log(id);
    let errorElement = document.querySelector(".error h5");
    let fd = new FormData();
    fd.append("book_id", id);
    ajax("book_transaction", errorElement, errorElement, fd, false);
    errorElement.parentElement.style.display = "flex";
}