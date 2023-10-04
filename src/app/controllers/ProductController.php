<?php

class ProductController extends Controller implements ControllerInterface {
    function index() {
        try
        {
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();
                    
                    $productID = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 'a';
                    if (!is_numeric($productID)) {
                        throw new LoggedException('Invalid [product] id', 422);
                    }
                    
                    require_once __DIR__ . '/../model/ProductModel.php';
                    $productModel = new ProductModel();

                    $product = $productModel->getProductFromID($productID);
                    
                    if (!isset($product)) {
                        throw new LoggedException('No such product', 422);
                    }

                    $product['media_urls'] = $productModel->getProductMediaURLs($productID);
                    if (empty($product['media_urls'])) {
                        $product['media_urls'] = [ProductModel::DEFAULT_THUMBNAIL_URL];
                    } 
                    $product['product_id'] = $productID;

                    $productView = $this->view('product', 'ProductDetailView', $product);
                    $productView->render();
                    exit;
                
                case 'POST':
                    // add item to cart
                    // TODO
                    
                    // redirect to page
                    header('Location: ' . $_SERVER['REQUEST_URI']);
                    exit;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e)
        {
            http_response_code($e->getCode());
            exit;
        }
    }
}