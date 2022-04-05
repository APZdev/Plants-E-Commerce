import { updateNavbarCart } from "./utilities.js";

window.addEventListener("load", function () {
    setTimeout(() => {
        const chk = document.getElementById("chk");

        //Dark mode switch
        chk.addEventListener("change", (event) => {
            localStorage.setItem("isThemeDark", `${chk.checked}`);
            websiteDarkMode(chk.checked);
        });

        let isThemeDark = localStorage.getItem("isThemeDark");
        if (isThemeDark != null) {
            chk.checked = isThemeDark === "true";
            websiteDarkMode(isThemeDark === "true");
        }

        function websiteDarkMode(state) {
            const allDomElements = document.querySelectorAll("*");
            allDomElements.forEach((element) => {
                element.classList.toggle("dark", state);
            });
        }

        updateNavbarCart();
    }, 200);
});
