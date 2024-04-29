<?php

class Product extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $products = ProductModel::join('product', 'brand', 'brand_id_brand', 'brand_id');

        // INSERT
        $dataInsert = [
            "product_name" => "Paleta payaso mini",
            "product_purchase_price" => 10.00,
            "product_sale_price" => 12.00,
            "category_id_category" => 3,
            "brand_id_brand" => 5,
            "product_status" => 1,
        ];

        //ProductModel::insert("product", $dataInsert);
        $data = [
            "products" => $products,
            "page_name" => "Products",
        ];
        $this->views->getView($this, "index", $data);
    }
}