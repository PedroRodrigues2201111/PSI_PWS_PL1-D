<?php
use ArmoredCore\WebObjects\View;
use ArmoredCore\Controllers\BaseController;

class CheckinAppController extends BaseController
{
    public function index(){
        $this->loginFilterbyRole('operadorcheckin');
        return view::make('operadorcheckin.index');
    }
}