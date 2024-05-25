const showPopupBtn = document.querySelector(".login-btn");
const hidePopupBtn = document.querySelector(".form-popup .close-btn");
const loginSignupLink = document.querySelectorAll(".form-box .bottom-link a");
const formPop = document.querySelector(".form-popup");

showPopupBtn.addEventListener("click",() => {
    document.body.classList.toggle("show-popup");
});


hidePopupBtn.addEventListener("click",() => showPopupBtn.click());

loginSignupLink.forEach(link => {
    link.addEventListener("click",(e) => {
        e.preventDefault();
        formPop.classList[link.id === "signup-link" ? 'add' : 'remove' ] ("show-signup");

    });

});