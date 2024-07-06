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
                $response = LoginModel::listEqual("users", ["user_username" => $validatedData["user_username"]], 1);
                if (!$response) {
                    echo json_encode(["message" => "Invalid data. User not registered"]);
                } else {
                    if (password_verify($validatedData["user_password"], $response["user_password"])) {
                        $_SESSION['iduser'] = $response["user_id"];
                        $_SESSION['username'] = $response["user_username"];
                        $_SESSION['mail'] = $response["user_mail"];
                        $_SESSION['role'] = $response["role_id_role"];
                        $_SESSION['authenticated'] = true;
                        $_SESSION['lastAccess'] = date("Y-n-j H:i:s");
                        $jwt = LoginModel::generateJWT($response["user_id"], $response["role_id_role"], $response["user_mail"], $response["user_username"]);
                        echo json_encode(["message" => "success", "jwt" => $jwt, "location" => base_url."/Dashboard"]);
                    } else {
                        echo json_encode(["message" => "Invalid data. Password not match"]);
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
    
    public function test() {
        $test = LoginModel::decodeJWT();
        if ($test !== null) {
            print_r($test);
        } else {
            echo http_response_code(401);
            echo json_encode(["error" => "Unauthorized"]);
        }
    }
}