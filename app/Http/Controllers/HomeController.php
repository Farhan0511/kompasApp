<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index() {
        return view('user.pages.welcome');
    }

    public function booking() {
        return view('user.pages.booking');
    }
    public function jadwal(){
        return view('user.pages.jadwal');
    }
}
