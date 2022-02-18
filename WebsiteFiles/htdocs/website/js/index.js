const chk = document.getElementById("chk");

chk.addEventListener("change", () => {
    const allDomElements = document.querySelectorAll("*");
    allDomElements.forEach((element) => {
        element.classList.toggle("dark");
    });
});
