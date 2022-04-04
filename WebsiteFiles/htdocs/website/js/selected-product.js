import {
    calculateItemsAmountInShoppingCart,
    updateNavbarCart,
} from "./utilities.js";

//Open modal on click
const addToCartButton = document.querySelector(".add_to_cart_button");
addToCartButton.addEventListener("click", (event) => {
    //Get cart current content
    let cartProducts = [];
    if (localStorage.getItem("cart_articles") != null) {
        cartProducts = JSON.parse(localStorage.getItem("cart_articles"));
    }

    //Get the id of the product we want to add to cart
    const productid = addToCartButton.dataset.id;

    let itemFound = false;
    for (let i = 0; i < cartProducts.length; i++) {
        if (cartProducts[i].id == productid) {
            cartProducts[i].quantity++;
            itemFound = true;
        }
    }

    if (!itemFound) {
        let productInfo = {
            id: productid,
            quantity: "1",
        };
        cartProducts.push(productInfo);
    }

    localStorage.setItem("cart_articles", `${JSON.stringify(cartProducts)}`);
    updateNavbarCart(calculateItemsAmountInShoppingCart(cartProducts));
});
