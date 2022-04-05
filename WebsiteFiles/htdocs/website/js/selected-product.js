import { getCartItemQuantity, modifyCartItemQuantity } from "./utilities.js";

window.addEventListener("load", function () {
    //Open modal on click
    const addToCartButton = document.querySelector(".add_to_cart_button");
    addToCartButton.addEventListener("click", (event) => {
        modifyCartItemQuantity(addToCartButton.dataset.id, Number(getCartItemQuantity(addToCartButton.dataset.id)) + 1);
    });
});
