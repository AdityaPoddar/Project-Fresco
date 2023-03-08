var gt = 0;
var price = document.getElementsByClassName('price');
var quantity = document.getElementsByClassName('quantity');
var total = document.getElementsByClassName('total');
var gtotal = document.getElementById('gtotal');

function subTotal(gt){
    gt = 0;
    for(i=0;i<price.length;i++){
        total[i].innerText = (price[i].value)*(quantity[i].value);
        gt = gt + (price[i].value)*(quantity[i].value);
    }
    gtotal.innerText = gt;
}

subTotal();

document.getElementById("buyForm").addEventListener("submit",function() {
    const price = document.querySelector(".gtotal")
      .innerText
      .replace(/[^0-9\.-]+/g,"");
    document.getElementById("tt").value = price;
  })
  