<?php

class Brand extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $brands = BrandModel::listEqual('brand');

        // ISNERT
        $dataInsert = [
            "brand_name" => "Barcel",
            "brand_status" => 1,
        ];

        //BrandModel::insert('brand', $dataInsert);
        $data = [
            "brands" => $brands,
            "page_name" => "Brands",
        ];
        $this->views->getView($this, "index", $data);
    }
}