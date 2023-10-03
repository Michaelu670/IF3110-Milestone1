<?php

function echoProductCard($data) {
    $html = <<<"EOT"
        <div class='product-card flex-container'>
            <img src="{$data['thumbnail_url']}">
            <h2>{$data['name']}</h2>
            <h3>Rp.{$data['price']}</h3>
        </div>

EOT;

    echo $html;

}