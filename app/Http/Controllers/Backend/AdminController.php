<?php namespace App\Http\Controllers\Backend;

use Controller;
use App\Admin, App\Bank;

class AdminController extends Controller
{
    public function index()
    {
        $data['admins'] = Admin::paginate(10);
        return view('backend.admins.index', $data);
    }
}
