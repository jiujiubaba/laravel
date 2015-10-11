<?php namespace App\Http\Controllers\Backend;

use Controller;

class SystemController extends Controller
{
    public function index()
    {
        //
    }

    public function banks()
    {
        return view('backend.systems.banks');
    }
}
