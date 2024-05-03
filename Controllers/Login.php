<?php

class Login extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = [
            "title" => "Ingreso al sistema",
            'function_js' => 'login.js',
        ];
        $this->views->getView($this, "index", $data);
    }

    public function login() {
        $_POST = json_decode(file_get_contents('php://input'),true);
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $error = false;
            $validatedData = [];

            foreach($_POST as $index => $value) {
                if ($value != "") {
                    $validatedData[$index] = LoginModel::validateData($value);
                } else {
                    $error = true;
                    break;
                }
            }

            if (!$error) {
                $response = LoginModel::listEqual("users", ["user_username" => $validatedData["user_username"]]);
                if (!$response) {
                    echo json_encode(["message" => "Invalid data. User not registered"]);
                } else {
                    echo json_encode(["message" => "success", "data" => $response]);
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