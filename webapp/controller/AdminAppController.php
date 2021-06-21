<?php
use ArmoredCore\WebObjects\View;

class AdminAppController extends BaseAuthController
{
    public function index(){
        $this->loginFilterbyRole('admin');
        return view::make('admin.index');
    }
}