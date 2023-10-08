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

                    // get user info
                    $userData['username'] = null;
                    $userData['picture_url'] = 'user.svg';
                    
                    if (isset($_SESSION['user_id'])) {
                        require_once __DIR__ . '/../model/UserModel.php';
                        $userModel = new UserModel();
                        $user = $userModel->getUserFromID($_SESSION['user_id']);

                        $userData['username'] = $user->username;
                        $userData['access_type'] = $user->access_type;
                        $userData['picture_url'] = $user->picture_url;
                    }
                    
                    
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

                    require_once __DIR__ . '/../model/TagModel.php';
                    $tagmModel = new TagModel();
                    $allTags = $tagmModel->getAllTags();

                    // echo '<pre>';
                    // print_r($allTags);
                    // echo '</pre>';
                    // echo '<br>';

                    $productView = $this->view('product', 'ProductDetailView', [$userData, $product, $allTags]);
                    $productView->render();
                    exit;
                
                case 'POST':
                    // add item to cart
                    $productID = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 'a';
                    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
                    require_once __DIR__ . '/../model/CartModel.php';
                    $cartModel = new CartModel();
                    $cartModel->addToCart($_SESSION['user_id'], $productID, $quantity);
                    
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