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

                    $userModel = $this->model('UserModel');

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

                    $userModel = $this->model('UserModel');
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
                case 'GET':
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    $loginView = $this->view('user', 'LoginView');
                    $loginView->render();
                    exit;
                case 'POST':
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $userModel = $this->model('UserModel');
                    $userId = $userModel->login($_POST['username'], $_POST['password']);
                    $_SESSION['user_id'] = $userId;

                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(["redirect_url" => BASE_URL . "/home"]);
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
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    $registerView = $this->view('user', 'RegisterView');
                    $registerView->render();
                    exit;
                case 'POST':
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $storageAccessImage = new StorageAccess(StorageAccess::IMAGE_PATH);
                    $uploadedImage = $storageAccessImage->saveImage($_FILES['profilePicture']['tmp_name']);

                    $userModel = $this->model('UserModel');
                    $userModel->register($_POST['username'], $_POST['password'], $_POST['fullname'], $uploadedImage);

                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(["redirect_url" => BASE_URL . "/user/login"]);
                    exit;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch(Exception $e)
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

                    $userModel = $this->model('UserModel');
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