<?php
//require_once '../app/vendor/autoload.php';
require_once "../app/models/User.php";
require_once "../app/controllers/PostController.php";
use app\controllers\PostController;

// superglobal assigned to $url
$request_method = $_SERVER['REQUEST_METHOD'];
$uri = strtok($_SERVER["REQUEST_URI"], '?');
//echo($url); 

if ($uri === '/view-users' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $postController = new PostController();
    $postController->postsView();
}

if ($uri === '/posts' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $postController = new PostController();
    $postController->getUsers();
     // Handle POST request to create a new post
     create_post();
}

if ($uri === '/users' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $postController = new PostController();
    $postController->saveUser();
}

switch ($request_method) {
    case 'POST':
        if ($request_uri === '/posts') {
            // Handle POST request to create a new post
            create_post();
        } else {
            // Route not found for POST requests
            http_response_code(404);
            echo "404 Not Found";
        }
        break;
    default:
        // Method not allowed for other request methods
        http_response_code(405);
        echo "405 Method Not Allowed";
        break;
}

function create_post() {
    // handle the creation of a new post
    // This function will be responsible for processing the POST data and saving it to the database
}

?>
