<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'wellcome to laravel...!' ;
        return view('pages.index',compact('title'));

    }
    public function about(){
        $title = 'About us';
        return view('pages.about')->with('title',$title);

    }
    public function services(){
        $data = array(
                'title' => 'services',
                'services' => ['webdesign','programming','SEO']
            );
        return view('pages.services')->with($data);

    }
}
