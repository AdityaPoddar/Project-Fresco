// const button = document.querySelector('.buttons button');

// document.getElementById('basket-btn').onclick(getElementById('demo').innerHTML = 'aasd');
// var a = document.getElementById('basket-btn');

// function addToBasket(){
//   a.getElementById('demo').innerHTML = 'ADDED';
// }

var counter = 0;
document.getElementById('item-count').innerText = counter;
var plus = document.getElementById("item-count");
var btn = document.getElementById("basket-btn");

btn.onclick = function(){
  if(document.getElementById('item-count').innerText == 20){
    alert('Basket full.');
    counter = 20;
    document.getElementById('item-count').innerText = counter;
  }
  if(document.getElementById('item-count').innerText <= 20){
    counter = counter + 1;
    document.getElementById('item-count').innerText = counter;
    alert('This product has been added to your basket.');
  }
  
};

// var plus = document.getElementById("plus");
// var minus = document.getElementById("minus");
// var quan = document.getElementById("quan");

// plus.onclick = function(){
//   quan.innerHTML = "1";
// }

// if(quan.innerHTML == "0"){
//   minus.setAttribute("disabled","disabled");
// }
// minus.onclick = function(){
//   quan.innerHTML ="-1";
// }

var quantity = 1;
document.getElementById('quan').innerText = quantity;

function increment(){
  if(document.getElementById('quan').innerText == 20){
    quantity = 20;
  }
  else{
    quantity = quantity + 1;
    document.getElementById('quan').innerText = quantity;  
  }
}

function decrement(){
  if(document.getElementById('quan').innerText == 1){
    quantity = 1;
  }
  else{
    quantity = quantity - 1;
    document.getElementById('quan').innerText = quantity;
  }
}