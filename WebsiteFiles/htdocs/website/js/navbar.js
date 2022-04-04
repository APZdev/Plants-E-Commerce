import {
    calculateItemsAmountInShoppingCart,
    updateNavbarCart,
} from "./utilities.js";

//Dark mode switch
const chk = document.getElementById("chk");
chk.addEventListener("change", () => {
    const allDomElements = document.querySelectorAll("*");
    allDomElements.forEach((element) => {
        element.classList.toggle("dark");
    });
});

function updateNavbarCartCount() {
    let cartProducts = [];
    if (localStorage.getItem("cart_articles") != null) {
        cartProducts = JSON.parse(localStorage.getItem("cart_articles"));
    }
    updateNavbarCart(calculateItemsAmountInShoppingCart(cartProducts));
}
updateNavbarCartCount();
