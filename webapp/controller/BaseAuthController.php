<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;

class BaseAuthController extends BaseController
{
    public function loginFilter()
    {
        if(!AuthManager::isUserLogged())
        {
            Redirect::toRoute('login/loginform');
        }
    }

    public function loginFilterbyRole($role)
    {
        if(!AuthManager::isUserLogged())
        {
            Redirect::toRoute('login/loginform');
        }else{
            if(AuthManager::getRole() != $role){
                Redirect::toRoute('login/loginform');
            }
        }
    }
}