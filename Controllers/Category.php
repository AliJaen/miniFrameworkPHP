<?php

class Category extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $categories = CategoryModel::listEqual('category');

        // INSERT
        $dataInsert = [
            "category_name" => "Gomitas",
            "category_status" => 1,
        ];

        //CategoryModel::insert('category', $dataInsert);
        $data = [
            "categories" => $categories,
            "page_name" => "Categories",
        ];
        $this->views->getView($this, "index", $data);
    }
}