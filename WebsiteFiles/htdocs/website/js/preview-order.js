import { getCartItemQuantity, modifyCartItemQuantity } from "./utilities.js";

window.addEventListener("load", function () {
    //Open shopping cart modal on click
    function loadShoppingCartData() {
        let cartProducts = [];
        if (localStorage.getItem("cart_articles") != null) {
            cartProducts = JSON.parse(localStorage.getItem("cart_articles"));
        }

        let productIds = "";
        let productQuantities = "";
        for (let i = 0; i < cartProducts.length; i++) {
            productIds += `${cartProducts[i].id}:`;
            productQuantities += `${cartProducts[i].quantity}:`;
        }

        let formData = new FormData();
        formData.append("get_shopping_cart_items_data", "1");
        formData.append("productids", productIds);
        formData.append("quantities", productQuantities);

        fetch("/website/post/shopping-cart-post.php", {
            method: "POST",
            body: formData,
        })
            .then(function (response) {
                return response.text();
            })
            .then(function (body) {
                //-------------------------------------------
                //EVENTS ARE ADDED ASYNC BECAUSE THEY ARE
                //GENERATED ON ELEMENTS RETURN BY THE POST REQUEST
                //-------------------------------------------

                //Fill modal content with server response
                document.querySelector("body").innerHTML += body;

                //Back to shop page on click
                document.querySelector(".subtotal_back_button").addEventListener("click", (event) => {
                    window.location = window.location.origin + "/website/index.php?page=shop";
                });

                //Update shopping cart on + button click
                let quantityAddButtons = document.querySelectorAll(".quantity_add_button");
                quantityAddButtons.forEach(function (addButton) {
                    addButton.addEventListener("click", () => {
                        let productId = addButton.dataset.id;
                        if (getCartItemQuantity(productId) < 100) {
                            modifyCartItemQuantity(productId, Number(getCartItemQuantity(productId)) + 1);
                            updatePageValues(productId, getCartItemQuantity(productId));
                        }
                    });
                });

                //Update shopping cart on - button click
                let quantitySubButtons = document.querySelectorAll(".quantity_remove_button");
                quantitySubButtons.forEach(function (subButton) {
                    subButton.addEventListener("click", () => {
                        let productId = subButton.dataset.id;
                        if (getCartItemQuantity(productId) > 0) {
                            modifyCartItemQuantity(productId, Number(getCartItemQuantity(productId)) - 1);
                            updatePageValues(productId, getCartItemQuantity(productId));
                        }
                    });
                });

                //Update shopping cart on input value change
                let quantityInputs = document.querySelectorAll(".product_item_quantity_input");
                quantityInputs.forEach(function (input) {
                    input.addEventListener("change", (event) => {
                        let productId = input.closest(".product_item").dataset.id;
                        if (event.target.value <= 100) {
                            modifyCartItemQuantity(productId, event.target.value);
                            updatePageValues(productId, getCartItemQuantity(productId));
                        } else {
                            modifyCartItemQuantity(productId, 100);
                            updatePageValues(productId, 100);
                        }
                    });
                });

                //Update shopping cart on - button click
                let deleteItemButtons = document.querySelectorAll(".product_delete_button");
                deleteItemButtons.forEach(function (deleteItemButton) {
                    deleteItemButton.addEventListener("click", () => {
                        const productItem = deleteItemButton.closest(".product_item");
                        let productId = productItem.dataset.id;

                        //Remove cart item from local storage
                        modifyCartItemQuantity(productId, 0);

                        //Delete product item from DOM
                        productItem.parentNode.removeChild(productItem);

                        updatePageValues(productId, getCartItemQuantity(productId));
                    });
                });

                updatePageValues();
            });
    }

    function updatePageValues(productId, quantity) {
        //Update input values
        const input = document.querySelector(`.product_item[data-id='${productId}'] .product_item_quantity_input`);
        if (input != null) input.value = quantity;

        //Update total item price values
        const totalItemPrice = document.querySelector(`.product_item[data-id='${productId}'] .product_item_total_price`);
        if (totalItemPrice != null) totalItemPrice.innerHTML = `$ ${totalItemPrice.dataset.price * quantity}`;

        let subtotalPrice = 0;
        let shippingTotalPrice = 0;

        const productItems = document.querySelectorAll(".product_item");
        productItems.forEach((productItem) => {
            let shippingCost = productItem.dataset.shippingcost;
            let unitPrice = productItem.querySelector(".product_item_total_price").dataset.price;
            let quantity = productItem.querySelector(".product_item_quantity_input").value;

            subtotalPrice += Number(unitPrice) * quantity;
            shippingTotalPrice += Number(shippingCost) * quantity;
        });

        //Update subtotal value
        document.querySelector(`.subtotal_value`).innerHTML = `$ ${subtotalPrice.toFixed(2)}`;
        document.querySelector(`.shipping_value`).innerHTML = `$ ${shippingTotalPrice.toFixed(2)}`;
        document.querySelector(`.total_value`).innerHTML = `$ ${(subtotalPrice + shippingTotalPrice).toFixed(2)}`;

        if (document.querySelector(".products_items_content_container").childElementCount < 2) {
            const footerDesignSpace = document.querySelector(".before_footer_spacer");
            footerDesignSpace.style.height = "10em";
        }
    }

    loadShoppingCartData();
});
