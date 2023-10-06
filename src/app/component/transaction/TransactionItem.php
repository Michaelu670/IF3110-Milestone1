<?php

function echoTransactionItem($order) {
    $href = BASE_URL . '/transaction?id=' . $order['cart_id'];
    $html = <<<"EOT"
        <div class='transaction-order flex-container'>
            <div class="item-transaction">
                <label>Order ID</label>
                <h3>{$order['cart_id']}</h3>
            </div>
            <div class="item-transaction">
                <label>Recipient Name</label>
                <h3>{$order['recipient_name']}</h3>
            </div>
            <div class="item-transaction">
                <label>Recipient Phone Number</label>
                <h3>{$order['recipient_phone_number']}</h3>
            </div>
            <div class="item-transaction">
                <label>Delivery Address</label>
                <h3>{$order['delivery_address']}</h3>
            </div>
            <div class="item-transaction">
                <label>Payment ID</label>
                <h3>{$order['payment_id']}</h3>
            </div>
            <div class="item-transaction">
                <label>Order Date</label>
                <h3>{$order['order_date']}</h3>
            </div>
        </div>

EOT;

    echo $html;
}