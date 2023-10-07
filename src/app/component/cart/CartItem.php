<?php

function echoCartItem($product) {
    $href = BASE_URL . '/product?id=' . $product['product_id'];
    $html = <<<"EOT"
        <div class='cart-product flex-container'>
            <img src="{$product['thumbnail_url']}" alt="thumbnail of {$product['name']}">
            <a  href='$href'> <u> <h2>{$product['name']}</h2> </u> </a>
            <h3>Rp.{$product['price']}</h3>
            <h3>{$product['quantity']}</h3>
        </div>

EOT;

    echo $html;
}