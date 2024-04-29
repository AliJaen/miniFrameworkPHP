<?php

class Roles extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // SELECT
        $roles = RolesModel::listEqual('roles', ["role_status" => 1]);
        // ISNERT
        $dataInsert = [
            "role_name" => "Website",
            "role_status" => 1,
        ];
        // UPDATE
        $dataUpdate = [
            "role_name" => "User",
            "role_status" => 1,
        ];
        // DELETE
        $dataDelete = 3;

        //RolesModel::delete('roles', ["role_id" => $dataDelete]);
        //RolesModel::update('roles', $dataUpdate, ["role_id" => 4]);
        //RolesModel::insert('roles', $dataInsert);
        $data = [
            "roles" => $roles,
            "page_name" => "Roles",
        ];
        $this->views->getView($this, "index", $data);
    }
}