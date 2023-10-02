<?php

class NotFoundController extends Controller implements ControllerInterface{
    function index() {
        $view = $this->view('not-found', 'NotFoundView');
        $view->render();
    }
}