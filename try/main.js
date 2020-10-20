//get data from table
var ajax = new XMLHttpRequest();
var method = "GET";
var url = "./php/data.php";
var asynchronous = true;

ajax.open(method, url, asynchronous);
ajax.send();

ajax.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {
        //converting JSON back to ARRAY
        let products = JSON.parse(this.responseText);

        let carts = document.querySelectorAll('.shop-item-button');
        for(let i=0; i < carts.length; i++){
            carts[i].addEventListener('click', () => {
                cartNumbers(products[i]);
                totalCost(products[i]);
            }) 
        }

        //----------- ADD ITEM ------------//
        function onLoadCartNumbers() {
            let productNumbers = localStorage.getItem('cartNumbers');

            if(productNumbers) {
                document.querySelector('.cart span'). textContent = productNumbers;
            }
        }

        function cartNumbers(product) {
            let productNumbers = localStorage.getItem('cartNumbers');
            productNumbers = parseInt(productNumbers);

            if(productNumbers) {
                localStorage.setItem('cartNumbers', productNumbers + 1);
                document.querySelector('.cart span'). textContent = productNumbers + 1;
            } else {
                localStorage.setItem('cartNumbers', 1);
                document.querySelector('.cart span'). textContent = 1;
            }

            setItems(product);
        }

        function setItems(product) {
            let cartItems = localStorage.getItem('productsincart');
            cartItems = JSON.parse(cartItems);
            product.incart = parseInt(product.incart);

            if(cartItems != null) {
                if(cartItems[product.id] == undefined){
                    cartItems = {
                        ...cartItems,
                        [product.id] : product
                    }
                }
                cartItems[product.id].incart += 1;
            } else {
                product.incart = 1;
                cartItems = {
                    [product.id] : product
                }
            }
            
            localStorage.setItem("productsincart", JSON.stringify(cartItems));
        }

        function totalCost(product) {
            let cartCost = localStorage.getItem('totalCost');
            product.product_price = parseInt(product.product_price);
            
            if(cartCost != null) {
                cartCost = parseInt(cartCost);
                localStorage.setItem("totalCost", cartCost + product.product_price);
            } else {
                localStorage.setItem("totalCost", product.product_price);
            }
        }

        //---------- Display the item ---------------//
        function displayCart() {
            let cartItems = localStorage.getItem('productsincart');
            cartItems = JSON.parse(cartItems);
            let productContainer = document.querySelector('.cart-items');
            let cartCost = localStorage.getItem('totalCost');
            
            if(cartItems  && productContainer) {
                productContainer.innerHTML = '';
                Object.values(cartItems).map(item => {
                    productContainer.innerHTML += `
                    <div class="cart-item cart-column">
                        <img class="cart-item-image" src="${item.product_image}" width="100" height="100">
                        <span class="cart-item-title">${item.product_name}</span>
                    </div>
                    <span class="cart-price cart-column">Rp. ${item.product_price}</span>
                    <div class="cart-quantity cart-column">
                        <input class="cart-quantity-input" type="number" value="${item.incart}">
                        <button id="removes" class="btn btn-danger" type="button">REMOVE</button>
                    </div>
                    `
                });

                productContainer.innerHTML += `
                <div class="cart-total">
                <strong class="cart-total-title">Total</strong>
                <span class="cart-total-price">Rp. ${cartCost}</span>
                </div>
                `
            }
        }
       
        onLoadCartNumbers();
        displayCart();
    }
}
