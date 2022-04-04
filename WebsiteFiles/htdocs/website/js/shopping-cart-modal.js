//Open shopping cart modal on click
document
    .querySelector(".shopping_cart_container")
    .addEventListener("click", (event) => {
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
                document.querySelector(
                    ".shopping_cart_modal_container_content_body"
                ).innerHTML = body;
                document
                    .querySelector(".shopping_cart_modal_container")
                    .classList.remove("closed");

                document
                    .querySelector(".shopping_cart_place_order_button")
                    .addEventListener("click", (event) => {
                        window.location =
                            window.location.origin +
                            "/website/pages/preview-order.php";
                    });
            });
    });

document
    .querySelector(".close_modal_background")
    .addEventListener("click", (event) => {
        document
            .querySelector(".shopping_cart_modal_container")
            .classList.add("closed");
    });
