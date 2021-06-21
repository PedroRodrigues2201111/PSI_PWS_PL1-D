<?php
use ArmoredCore\WebObjects\View;

class OperadorCheckinController extends BaseAuthController
{
  // Função para retornar o form do operador de check-in
  public function index(){
    $this->loginFilterbyRole('operadorcheckin');
    return view::make('operadorcheckin.index');
  }
}
