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
                        $userModel = new UserModel();
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $checkoutView = $this->view('checkout', 'CheckoutView', ['username' => $user->username, 'access_type' => $user->access_type]);
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