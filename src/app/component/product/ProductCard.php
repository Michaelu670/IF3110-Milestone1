<?php

function echoProductCard($data) {
    $href = BASE_URL . '/product?id=' . $data['product_id'];
    $html = <<<"EOT"
        <a class='product-card flex-container' href='$href'>
            <img src="{$data['thumbnail_url']}" alt="thumbnail of {$data['name']}">
            <h2>{$data['name']}</h2>
            <h3>Rp.{$data['price']}</h3>
        </a>

EOT;

    echo $html;

}

function echoAdminProductCard($data) {
    $href = BASE_URL . '/product?id=' . $data['product_id'];
    $html = <<<"EOT"
    <div class="wrapper-column">
        <a class='product-card flex-container' href='$href'>
            <img src="{$data['thumbnail_url']}" alt="thumbnail of {$data['name']}">
            <h2>{$data['name']}</h2>
            <h3>Rp.{$data['price']}</h3>
        </a>
        <button class="buy-button bluegreen-button bold-text">Delete</button>
    </div>

EOT;

    echo $html;

}