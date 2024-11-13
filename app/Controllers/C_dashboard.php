<?php

namespace App\Controllers;

class C_dashboard extends BaseController
{
    public function index(): string
    {
        $title = 'Dashboard';

        return view('dashboard/V-index-dashboard', ['title' => $title]);
    }
}
