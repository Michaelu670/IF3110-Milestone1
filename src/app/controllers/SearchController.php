<?php
class SearchController extends Controller implements ControllerInterface
{
    public $data;
    public function index()
    {
        $defaultSearchView = $this->view('product', 'ProductSearchView');
        $defaultSearchView->render();
    }

    public function result() 
    {
        // Sanitize parameters
        $q = isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '';
        $sortVar = isset($_GET['sort']) ? htmlspecialchars($_GET['sort']) : 'name';
        $order = isset($_GET['order']) ? htmlspecialchars($_GET['order']) : 'asc';
        $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : '1';
        $tags = isset($_GET['tags']) ? explode(',', htmlspecialchars($_GET['tags'])) : [];

        // Validate parameters and give default value / throw exception
        if (strcmp($order, 'desc') !== 0) {
            $order = 'asc';
        }
        $possibleSortVars = ['name', 'price', 'stock', 'sold', 'create_date', 'last_modified_date'];
        if (!in_array($sortVar, $possibleSortVars)) {
            throw new LoggedException('Cannot sort on ' . $sortVar, 422);
        }
        if (!is_numeric($page) || $page < 0) {
            throw new LoggedException('Invalid page number ' . $page, 422);
        }
        $q = '%' . $q . '%';
        
        // get required product in page
        require_once __DIR__ . '/../model/ProductModel.php';
        $model = new ProductModel();
        $products = $model->getProductsInPage($page, $q, $sortVar, $order, $tags);

        // for debug purpose
        // echo '<pre>';
        // print_r($products);
        // echo '</pre>';
        // echo '<br>';
        
        

        $resultView = $this->view('product', 'ProductSearchView', $products);
        $resultView->render();
    }
}