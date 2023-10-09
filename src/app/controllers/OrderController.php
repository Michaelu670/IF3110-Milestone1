<?php
class OrderController extends Controller implements ControllerInterface {
    private $orderModel;
    function __construct() {
        require_once __DIR__ . '/../model/OrderModel.php';
        $this->orderModel = new OrderModel();
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

                    require_once __DIR__ . '/../model/OrderModel.php';
                    $orderModel = new orderModel();
                    
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

                    $data['orders'] = $orderModel->getOrderFromUserID($_SESSION['user_id']);

                    $resultView = $this->view('order', 'OrderView', $data);
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