<?php

function component($productname, $productprice, $productimg) {
$element = "
    <div class=\"shop-item\">
        <span class=\"shop-item-title\">$productname</span>
        <img class=\"shop-item-image\" src=\"$productimg\">
        <div class=\"shop-item-details\">
            <span class=\"shop-item-price\">RP. $productprice</span>
            <button class=\"btn btn-primary shop-item-button\" type=\"button\" name=\"btnadd\">ADD TO CART</button>
        </div>
    </div>
";
echo $element;
}

