<?php
namespace App\Core\Abstract;
use App\Core\App;
use App\Core\Session;
use App\Core\Validator\Validator;

abstract class AbstractController {
    protected string $layout;
    protected Session $session;
    protected Validator $validator;
    // protected Session $session;

    public function __construct() {
        $this->layout = '../templates/layout/base.layoute.php';
        $this->session = App::getDependencie('core', 'session');
        $this->validator = App::getDependencie('core', 'validator');
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
