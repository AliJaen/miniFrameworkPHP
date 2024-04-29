<?php

class Users extends Controller {
    //SELECT
    //$users = UserModel::listEqual('user', ["user_status" => 1]);
    public function index() {
        $data = [
            "page_name" => "Users",
            "function_js" => "users.js",
        ];
        $this->views->getView($this, "index", $data);
    }
}