<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\DashboardController;

class IndexController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return View($this->template . '.index');
    }
}
