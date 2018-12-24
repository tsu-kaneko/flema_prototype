<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * 参考サイト
 * https://qiita.com/zaburo/items/9fcf0f4c771e011a4d35
 *
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Kernel.phpでエリアスが定義されている
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
