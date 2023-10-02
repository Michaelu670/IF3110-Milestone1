<?php
class SearchController extends Controller implements ControllerInterface
{
    public function index()
    {
        $defaultSearchView = $this->view('product', 'ProductSearchView');
        $defaultSearchView->render();
    }

    public function result() 
    {
        $resultView = $this->view('product', 'ProductSearchView');
        $resultView->render();
    }
}