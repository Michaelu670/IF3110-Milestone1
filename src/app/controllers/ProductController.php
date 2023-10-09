<?php

class ProductController extends Controller implements ControllerInterface {
    function index() {
        try
        {
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    // get user info
                    $userData['username'] = null;
                    $userData['picture_url'] = 'user.svg';
                    
                    if (isset($_SESSION['user_id'])) {
                        require_once __DIR__ . '/../model/UserModel.php';
                        $userModel = new UserModel();
                        $user = $userModel->getUserFromID($_SESSION['user_id']);

                        $userData['username'] = $user->username;
                        $userData['access_type'] = $user->access_type;
                        $userData['picture_url'] = $user->picture_url;
                    }
                    
                    
                    $productID = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 'a';
                    if (!is_numeric($productID)) {
                        throw new LoggedException('Invalid [product] id', 422);
                    }
                    
                    require_once __DIR__ . '/../model/ProductModel.php';
                    $productModel = new ProductModel();

                    $product = $productModel->getProductFromID($productID);
                    
                    if (!isset($product)) {
                        throw new LoggedException('No such product', 422);
                    }

                    $product['media_urls'] = $productModel->getProductMediaURLs($productID);
                    if (empty($product['media_urls'])) {
                        $product['media_urls'] = [ProductModel::DEFAULT_THUMBNAIL_URL];
                    } 
                    $product['product_id'] = $productID;

                    require_once __DIR__ . '/../model/TagModel.php';
                    $tagmModel = new TagModel();
                    $allTags = $tagmModel->getAllTags();

                    // echo '<pre>';
                    // print_r($allTags);
                    // echo '</pre>';
                    // echo '<br>';

                    $productView = $this->view('product', 'ProductDetailView', [$userData, $product, $allTags]);
                    $productView->render();
                    exit;
                
                case 'POST':
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    try {
                        $authMiddleware->isAuthenticated();
                    }
                    catch (Exception $e) {
                        header('location: /public/user/login');
                        exit;
                    }
                    
                    // add item to cart
                    $productID = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 'a';
                    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
                    require_once __DIR__ . '/../model/CartModel.php';
                    $cartModel = new CartModel();
                    $cartModel->addToCart($_SESSION['user_id'], $productID, $quantity);
                    
                    function alertAndMove($msg) {
                        echo "<script type='text/javascript'>alert('$msg');</script>";
                        echo "<script type='text/javascript'>window.location.href = \"" . $_SERVER['REQUEST_URI'] . "\"</script>";
                    }

                    alertAndMove("Barang berhasil ditambahkan!");
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

    function add() {
        try
        {
            switch($_SERVER['REQUEST_METHOD'])
            {   
                case 'GET':
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    // get user info
                    $userData['username'] = null;
                    $userData['picture_url'] = 'user.svg';
                    
                    if (isset($_SESSION['user_id'])) {
                        require_once __DIR__ . '/../model/UserModel.php';
                        $userModel = new UserModel();
                        $user = $userModel->getUserFromID($_SESSION['user_id']);

                        $userData['username'] = $user->username;
                        $userData['access_type'] = $user->access_type;
                        $userData['picture_url'] = $user->picture_url;
                    }

                    require_once __DIR__ . '/../model/ProductModel.php';
                    $defaultImages = [ProductModel::DEFAULT_THUMBNAIL_URL];

                    require_once __DIR__ . '/../model/TagModel.php';
                    $tagmModel = new TagModel();
                    $allTags = $tagmModel->getAllTags();

                    $productView = $this->view('product', 'ProductEditView', [$userData, $defaultImages, $allTags]);
                    $productView->render();
                    exit;

                case 'POST':
                    // print_r($_POST);

                    require_once __DIR__ . '/../model/ProductModel.php';
                    $productModel = new ProductModel();
                    // print_r(count($_FILES));

                    $uploadedImage = ''; // Initialize as an empty string
                    // // print_r($upload);
                    $tagArray = [];
                    for($i=0; $i < $_POST['tagLength']; $i++){
                        array_push($tagArray, $_POST['tag'.$i]);
                    }

                    $medias=[];


                    foreach($_FILES as $file){
                        $storageAccess = new StorageAccess(StorageAccess::IMAGE_PATH);
                        $uploadedImage = $storageAccess->saveImage($file['tmp_name']);
                        $uploadedThumbnail = '/storage/images/'.$uploadedImage;
                        array_push($medias, $uploadedThumbnail);
                    }

                    $productModel->createProduct($_POST['name'], $_POST['detail'], $_POST['price'], $_POST['stock'], $medias[0], $tagArray, $medias);
                    
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
            throw $e;
        }
    }

    function update() {
        try
        {
            switch($_SERVER['REQUEST_METHOD'])
            {   
                case 'POST':
                    require_once __DIR__ . '/../model/ProductModel.php';
                    $productModel = new ProductModel();

                    $uploadedImage = ''; // Initialize as an empty string
                    // Thumbnail & media doesn't change
                    $productModel->updateProductName($_POST['productID'], $_POST['name']);
                    $productModel->updateProductPrice($_POST['productID'], $_POST['price']);
                    $productModel->updateProductStock($_POST['productID'], $_POST['stock']);
                    $productModel->updateProductDescription($_POST['productID'], $_POST['detail']);

                    if(!$_POST['emptyThumbnail']){
                        $storageAccess = new StorageAccess(StorageAccess::IMAGE_PATH);
                        $uploadedImage = $storageAccess->saveImage($_FILES['thumbnail_url']['tmp_name']);
                        $uploadedThumbnail = '/storage/images/'.$uploadedImage;
                        $productModel->updateProductThumbnail($_POST['productID'], $_POST['name'], $uploadedThumbnail);
                    }

                    $tagArray = [];
                    for($i=0; $i < $_POST['tagLength']; $i++){
                        array_push($tagArray, $_POST['tag'.$i]);
                    }

                    $medias=[];
                    foreach($_FILES as $file){
                        $storageAccess = new StorageAccess(StorageAccess::IMAGE_PATH);
                        $uploadedImage = $storageAccess->saveImage($file['tmp_name']);
                        $uploadedThumbnail = '/storage/images/'.$uploadedImage;
                        array_push($medias, $uploadedThumbnail);
                    }

                    if(!$_POST['emptyMedias'] && !$_POST['emptyThumbnail']){
                        $productModel->updateMediaURL1($_POST['productID'], $medias);
                    }elseif(!$_POST['emptyMedias']){
                        unset($medias[0]);
                        $productModel->updateMediaURL1($_POST['productID'], $medias);
                    }

                    $productModel->updateProductTags($_POST['productID'], $tagArray);



                    
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
            throw $e;
        }
    }
}