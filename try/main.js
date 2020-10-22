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
            });


        }

        //----------- ADD ITEM ------------//
        function onLoadCartNumbers() {
            let productNumbers = localStorage.getItem('cartNumbers');

            if(productNumbers) {
                document.querySelector('.cart span'). textContent = productNumbers;
            }
        }

        function cartNumbers(product, action) {
            let productNumbers = localStorage.getItem('cartNumbers');
            productNumbers = parseInt(productNumbers);

            let cartItems = localStorage.getItem('productsincart');
            cartItems = JSON.parse(cartItems);

            if(action) {
                localStorage.setItem("cartNumbers", productNumbers - 1);
                document.querySelector('.cart span'). textContent = productNumbers - 1;
            } else if(productNumbers) {
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
                let currentProduct = product.id;
                if(cartItems[currentProduct] == undefined){
                    cartItems = {
                        ...cartItems,
                        [currentProduct] : product
                    }
                }
                cartItems[currentProduct].incart += 1;
            } else {
                product.incart = 1;
                cartItems = {
                    [product.id] : product
                };
            }
            
            localStorage.setItem("productsincart", JSON.stringify(cartItems));
        }

        function totalCost(product, action) {
            let cartCost = localStorage.getItem('totalCost');
            product.product_price = parseInt(product.product_price);
            
            if (action) {
                cartCost = parseInt(cartCost);
                localStorage.setItem("totalCost", cartCost - product.product_price);
            } else if(cartCost != null) {
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
                Object.values(cartItems).map(item  => {
                    productContainer.innerHTML += `
                    <div class="cart-item cart-column">
                        <img class="cart-item-image" src="${item.product_image}" width="100" height="100">
                        <span class="cart-item-title">${item.product_name}</span>
                    </div>
                    <span class="cart-price cart-column">Rp. ${item.product_price}</span>
                    <div class="cart-quantity cart-column">
                        <span class="qty">${item.incart}</span>
                        <div class="product">
                        <input type="hidden" class="item-id" value="${item.id}"><ion-icon name="close-circle"></ion-icon>
                        </div>
                    </div>`
                });

                productContainer.innerHTML += `
                <div class="cart-total">
                <strong class="cart-total-title">Total</strong>
                <span class="cart-total-price">Rp. ${cartCost}</span>
                </div>`

                removeItem();
            }
            
        }
        
        function removeItem() {
            let deleteButtons = document.querySelectorAll('.product ion-icon');
            let productNumbers = localStorage.getItem('cartNumbers');
            let cartCost = localStorage.getItem("totalCost");
            let cartItems = localStorage.getItem('productsincart');
            cartItems = JSON.parse(cartItems);
            let productId;

            for(let i=0; i < deleteButtons.length; i++) {
                deleteButtons[i].addEventListener('click', () => {
                    productId = deleteButtons[i].parentElement.querySelector('.item-id').value;

                    localStorage.setItem('cartNumbers', productNumbers - cartItems[productId].incart);
                    
                    localStorage.setItem('totalCost', cartCost - (cartItems[productId].product_price * cartItems[productId].incart));
                    
                    delete cartItems[productId];

                    localStorage.setItem('productsincart', JSON.stringify(cartItems));

                    displayCart();
                    onLoadCartNumbers();
                })
            }
        }



        onLoadCartNumbers();
        displayCart();
    }
}
