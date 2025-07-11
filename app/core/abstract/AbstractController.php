<?php
namespace App\Core\Abstract;

abstract class AbstractController {
    protected string $layout;
    // protected Session $session;

    public function __construct(){
        $this->layout = '../templates/layout/base.layoute.php';
        // $this->session = Session::getInstance();
    }
    
    public function renderhtml(string $view, array $data = []) {
        extract($data);

        ob_start();
        require_once '../templates/' . $view;
        $containteForLayoute = ob_get_clean();

        // On inclut le layout général, qui peut utiliser $containteForLayoute
        require_once $this->layout;
        // require_once "../templates/listerTransaction.html.php";
    }

    abstract public function show();
    abstract public function edit();
    abstract public function destroye();
    abstract public function store();
    abstract public function index();


}
