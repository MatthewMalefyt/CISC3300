<?php

class PostController
{
    public function getUsers()
    {
        $name = isset($_GET['name']) ? $_GET['name'] : null; // Checking if 'name' parameter is set
        $userModel = new UserModel(); // Assuming UserModel class exists for fetching users
        header("Content-Type: application/json");
        $users = $userModel->getAllUsersByName($name);
        echo json_encode($users);
        exit();
    }

    public function saveUser()
    {
        // Check if POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get post data from form
            $name = isset($_POST['name']) ? $_POST['name'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $errors = [];

            // Validate and sanitize name
            if ($name) {
                $name = htmlspecialchars($name, ENT_QUOTES | ENT_HTML5, 'UTF-8', true);
                if (strlen($name) < 2) {
                    $errors['nameShort'] = 'Name is too short';
                }
            } else {
                $errors['requiredName'] = 'Name is required';
            }

            // Validate description
            if ($description) {
                // Corrected regex pattern
                $regex = '/^[_A-Za-z][_a-zA-Z\s]*$/';
                if (!preg_match($regex, $description)) {
                    $errors['descriptionInvalid'] = 'Description is invalid';
                }
            } else {
                $errors['descriptionRequired'] = 'Description is required';
            }

            // If there are errors, return error response
            if (count($errors)) {
                http_response_code(400);
                echo json_encode($errors);
                return;
            }

            // Data validation passed, process data
            $returnData = [
                'name' => $name,
                'description' => $description,
            ];
            echo json_encode($returnData);
            return;
        } else {
            // Method not allowed for other request methods
            http_response_code(405);
            echo "405 Method Not Allowed";
            return;
        }
    }

    public function usersView()
    {
        $title = 'View Users';
        include './assets/views/users/usersView.php';
        exit();
    }
}

// Function to validate and process the POST data
function create_post()
{
    $postController = new PostController();
    $postController->saveUser();
}

// Call the create_post function to handle the request
create_post();
?>

