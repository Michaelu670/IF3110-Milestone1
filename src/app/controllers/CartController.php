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
        $userID = 1; // TODO 
        $activeCart = $this->cartModel->getActiveCart($userID);

        foreach ($activeCart['products'] as &$product) {
            $product = array_merge($product, $this->productModel->getProductFromID($product['product_id']));
        }

        $view = $this->view('cart', 'CartView', $activeCart);
        $view->render();
    }
}