function calculateItemsAmountInShoppingCart() {
    let cartProducts = [];
    if (localStorage.getItem("cart_articles") != null) {
        cartProducts = JSON.parse(localStorage.getItem("cart_articles"));
    }

    let total = 0;
    for (let i = 0; i < cartProducts.length; i++) {
        total += +cartProducts[i].quantity;
    }
    return total;
}

function updateNavbarCart() {
    let number = calculateItemsAmountInShoppingCart();
    const shoppingCart = document.querySelector(".shopping_cart_article_count");

    //Update navbar only if it exists
    if (number > 0) {
        shoppingCart.style.display = "flex";
        shoppingCart.innerHTML = `${number}`;
    } else {
        shoppingCart.style.display = "none";
    }
}

function getCartItemQuantity(productId) {
    //Get current shopping cart content
    let cartProducts = [];
    if (localStorage.getItem("cart_articles") != null) {
        cartProducts = JSON.parse(localStorage.getItem("cart_articles"));
    }

    //Search for item existence
    let itemFound = false;
    for (let i = 0; i < cartProducts.length; i++) {
        if (cartProducts[i].id == productId) {
            itemFound = true;

            //Return quantity when found
            return cartProducts[i].quantity;
        }
    }

    if (!itemFound) {
        return 0;
    }
}

function modifyCartItemQuantity(productId, quantity) {
    if (!isNaN(quantity) && productId != undefined) {
        //Get current shopping cart content
        let cartProducts = [];
        if (localStorage.getItem("cart_articles") != null) {
            cartProducts = JSON.parse(localStorage.getItem("cart_articles"));
        }

        let itemFound = false;
        for (let i = 0; i < cartProducts.length; i++) {
            //Add quantity wether it's positive or negative
            if (cartProducts[i].id == productId) {
                itemFound = true;

                cartProducts[i].quantity = Number(quantity);

                //Remove item from cart if quantity too small
                if (cartProducts[i].quantity <= 0) {
                    cartProducts.splice(i, 1);
                }
            }
        }

        //If the item doesn't exist in shopping cart, create it and set it's quantity to 1
        if (!itemFound) {
            if (quantity > 0) {
                let productInfo = {
                    id: productId,
                    quantity: Number(quantity),
                };
                cartProducts.push(productInfo);
            }
        }

        //Save modified shopping cart to local storage
        localStorage.setItem("cart_articles", `${JSON.stringify(cartProducts)}`);

        updateNavbarCart();
    }
}

export { getCartItemQuantity, modifyCartItemQuantity, updateNavbarCart };
