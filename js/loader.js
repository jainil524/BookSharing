const wait = (delay = 0) =>
    new Promise(resolve => setTimeout(resolve, delay));

document.querySelector("body #loader+*").style.display = "none";

document.addEventListener('DOMContentLoaded', () =>
    wait(1770).then(() => {
        document.querySelector("#loader").style.display = "none";
        document.querySelector("body #loader+*").style.display = "flex";

    }));