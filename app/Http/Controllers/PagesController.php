<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = '';
        return view('pages.index', compact('title'));
    }

    public function about(){
        $title = 'About - ';
        return view('pages.about', compact('title'));
    }

    public function contact(){
        $dataarray = array(
            'title' => 'Contact - ',
            'array' => ['one', 'two', 'three']
        );
        return view('pages.contact',)->with($dataarray);
    }


}
