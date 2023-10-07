<?php

function echoCartItem($product) {
    $totalItem = $product['quantity'] * $product['price'];
    $html = <<<"EOT"
        <div class='cart-content'>
            <p class="bold-text">{$product['name']}</p>
            <p>{$product['quantity']} barang</p>
            <p class="bold-text">Rp.{$totalItem}</p>
        </div>

EOT;

    echo $html;
}

function echoTotalItems($product) {
    $html = <<<"EOT"
        <div class='cart-content'>
            <p class="bold-text">{$product}</p>
        </div>

EOT;

    echo $html;
}