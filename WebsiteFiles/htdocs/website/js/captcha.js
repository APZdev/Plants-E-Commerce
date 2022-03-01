const captchaModal = document.querySelector(".captcha_puzzle_container_modal");
const captchaModalButton = document.querySelector(
    ".captcha_checkbox_title_container"
);
const captchaCheckbox = document.querySelector(".captcha_checkbox");
const captchaCheckMark = document.querySelector(".captcha_check_icon");

const firstContainer = document.querySelector(".first_container");
const secondContainer = document.querySelector(".second_container");
const thirdContainer = document.querySelector(".third_container");
const fourthContainer = document.querySelector(".fourth_container");

const captchaDraggablesContainers = document.querySelectorAll(
    ".draggable_container, .starting_draggable_container"
);
const captchaDraggables = document.querySelectorAll(".draggables");

captchaModalButton.addEventListener("click", openModal);

function openModal() {
    captchaModal.classList.remove("hide");
}

captchaDraggables.forEach((draggable) => {
    draggable.innerHTML = Math.floor(Math.random() * 100);

    draggable.addEventListener("dragstart", () => {
        draggable.classList.add("dragging");
    });

    draggable.addEventListener("dragend", () => {
        draggable.classList.remove("dragging");
        checkGameState(); //Check if the captcha puzzle is completed
    });
});

captchaDraggablesContainers.forEach((container) => {
    container.addEventListener("dragover", (e) => {
        e.preventDefault();

        const draggable = document.querySelector(".dragging");
        //Drag inside only if the container is free
        if (!container.hasChildNodes()) {
            draggable.parentNode.innerHTML = ""; //Remove any content inside
            container.appendChild(draggable);
        }
    });
});

function checkGameState() {
    //Check if all the containers are filled with a box
    if (
        firstContainer.hasChildNodes() &&
        secondContainer.hasChildNodes() &&
        thirdContainer.hasChildNodes() &&
        fourthContainer.hasChildNodes()
    ) {
        //Get the boxes values
        const firstContainerValue = parseInt(
            firstContainer.firstChild.innerHTML
        );
        const secondContainerValue = parseInt(
            secondContainer.firstChild.innerHTML
        );
        const thirdContainerValue = parseInt(
            thirdContainer.firstChild.innerHTML
        );
        const fourthContainerValue = parseInt(
            fourthContainer.firstChild.innerHTML
        );

        //Check if values are sorted right
        if (
            firstContainerValue <= secondContainerValue &&
            secondContainerValue <= thirdContainerValue &&
            thirdContainerValue <= fourthContainerValue
        ) {
            captchaModal.classList.add("hide");
            captchaCheckbox.classList.add("hide");
            captchaCheckMark.classList.remove("hide");
            captchaModalButton.removeEventListener("click", openModal);
        }
    }
}
