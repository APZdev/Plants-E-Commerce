window.addEventListener("load", function () {
    //WARNING : Adding a timeout fix the bug where the shopping cart is not empty,
    //but idk why this bug happens since it's SSR and i use defer script loading
    setTimeout(() => {
        //Open shopping cart modal on click
        document.querySelector(".shopping_cart_container").addEventListener("mouseenter", (event) => {
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
            formData.append("get_shopping_cart_items_data_modal", "1");
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
                    //Fill modal content with server response
                    document.querySelector(".shopping_cart_modal_container_content_body").innerHTML = body;
                    document.querySelector(".shopping_cart_modal_container").classList.remove("closed");

                    //Preview order button click event
                    document.querySelector(".shopping_cart_place_order_button").addEventListener("click", (event) => {
                        window.location = window.location.origin + "/website/pages/preview-order.php";
                    });
                });
        });

        //Close modal if mouse leave the modal
        document.querySelector(".shopping_cart_modal_container_content_body").addEventListener("mouseleave", (event) => {
            document.querySelector(".shopping_cart_modal_container").classList.add("closed");
        });

        //Close shopping cart modal
        document.querySelector(".close_modal_background").addEventListener("click", (event) => {
            document.querySelector(".shopping_cart_modal_container").classList.add("closed");
        });
    }, 250);
});
