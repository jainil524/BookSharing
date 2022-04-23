//to hide every this exept loader
document.querySelector("body #loader+*").style.display = "none";
document.querySelector("body").style.overflow = "hidden";

//to hide loader when page load completly
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        document.querySelector("#loader").style.display = "none";

        document.querySelector(".imgContainer .FirstWave").style.animation = "unset";
        document.querySelector(".imgContainer .secondWave").style.animation = "unset";

        document.querySelector("body #loader+*").style.display = "flex";
        document.querySelector("body").style.overflow = "auto";

    }, 1770);

});