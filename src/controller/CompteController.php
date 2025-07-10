<?php
namespace Src\controller;
use Src\service\CompteService;
use App\Core\Validator;
use App\Core\Session;



class CompteController{
    private CompteService $compteService;
    private Session $session;
    public function __construct(){
        $this->compteService = new CompteService();
    }



    public function show(){}
    public function edit(){}
    public function destroye(){}
    public function store(){}
    public function index(){}
}