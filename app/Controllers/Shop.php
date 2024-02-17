<?php

namespace App\Controllers;

class Shop extends BaseController
{
    public function index(): string
    {
        return view('shop');
    }
    public function Product(): string
    {
        return view('product');
    }
    
}
