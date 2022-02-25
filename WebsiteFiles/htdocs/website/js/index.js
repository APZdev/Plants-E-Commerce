//Dark mode switch
const chk = document.getElementById("chk");
chk.addEventListener("change", () => {
    const allDomElements = document.querySelectorAll("*");
    allDomElements.forEach((element) => {
        element.classList.toggle("dark");
    });
});

//Open modal on click
document.querySelector(".authentication_modal_navbar_button").addEventListener('click', event => {
    document.querySelector(".authentication_modal_container").classList.remove("closed");
    disableScroll();
});

//Close modal on click
document.querySelector(".close_button").addEventListener('click', event => {
    document.querySelector(".authentication_modal_container").classList.add("closed");
    enableScroll();
});


document.querySelector(".authentication_register_button").addEventListener('click', event => {
    document.querySelector(".authentication_form_fields_container")
        .classList.add("switched");
    document.querySelector(".form_category_design_bar")
        .classList.add("selected");
});

document.querySelector(".authentication_login_button").addEventListener('click', event => {
    document.querySelector(".authentication_form_fields_container")
        .classList.remove("switched");
    document.querySelector(".form_category_design_bar")
        .classList.remove("selected");
});

//Check/Uncheck the box on the whole container rather than only on the checkbox zone
document.querySelector(".checkbox_container").addEventListener('click', event => {
    let checkbox = document.querySelector(".login_rememberme_checkbox");
    checkbox.checked = !checkbox.checked;
});


//Stop scroll
// left: 37, up: 38, right: 39, down: 40,
// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
var keys = { 37: 1, 38: 1, 39: 1, 40: 1 };

function preventDefault(e) {
    e.preventDefault();
}

function preventDefaultForScrollKeys(e) {
    if (keys[e.keyCode]) {
        preventDefault(e);
        return false;
    }
}

// modern Chrome requires { passive: false } when adding event
var supportsPassive = false;
try {
    window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
        get: function() { supportsPassive = true; }
    }));
} catch (e) {}

var wheelOpt = supportsPassive ? { passive: false } : false;
var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

// call this to Disable
function disableScroll() {
    window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
    window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
    window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
    window.addEventListener('keydown', preventDefaultForScrollKeys, false);
}

// call this to Enable
function enableScroll() {
    window.removeEventListener('DOMMouseScroll', preventDefault, false);
    window.removeEventListener(wheelEvent, preventDefault, wheelOpt);
    window.removeEventListener('touchmove', preventDefault, wheelOpt);
    window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
}