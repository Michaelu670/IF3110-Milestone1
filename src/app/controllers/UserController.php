<?php

class UserController extends Controller implements ControllerInterface
{
    public function index()
    {
        try
        {
            switch ($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    require_once __DIR__ . '/../model/UserModel.php';
                    $userModel = new UserModel();
                    $res = $userModel->getUserFromID(1);
                    
                    exit;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
                
            }
        } catch (Exception $e)
        {
            if ($e->getCode() == 401)
            {
                $notFoundView = $this->view('not-found', 'NotFoundView');
                $notFoundView->render();
            }
            http_response_code($e->getCode());
            exit;
        }
    }

    public function fetch($page)
    {
        try
        {
            switch ($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    require_once __DIR__ . '/../model/UserModel.php';
                    $userModel = new UserModel();
                    $res = $userModel->getUsers((int) $page);

                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode($res);
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

    public function login()
    {
        try
        {
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'POST':
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    require_once __DIR__ . '/../model/UserModel.php';
                    $userModel = new UserModel();
                    $userId = $userModel->login($_POST['username'], $_POST['password']);
                    $_SESSION['user_id'] = $userId;

                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(["redirect_url" => BASE_URL . "/home"]);
                    exit;
                case 'GET':
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    $loginView = $this->view('user', 'LoginView');
                    $loginView->render();
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

    public function logout()
    {
        try
        {
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'POST':
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    unset($_SESSION['user_id']);

                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(["redirect_url" => BASE_URL . "/user/login"]);
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

    public function register()
    {
        try
        {
            switch ($_SERVER['REQUEST_METHOD'])
            {
                case 'POST':
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();
    
                    // Form tidak lengkap
                    if (!$_POST['username'] || !$_POST['password'] || !$_POST['fullname']) {
                        throw new LoggedException('Bad Request', 400);
                    }
    
                    // Handle file upload separately
                    $uploadedImage = ''; // Initialize as an empty string
    
                    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                        $storageAccessImage = new StorageAccess(StorageAccess::IMAGE_PATH);
                        $uploadedImage = $storageAccessImage->saveImage($_FILES['profile_picture']['tmp_name']);
                    }
    
                    require_once __DIR__ . '/../model/UserModel.php';
                    $userModel = new UserModel();
                    $userModel->register($_POST['username'], $_POST['password'], $_POST['fullname'], $uploadedImage);
    
                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(["redirect_url" => BASE_URL . "/user/login"]);
                    exit;
    
                case 'GET':
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();
    
                    $registerView = $this->view('user', 'RegisterView');
                    $registerView->render();
                    exit;
    
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e)
        {
            http_response_code($e->getCode());
        }
    }
    

    public function username()
    {
        try
        {
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    require_once __DIR__ . '/../model/UserModel.php';
                    $userModel = new UserModel();
                    $user = $userModel->doesUsernameExist($_GET['username']);

                    if (!$user) {
                        throw new LoggedException('Not Found', 404);
                    }

                    http_response_code(200);
                    exit;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch(Exception $e)
        {
            http_response_code($e->getCode());
            exit;
        }
    }
}