<?php

class Register extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = [
            'page_name' => 'Register',
            'function_js' => 'register.js',
        ];
        $this->views->getView($this, 'index', $data);
    }

    public function save() {
        $_POST = json_decode(file_get_contents('php://input'),true);
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            
            $error = false;
            $validatedData = [];

            foreach ($_POST as $index => $value) {
                if ($value != "") {
                    $validatedData[$index] = RegisterModel::validateData($value);
                } else {
                    $error = true;
                    break;
                }
            }

            if (!$error) {
                $valid_pass = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?\d)(?=.*?\W).{8,25}$/";

                if (!filter_var($validatedData["user_mail"], FILTER_VALIDATE_EMAIL)) {
                    echo http_response_code(406);
                    echo json_encode(["error" => "Invalid data. Invalid Mail"]);

                } elseif (preg_match($valid_pass, $validatedData["user_password"]) == 0) {
                    echo http_response_code(406);
                    echo json_encode(["error" => "Invalid data. Invalid Password {$validatedData['user_password']}"]);
 
                } else {
                    $dataToInsert["user_username"] = $validatedData["user_username"];
                    $dataToInsert["user_mail"] = $validatedData["user_mail"];
                    $dataToInsert["user_password"] = RegisterModel::cryptPass($validatedData["user_password"]);
                    $dataToInsert["role_id_role"] = 4;
                    $dataToInsert["user_status"] = 1;

                    $response = RegisterModel::insert("users", $dataToInsert);
                    if (!$response) {
                        echo http_response_code(500);
                        echo json_encode(["error" => "Error creating user"]);
                    } else {
                        echo json_encode(["message" => "success", "data" => $response, "url" => base_url]);
                    }
                }

            } else {
                echo http_response_code(406);
                echo json_encode(["error" => "Invalid data"]);
            }

        } else {
            echo http_response_code(405);
            echo json_encode(["error" => "Method not Allowed"]);
        }
    }
}