<?php

class Dashboard extends Controller {
    public function index() {
        $data = [
            "page_name" => "Dashboard",
            "function_js" => "dashboard.js",
        ];
        $this->views->getView($this, "index", $data);
    }
}