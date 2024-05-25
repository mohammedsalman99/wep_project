let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');
openShopping.addEventListener('click', ()=>{
        body.classList.add('active');
})
closeShopping.addEventListener('click', ()=>{
    body.classList.remove('active');
})
let products = [
    {
        id: 1,
        name: 'Burger',
        image: 'm1.jpg',
        price: 30
    },
    {
        id: 2,
        name: 'Pizza',
        image: 'm2.jpg',
        price: 25
    },
    {
        id: 3,
        name: 'Steak',
        image: 'm3.webp',
        price: 50
    },
    {
        id: 4,
        name: 'Dessert',
        image: 'm4.jpg',
        price: 15
    },
    {
        id: 5,
        name: 'Strawberry Desserts',
        image: 'm5.jpg',
        price: 18
    },
    {
        id: 6,
        name: 'Pasta',
        image: 'm6.jpg',
        price: 20
    },
    {
        id: 7,
        name: 'Spaghetti',
        image: 'm7.jpg',
        price: 22
    },
    {
        id: 8,
        name: 'Healthy Lunch',
        image: 'm8.jpg',
        price: 20
    },
    {
        id: 9,
        name: 'Shawerma',
        image: 'm9.jpg',
        price: 25
    },
    {
        id: 10,
        name: 'Hummus',
        image: 'm10.webp',
        price: 10
    },
    {
        id: 11,
        name: 'Kabsa',
        image: 'm11.jpg',
        price: 60
    },
    {
        id: 12,
        name: 'flafel',
        image: 'm12.jpg',
        price: 5
    },
];
let listCards  = [];
function initApp(){
    products.forEach((value, key) =>{
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
            <img src="${value.image}">
            <div class="title">${value.name}</div>
            <div class="price">${value.price.toLocaleString()}</div>
            <button onclick="addToCard(${key}); changer()">Add To Cart</button>`;
        list.appendChild(newDiv);
    })
}
initApp();
function addToCard(key) {
    if (sessionStorage.getItem("name")) {
        if (listCards[key] == null) {
            listCards[key] = products[key];
            listCards[key] = JSON.parse(JSON.stringify(products[key]));
            listCards[key].quantity = 1;
        }
        reloadCard();
    }
    else
        alert("You must log in first");
}

function reloadCard(){
    listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    listCards.forEach((value, key)=>{
        totalPrice = totalPrice + value.price;
        count = count + value.quantity;
        if(value != null){
            let newDiv = document.createElement('li');
            newDiv.innerHTML = `
                <div><img src="${value.image}"/></div>
                <div>${value.name}</div>
                <div>${value.price.toLocaleString()}</div>
                <div>
                    <button onclick="changeQuantity(${key}, ${value.quantity - 1}); changer()">-</button>
                    <div class="count">${value.quantity}</div>
                    <button onclick="changeQuantity(${key}, ${value.quantity + 1}); changer()">+</button>
                </div>`;
            listCard.appendChild(newDiv);
        }
    })
    total.innerText = totalPrice.toLocaleString();
    quantity.innerText = count;
}

function changeQuantity(key, quantity){
    console.log(key, quantity);
    if(quantity == 0){
        delete listCards[key];
    }else{
        listCards[key].quantity = quantity;
        listCards[key].price = quantity * products[key].price;
    }
    reloadCard();
}








