window.addEventListener("load", function () {
    let sliderOne = document.getElementById("slider-1");
    let sliderTwo = document.getElementById("slider-2");
    let displayValOne = document.getElementById("range-1");
    let displayValTwo = document.getElementById("range-2");
    let minGap = 10;
    let sliderTrack = document.querySelector(".slider-track");
    let sliderMaxValue = sliderOne.max;

    document.querySelector(".shop_now_button").addEventListener("click", (event) => {
        document.querySelector(".filters_sidebar_container").scrollIntoView({
            behavior: "smooth",
        });
    });

    sliderOne.addEventListener("input", () => {
        slideOne();
    });

    sliderTwo.addEventListener("input", () => {
        slideTwo();
    });

    function slideOne() {
        if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
            sliderOne.value = parseInt(sliderTwo.value) - minGap;
        }
        displayValOne.textContent = sliderOne.value + " $";
        placePriceTextAboveCursor();
    }

    function slideTwo() {
        if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
            sliderTwo.value = parseInt(sliderOne.value) + minGap;
        }
        displayValTwo.textContent = sliderTwo.value + " $";
        placePriceTextAboveCursor();
    }

    function placePriceTextAboveCursor() {
        let firstRangePercentage = (sliderOne.value / sliderOne.max) * 100;
        displayValOne.style.marginLeft = `${firstRangePercentage - 11 * (firstRangePercentage / 100)}%`;

        let secondRangePercentage = (sliderTwo.value / sliderTwo.max) * 100;
        displayValTwo.style.marginLeft = `${secondRangePercentage - 11 * (secondRangePercentage / 100)}%`;
    }

    slideOne();
    slideTwo();

    function searchProductWithKeyword(keywordsString) {
        let keywords = keywordsString.split(" ");
        let finalKeywords = "";

        for (let i = 0; i < keywords.length; i++) {
            if (i != keywords.length - 1) finalKeywords += keywords[i] + ":";
            else finalKeywords += keywords[i];
        }

        let formData = new FormData();
        formData.append("shop_filtered_product_fetch", "1");
        formData.append("keywords", finalKeywords);

        fetch("/website/post/shop-post.php", {
            method: "POST",
            body: formData,
        })
            .then(function (response) {
                return response.text();
            })
            .then(function (body) {
                //Fill modal content with server response
                document.querySelector(".products_grid_container").innerHTML = body;
            });
    }

    //Search to display products on the page
    searchProductWithKeyword("");

    let keywordSearchBar = document.querySelector(".sort_search_bar");
    keywordSearchBar.addEventListener("input", (event) => {
        searchProductWithKeyword(keywordSearchBar.value);
    });
});
