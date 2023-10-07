<?php
class CheckoutController extends Controller implements ControllerInterface
{
    public $data;
    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if(isset($_SESSION['user_id']))
                    {
                        require_once __DIR__ . '/../model/UserModel.php';
                        require_once __DIR__ . '/../model/CartModel.php';
                        require_once __DIR__ . '/../model/ProductModel.php';
                        $userModel = new UserModel();
                        $cartModel = new CartModel();
                        $productModel = new ProductModel();
                        $cart = $cartModel->getActiveCart($_SESSION['user_id']);
                        $user = $userModel->getUserFromID($_SESSION['user_id']);

                        foreach ($cart['products'] as &$product) {
                            $product = array_merge($product, $productModel->getProductFromID($product['product_id']));
                        }
                        $checkoutView = $this->view('checkout', 'CheckoutView', ['username' => $user->username, 'access_type' => $user->access_type, 'products' => $cart]);
                    } else
                    {
                        $checkoutView = $this->view('checkout', 'CheckoutView', ['username' => null]);
                    }
                    $checkoutView->render();
                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
        // $settingView = $this->view('setting', 'SettingView');
        // $settingView->render();
    }
}