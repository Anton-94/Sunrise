<?php

namespace Application\Controllers;

use Engine\Controller;

class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     * @param $di
     */
    public function __construct($di)
    {
        parent::__construct($di);
    }

    public function index()
    {
        return view('index');
    }
}