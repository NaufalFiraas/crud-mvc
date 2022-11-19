<?php

class Logout extends Controller
{
    public function index()
    {        
        if ($this->model('UserModel')->logout()) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }
    }
}
