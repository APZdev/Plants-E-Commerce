//Render selected image on local image import
image_selector.onchange = (evt) => {
    const [file] = image_selector.files;
    if (file) {
        product_selected_image.src = URL.createObjectURL(file);
        product_selected_image.style.display = "block";
    }
};

$(document).ready(function () {
    //Open modal when clicking on specific product using it's product 'id'
    $(".delete_product").click(function () {
        var productid = $(this).data("id");

        $.ajax({
            url: "/admin-dashboard/post/product-post.php",
            type: "post",
            data: { productid: productid, delete_product_modal: 1 },
            success: function (response) {
                $(".modal_description").html(response);
                $(".delete_product_modal").removeClass("closed");
                $(".delete_product_btn").attr("data-id", productid);
            },
        });
    });

    //Close modal on click
    $(".close_modal_btn").click(function () {
        $(".delete_product_modal").addClass("closed");
    });

    //Request deletion of a product from database
    $(".delete_product_btn").click(function () {
        var productid = $(this).data("id");

        $.ajax({
            url: "/admin-dashboard/post/product-post.php",
            type: "post",
            data: { productid: productid, delete_product: 1 },
            success: function (response) {
                $(".delete_product_modal").addClass("closed");
            },
        });
    });
});
