<?php

class HomeController extends Controller implements ControllerInterface
{
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
                        $homeView = $this->view('home', 'MainView', ['username' => $user->username, 'access_type' => $user->access_type, 'picture_url' => $user->picture_url]);
                    } else
                    {
                        $homeView = $this->view('home', 'MainView', ['username' => null, 'picture_url' => 'user.svg']);
                    }
                    $homeView->render();
                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            throw $e;
        }
    }
}






























