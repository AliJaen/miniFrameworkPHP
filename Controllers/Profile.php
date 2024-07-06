<?php

class Profile extends Controller {
    public function __construct() {
        Auth::noAuth();
        parent::__construct();
    }

    public function index() {
        $data = [
            "page_name" => "Profile",
            "function_js" => "profile.js",
        ];
        $this->views->getView($this, "index", $data);
    }
}