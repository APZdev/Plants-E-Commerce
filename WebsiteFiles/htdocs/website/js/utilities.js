function calculateItemsAmountInShoppingCart(cartProducts) {
    let total = 0;
    for (let i = 0; i < cartProducts.length; i++) {
        total += +cartProducts[i].quantity;
    }
    return total;
}

function updateNavbarCart(number) {
    const shoppingCart = document.querySelector(".shopping_cart_article_count");

    if (number > 0) {
        shoppingCart.style.display = "flex";
        shoppingCart.innerHTML = `${number}`;
    } else {
        shoppingCart.style.display = "none";
    }
}

export { calculateItemsAmountInShoppingCart, updateNavbarCart };
