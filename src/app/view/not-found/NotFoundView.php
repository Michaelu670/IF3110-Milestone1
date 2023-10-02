<?php

class NotFoundView implements ViewInterface {
    function render() {
        require_once __DIR__ . '/../../component/not-found/NotFoundPage.php';
    }
}