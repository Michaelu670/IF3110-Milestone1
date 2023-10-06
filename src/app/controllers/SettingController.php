<?php
class SettingController extends Controller implements ControllerInterface
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
                        $settingView = $this->view('setting', 'SettingView', ['username' => $user->username, 'access_type' => $user->access_type]);
                    } else
                    {
                        $settingView = $this->view('setting', 'SettingView', ['username' => null]);
                    }
                    $settingView->render();
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

    public function changeProfile()
    {
        try
        {
            $tokenMiddleware = $this->middleware('TokenMiddleware');
            $tokenMiddleware->checkToken();

            // Form tidak lengkap
            // if (!$_PUT['username'] || !$_POST['fullname']) {
            //     throw new LoggedException('Bad Request', 400);
            // }

            // Handle file upload separately
            $uploadedImage = ''; // Initialize as an empty string

            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                $storageAccessImage = new StorageAccess(StorageAccess::IMAGE_PATH);
                $uploadedImage = $storageAccessImage->saveImage($_FILES['profile_picture']['tmp_name']);
            }

            require_once __DIR__ . '/../model/SettingModel.php';
            $userModel = new SettingModel();
            $userModel->updateProfile($_PUT['user_id'], $_PUT['username'], $_PUT['fullname'], $uploadedImage);

            header('Content-Type: application/json');
            http_response_code(201);
            echo json_encode(["redirect_url" => BASE_URL . "/Setting"]);
            exit;

        } catch (Exception $e)
        {
            http_response_code($e->getCode());
        }
    }
}