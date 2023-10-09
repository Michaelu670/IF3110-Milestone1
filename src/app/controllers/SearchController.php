<?php
class SearchController extends Controller implements ControllerInterface
{
    public $data;
    public function index()
    {
        $defaultSearchView = $this->view('product', 'ProductSearchView');
        $defaultSearchView->render();
    }

    public function result() 
    {
        // Sanitize parameters
        $q = isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '';
        $sortVar = isset($_GET['sort']) ? htmlspecialchars($_GET['sort']) : 'name';
        $order = isset($_GET['order']) ? htmlspecialchars($_GET['order']) : 'asc';
        $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : '1';
        $tags = isset($_GET['tags']) ? explode(',', htmlspecialchars($_GET['tags'])) : [];
        $minPrice = isset($_GET['minPrice']) ? htmlspecialchars($_GET['minPrice']) : null;
        $maxPrice = isset($_GET['maxPrice']) ? htmlspecialchars($_GET['maxPrice']) : null;

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
        

        // Validate parameters and give default value / throw exception
        if (strcmp($order, 'desc') !== 0) {
            $order = 'asc';
        }
        $possibleSortVars = ['name', 'price', 'stock', 'sold', 'create_date', 'last_modified_date'];
        if (!in_array($sortVar, $possibleSortVars)) {
            throw new LoggedException('Cannot sort on ' . $sortVar, 422);
        }
        if (!is_numeric($page) || $page < 0) {
            throw new LoggedException('Invalid page number ' . $page, 422);
        }
        if ((!is_null($minPrice) && !is_numeric($minPrice)) || (!is_null($maxPrice) && !is_numeric($maxPrice))) {
            throw new LoggedException('Invalid price range ' . $page, 422);
        }

        $data = [
            'q' => $q,
            'sortVar' => $sortVar,
            'order' => $order,
            'page' => $page,
            'tags' => $tags,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ];

        // add all_tags for preview
        require_once __DIR__ . '/../model/TagModel.php';
        $tagModel = new TagModel();
        $data['all_tags'] = $tagModel->getAllTags();

        // add userdata to data
        $data = array_merge($data, $userData);

        $resultView = $this->view('product', 'ProductSearchTemplateView', $data);
        $resultView->render();
    }

    public function resultproducts() 
    {
        // Sanitize parameters
        $q = isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '';
        $sortVar = isset($_GET['sort']) ? htmlspecialchars($_GET['sort']) : 'name';
        $order = isset($_GET['order']) ? htmlspecialchars($_GET['order']) : 'asc';
        $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : '1';
        $tags = isset($_GET['tags']) ? explode(',', htmlspecialchars($_GET['tags'])) : [];
        $minPrice = isset($_GET['minPrice']) ? htmlspecialchars($_GET['minPrice']) : null;
        $maxPrice = isset($_GET['maxPrice']) ? htmlspecialchars($_GET['maxPrice']) : null;
        

        // Validate parameters and give default value / throw exception
        if (strcmp($order, 'desc') !== 0) {
            $order = 'asc';
        }
        $possibleSortVars = ['name', 'price', 'stock', 'sold', 'create_date', 'last_modified_date'];
        if (!in_array($sortVar, $possibleSortVars)) {
            throw new LoggedException('Cannot sort on ' . $sortVar, 422);
        }
        if (!is_numeric($page) || $page < 0) {
            throw new LoggedException('Invalid page number ' . $page, 422);
        }
        if ((!is_null($minPrice) && !is_numeric($minPrice)) || (!is_null($maxPrice) && !is_numeric($maxPrice))) {
            throw new LoggedException('Invalid price range ' . $page, 422);
        } 
        $q = '%' . $q . '%';
        
        // get required product in page
        require_once __DIR__ . '/../model/ProductModel.php';
        require_once __DIR__ . '/../model/UserModel.php';

        $model = new ProductModel();    

        $products = $model->getProductsInPage($page, $q, $sortVar, $order, $tags, $minPrice, $maxPrice);

        $view = $this->view('product', 'ProductSearchView', $products);
        $view->render();


    }
}