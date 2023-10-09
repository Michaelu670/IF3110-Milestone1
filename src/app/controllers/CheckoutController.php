<?php
class CheckoutController extends Controller implements ControllerInterface
{
    public $data;
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /public/user/login');
            exit();
        }
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
                        $checkoutView = $this->view('checkout', 'CheckoutView', ['username' => $user->username, 'access_type' => $user->access_type, 'products' => $cart, 'picture_url' => $user->picture_url]);
                    } else
                    {
                        $checkoutView = $this->view('checkout', 'CheckoutView', ['username' => null]);
                    }
                    $checkoutView->render();
                    break;
                case 'POST':
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    require_once __DIR__ . '/../model/UserModel.php';
                    require_once __DIR__ . '/../model/TransactionModel.php';
                    require_once __DIR__ . '/../model/CartModel.php';

                    $userModel = new UserModel();
                    $orderModel = new TransactionModel();
                    $cartModel = new CartModel();

                    $user = $userModel->getUserFromID($_SESSION['user_id']);
                    $cart = $cartModel->getActiveCart($_SESSION['user_id']);
                    // echo $_POST['delivery_address'];

                    $orderModel->createOrder($_POST['payment_method'], $cart['total_price'], $cart['cart_id'], $user->fullname, $_POST['recipient_phone_number'], $_POST['delivery_address']);
                    // print_r("HERE");

                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(["redirect_url" => BASE_URL . "/home"]);
                    exit;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            throw $e;
        }
        // $settingView = $this->view('setting', 'SettingView');
        // $settingView->render();
    }
}