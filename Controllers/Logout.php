<?php

class Logout {
    public function index() {
        Auth::logout();
    }
}