<?php
class CartController extends Controller implements ControllerInterface {
    private $cartModel;
    private $productModel;
    function __construct() {
        require_once __DIR__ . '/../model/CartModel.php';
        require_once __DIR__ . '/../model/ProductModel.php';
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
    }

    function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /public/user/login');
            exit();
        }
        $activeCart['username'] = null;
        $activeCart['picture_url'] = 'user.svg';

        require_once __DIR__ . '/../model/UserModel.php';
        $userModel = new UserModel();
        $user = $userModel->getUserFromID($_SESSION['user_id']);

        // if not user, return not found
        if ($user->access_type != 0) {
            header('Location: /public/notfound');
            exit();
        }

        $activeCart['username'] = $user->username;
        $activeCart['access_type'] = $user->access_type;
        $activeCart['picture_url'] = $user->picture_url;


        $userID = $_SESSION['user_id']; 
        $activeCart = $this->cartModel->getActiveCart($userID);
        
        foreach ($activeCart['products'] as &$product) {
            $product = array_merge($product, $this->productModel->getProductFromID($product['product_id']));
        }

        $view = $this->view('cart', 'CartView', $activeCart);
        $view->render();
    }
}