<?php

date_default_timezone_set('Asia/Jakarta');

class TransactionController extends Controller implements ControllerInterface {
    private $transactionModel;
    private $cartModel;
    function __construct() {
        require_once __DIR__ . '/../model/TransactionModel.php';
        $this->transactionModel = new TransactionModel();
        require_once __DIR__ . '/../model/CartModel.php';
        $this->cartModel = new CartModel();
    }
    function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /public/user/login');
            exit();
        }
        try
        {
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    require_once __DIR__ . '/../model/TransactionModel.php';
                    $transactionModel = new TransactionModel();
                    $data['orders'] = $transactionModel->getAllOrder();

                    if(isset($_SESSION['user_id']))
                    {
                        require_once __DIR__ . '/../model/UserModel.php';
                        $userModel = new UserModel();
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $data['username'] = $user->username;
                        $data['access_type'] = $user->access_type;
                        $data['picture_url'] = $user->picture_url;
                        $data['user_id'] = $_SESSION['user_id'];
                    }

                    $resultView = $this->view('transaction', 'TransactionView', $data);
                    $resultView->render();
                    exit;
                case 'POST':
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    $currentDateTime = date('Y-m-d H:i:s');

                    require_once __DIR__ . '/../model/TransactionModel.php';
                    $transactionModel = new TransactionModel();

                    if ($_POST['action'] === 'complete') {
                        $transactionModel->updateOrderReceiveDate($_POST['cart_id'], $currentDateTime);
                    } elseif ($_POST['action'] === 'delete') {
                        $transactionModel->addItems($this->cartModel->getCartFromID($_POST['cart_id']));
                        $transactionModel->deleteOrderReceiveDate($_POST['cart_id']);
                    }

                    $transactionModel1 = new TransactionModel();
                    $data['orders'] = $transactionModel1->getAllOrder();

                    if(isset($_SESSION['user_id']))
                    {
                        require_once __DIR__ . '/../model/UserModel.php';
                        $userModel = new UserModel();
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $data['username'] = $user->username;
                        $data['access_type'] = $user->access_type;
                        $data['picture_url'] = $user->picture_url;

                    }

                    $resultView = $this->view('transaction', 'TransactionView', $data);
                    $resultView->render();
                    exit;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e)
        {
            http_response_code($e->getCode());
            throw $e;
        }
    }
}