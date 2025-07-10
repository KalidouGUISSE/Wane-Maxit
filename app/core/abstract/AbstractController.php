<?php
namespace App\Core;

abstract class AbstracteContoller {
    protected string $layout;
    protected Session $session;
    public function __construct(){
        $this->layout = '/../../templaye/layoute/base.layoute.php';
        $this->session = Session::getInstance();
    }
    
    public function renderhtml(string $view, array $data = []) {
        extract($data);

        ob_start();
        require_once __DIR__ . '/../../templaye/' . $view;
        $containteForLayoute = ob_get_clean();

        // On inclut le layout général, qui peut utiliser $containteForLayoute
        require_once __DIR__ . $this->layout;
    }

    abstract public function show();
    abstract public function edit();
    abstract public function destroye();
    abstract public function store();
    abstract public function index();


}
