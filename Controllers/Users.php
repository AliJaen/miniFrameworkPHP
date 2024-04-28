<?php

class Users extends Controller {
    public function index() {
        $data = [
            "page_name" => "Usuarios",
            "function_js" => "users.js",
        ];
        $this->views->getView($this, "index", $data);
    }
}