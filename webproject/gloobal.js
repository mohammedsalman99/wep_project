if(sessionStorage.getItem("name")) {
    document.getElementById("userr").innerHTML = sessionStorage.getItem("name");
}

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

function gohome(){
    document.location.href = "index.html";
}





function changer() {
    document.getElementById("customerNameField").value = sessionStorage.getItem("name");

    document.getElementById("orderTotal").value = document.getElementById("totaloforder").innerHTML;

    const validItems = listCards.filter(item => item !== null && item !== undefined);
    const itemNames = validItems.map(item => item.name);
    const customAlertMessage = itemNames.join(',');
    document.getElementById("items").value = customAlertMessage;

    const validQuantities = listCards.map(item => (item && item.quantity) || 0);
    const nonZeroQuantities = validQuantities.filter(quantity => quantity !== 0);
    const alertMessage = nonZeroQuantities.join(',');
    document.getElementById("quantities").value = alertMessage;
}
