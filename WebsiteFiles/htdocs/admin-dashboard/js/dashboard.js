//Render selected image on local image import
image_selector.onchange = (evt) => {
    const [file] = image_selector.files;
    if (file) {
        product_selected_image.src = URL.createObjectURL(file);
        product_selected_image.style.display = "block";
    }
};
