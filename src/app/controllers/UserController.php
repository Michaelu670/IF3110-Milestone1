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
}