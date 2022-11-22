<?php

class Pages extends Controller
{

    private $postModel;
    public function __construct()
    {
    }

    public function index()
    {
        if (isLoggedIn()) {
            redirect('posts');
        }

        $data = [
            "title" => "sharePosts",
            "description" => "sharePosts based on MVC"
        ];
        $this->view('pages/index', $data);


    }

    public function about()
    {
        $data = [
            "title" => "About Us",
            "description" => "sharePosts based on MVC"
        ];
        $this->view('pages/about', $data);
    }
}
?>