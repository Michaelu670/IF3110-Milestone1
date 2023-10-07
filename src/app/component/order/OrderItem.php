<?php

function echoOrderItem($order) {
    $href = BASE_URL . '/order?id=' . $order['cart_id'];

    if ($order['receive_date'] !== null) {
        $status = $order['receive_date'];
        $statusClass = 'success-status';
    } else {
        $status = 'Ditunda';
        $statusClass = 'postponed-status';
    }

    $html = <<<"EOT"
        <div class='order-order flex-container'>
            <div class="item-order">
                <label>Order ID</label>
                <h3>{$order['cart_id']}</h3>
            </div>
            <div class="item-order">
                <label>Recipient Name</label>
                <h3>{$order['recipient_name']}</h3>
            </div>
            <div class="item-order">
                <label>Recipient Phone Number</label>
                <h3>{$order['recipient_phone_number']}</h3>
            </div>
            <div class="item-order">
                <label>Delivery Address</label>
                <h3>{$order['delivery_address']}</h3>
            </div>
            <div class="item-order">
                <label>Payment ID</label>
                <h3>{$order['payment_id']}</h3>
            </div>
            <div class="item-order">
                <label>Order Date</label>
                <h3>{$order['order_date']}</h3>
            </div>
            <div class="item-order">
                <label>Received Date</label>
                <h3 class="$statusClass">$status</h3>
            </div>
        </div>

EOT;

    echo $html;
}