<?php

class PostController
{
//todo make a method to return some posts, post objects should come from the post model class
//also need to make a twig template to show the posts
//an example is in app/controllers/UsersController
public function getUsers()
    {
        $name = $_GET['name'];
        $userModel = new User();
        header("Content-Type: application/json");
        $users = $userModel->getAllUsersByName($name);
        echo json_encode($users);
        exit();

    }

    public function saveUser() {

        //get post data from our form post

        $name = $_POST['name'] ? $_POST['name'] : false;
        $description = $_POST['description'] ? $_POST['description'] : false;
        $errors = [];

        //validate and sanitize name
        if ($name) {
            //sanitize, htmlspecialchars replaces html reserved characters with their entity numbers
            //meaning they can't be run as code
            //convert double and single quotes
            //treat coe as html5
            $name = htmlspecialchars($name, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);

            //validate text length
            if (strlen($name) < 2) {
                $errors['nameShort'] = 'name is too short';
            }
        } else {
            $errors['requiredName'] = 'name is required';
        }


        //description via regular expressions
        if ($description) {
            //regex for valid description
            $regex = '/^[_A-Z][_a-z]+)*$/';
            if (!preg_match($regex, $description)) {
                $errors['descriptionInvalid'] = 'description is invalid';
            }
        } else {
            $errors['descriptionRequired'] = 'description is required';
        }

         //if we have errors
         if (count($errors)) {
            http_response_code(400);
            echo json_encode($errors);
            exit();
        }

     //we could save the data off to be saved here

     $returnData = [
        'name' => $name,
        'description' => $description,
    ];
    echo json_encode($returnData);
    exit();

}

public function usersView() {
    $title = 'View Users';
    include './assets/views/users/usersView.php';
    exit();
}



// Function to validate and process the POST data
function create_post() {
    // Check if POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate name and description fields
        $errors = [];
        
        // Check if name field is empty
        if (empty($_POST['name'])) {
            $errors[] = "Name field is required";
        }
        
        // Check if description field is empty
        if (empty($_POST['description'])) {
            $errors[] = "Description field is required";
        }
        
        // If there are validation errors, send back error response
        if (!empty($errors)) {
            http_response_code(400); // Set HTTP status to 400 Bad Request
            
            // Output errors as JSON
            echo json_encode(['errors' => $errors]);
            return; // Stop further execution
        }
        
        // If no validation errors, process the data
        $name = htmlspecialchars($_POST['name']); // Escape HTML characters
        $description = htmlspecialchars($_POST['description']); // Escape HTML characters
        
        // Now you can use $name and $description to create the post
        // For example, save them to the database
        // Then send back a success response
        echo json_encode(['message' => 'Post created successfully']);
    } else {
        // Method not allowed for other request methods
        http_response_code(405);
        echo "405 Method Not Allowed";
    }
}
}


