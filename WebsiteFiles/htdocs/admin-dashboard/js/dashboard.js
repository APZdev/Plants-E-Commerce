//Reduce DOM query length using a fake jquery syntax
const $ = document.querySelector.bind(document);

//Render selected image on local image import
image_selector.onchange = (evt) => {
    const [file] = image_selector.files;
    if (file) {
        product_selected_image.src = URL.createObjectURL(file);
        product_selected_image.style.display = "block";
    }
};

//Close modal on click
const closeModal = document.querySelectorAll(".close_modal_btn");
closeModal.forEach((button) => {
    button.addEventListener("click", (event) => {
        $(".product_modal").classList.add("closed");
    });
});

//Open product deletion modal when clicking on specific product using it's product 'id'
const deleteButtons = document.querySelectorAll(".delete_product");
deleteButtons.forEach((deleteButton) => {
    deleteButton.addEventListener("click", (event) => {
        const productid = deleteButton.dataset.id;
        $(".delete_product_modal_content_container").classList.remove("hide");
        $(".modify_product_modal_content_container").classList.add("hide");

        let formData = new FormData();
        formData.append("delete_product_modal", "1");
        formData.append("productid", productid);

        fetch("/admin-dashboard/post/product-post.php", {
            method: "POST",
            body: formData,
        })
            .then(function (response) {
                return response.text();
            })
            .then(function (body) {
                $(".modal_description").innerHTML = body;
                $(".product_modal").classList.remove("closed");
                $(".delete_product_btn").setAttribute("data-id", productid);
            });
    });
});

//Request deletion of a product from database
$(".delete_product_btn").addEventListener("click", (event) => {
    const productid = $(".delete_product_btn").dataset.id;

    let formData = new FormData();
    formData.append("delete_product", "1");
    formData.append("productid", productid);

    fetch("/admin-dashboard/post/product-post.php", {
        method: "POST",
        body: formData,
    }).then(function (response) {
        $(".product_modal").classList.add("closed");
        setTimeout(function () {
            location.reload();
        }, 200);
    });
});

//Open product modification modal
const editButtons = document.querySelectorAll(".modify_product");
editButtons.forEach((editButton) => {
    editButton.addEventListener("click", (event) => {
        var productid = editButton.dataset.id;
        $(".delete_product_modal_content_container").classList.add("hide");
        $(".modify_product_modal_content_container").classList.remove("hide");

        let formData = new FormData();
        formData.append("modify_product_modal", "1");
        formData.append("productid", productid);

        fetch("/admin-dashboard/post/product-post.php", {
            method: "POST",
            body: formData,
        })
            .then(function (response) {
                return response.text();
            })
            .then(function (body) {
                $(".modal_content").innerHTML = body;
                $(".product_modal").classList.remove("closed");
                $(".modify_product_btn").setAttribute("data-id", productid);
            });
    });
});

//Save edited prodduct info to database
$(".modify_product_btn").addEventListener("click", (event) => {
    const productid = $(".modify_product_btn").dataset.id;
    const inputParents = $(".modify_product_modal_container");
    let name = inputParents.querySelector('input[name="name"]').value;
    let shortdesc = inputParents.querySelector('input[name="shortdesc"]').value;
    let longdesc = inputParents.querySelector('input[name="longdesc"]').value;
    let excltaxprice = inputParents.querySelector(
        'input[name="excltaxprice"]'
    ).value;
    let stock = inputParents.querySelector('input[name="stock"]').value;
    let tax = inputParents.querySelector('input[name="tax"]').value;
    let category = inputParents.querySelector('input[name="category"]').value;

    let formData = new FormData();
    formData.append("modify_product", "1");
    formData.append("productid", productid);
    formData.append("name", name);
    formData.append("shortdesc", shortdesc);
    formData.append("longdesc", longdesc);
    formData.append("excltaxprice", excltaxprice);
    formData.append("stock", stock);
    formData.append("tax", tax);
    formData.append("category", category);

    fetch("/admin-dashboard/post/product-post.php", {
        method: "POST",
        body: formData,
    }).then(function (response) {
        $(".product_modal").classList.add("closed");
        setTimeout(function () {
            location.reload();
        }, 200);
    });
});
