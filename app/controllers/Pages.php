<?php

class Pages extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {

        $data = [
            'title' => 'Posts',
            'description'=> 'Simple Social Network built on the CosminMVC php framework'
        ];
        $this->view('pages/index', $data);


    }

    public function about()
    {
        $data = ['title' => 'About Me',
            'description'=> 'Simple Social Network built on the CosminMVC php framework'];
        $this->view('pages/about', $data);

    }
}