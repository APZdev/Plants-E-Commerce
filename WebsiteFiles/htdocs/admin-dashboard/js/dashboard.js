//Render selected image on local image import
image_selector.onchange = (evt) => {
    const [file] = image_selector.files;
    if (file) {
        product_selected_image.src = URL.createObjectURL(file);
        product_selected_image.style.display = "block";
    }
};

$(document).ready(function () {
    //Close modal on click
    $(".close_modal_btn").click(function () {
        $(".product_modal").addClass("closed");
    });

    //Open product deletion modal when clicking on specific product using it's product 'id'
    $(".delete_product").click(function () {
        var productid = $(this).data("id");
        $(".delete_product_modal_content_container").removeClass("hide");
        $(".modify_product_modal_content_container").addClass("hide");

        $.ajax({
            url: "/admin-dashboard/post/product-post.php",
            type: "post",
            data: { delete_product_modal: 1, productid: productid },
            success: function (response) {
                $(".modal_description").html(response);
                $(".product_modal").removeClass("closed");
                $(".delete_product_btn").attr("data-id", productid);
            },
        });
    });

    //Request deletion of a product from database
    $(".delete_product_btn").click(function () {
        var productid = $(this).data("id");

        $.ajax({
            url: "/admin-dashboard/post/product-post.php",
            type: "post",
            data: { delete_product: 1, productid: productid },
            success: function (response) {
                $(".product_modal").addClass("closed");
            },
        });
    });

    //Open product edit modal
    $(".modify_product").click(function () {
        var productid = $(this).data("id");
        $(".delete_product_modal_content_container").addClass("hide");
        $(".modify_product_modal_content_container").removeClass("hide");

        $.ajax({
            url: "/admin-dashboard/post/product-post.php",
            type: "post",
            data: { modify_product_modal: 1, productid: productid },
            success: function (response) {
                $(".modal_content").html(response);
                $(".product_modal").removeClass("closed");
                $(".modify_product_btn").attr("data-id", productid);
            },
        });
    });

    //Request deletion of a product from database
    $(".modify_product_btn").click(function () {
        let productid = $(this).data("id");
        let inputParents = $(".modify_product_modal_container");
        let name = inputParents.children('input[name="name"]').val();
        let shortdesc = inputParents.children('input[name="shortdesc"]').val();
        let longdesc = inputParents.children('input[name="longdesc"]').val();
        let excltaxprice = inputParents
            .children('input[name="excltaxprice"]')
            .val();
        let stock = inputParents.children('input[name="stock"]').val();
        let tax = inputParents.children('input[name="tax"]').val();
        let category = inputParents.children('input[name="category"]').val();

        $.ajax({
            url: "/admin-dashboard/post/product-post.php",
            type: "post",
            data: {
                modify_product: 1,
                productid: productid,
                name: name,
                shortdesc: shortdesc,
                longdesc: longdesc,
                excltaxprice: excltaxprice,
                stock: stock,
                tax: tax,
                category: category,
            },
            success: function (response) {
                $(".product_modal").addClass("closed");
            },
        });
    });
});
