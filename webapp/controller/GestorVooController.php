<?php
use ArmoredCore\WebObjects\View;

class GestorVooController extends BaseAuthController
{
    public function index(){
        $this->loginFilterbyRole('gestorvoo');
        return view::make('gestorvoo.index');
    }
}