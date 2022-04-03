window.onload = function () {
    slideOne();
    slideTwo();
};

let sliderOne = document.getElementById("slider-1");
let sliderTwo = document.getElementById("slider-2");
let displayValOne = document.getElementById("range-1");
let displayValTwo = document.getElementById("range-2");
let minGap = 10;
let sliderTrack = document.querySelector(".slider-track");
let sliderMaxValue = document.getElementById("slider-1").max;

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
    displayValOne.style.marginLeft = `${
        firstRangePercentage - 11 * (firstRangePercentage / 100)
    }%`;

    let secondRangePercentage = (sliderTwo.value / sliderTwo.max) * 100;
    displayValTwo.style.marginLeft = `${
        secondRangePercentage - 11 * (secondRangePercentage / 100)
    }%`;
}

$(".shop_now_button").addEventListener("click", (event) => {
    $(".filters_sidebar_container").scrollIntoView({
        behavior: "smooth",
    });
});
