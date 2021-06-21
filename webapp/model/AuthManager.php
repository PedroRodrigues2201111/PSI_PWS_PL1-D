<?php
use ArmoredCore\WebObjects\Session;

class AuthManager
{
    public function setLogin($user)
    {
        Session::set('APPUSERID', $user->id);
        Session::set('APPUSERROLE', $user->role);
    }

    static public function isUserLogged()
    {
        return Session::has('APPUSERID');
    }

    static public function logOut()
    {
        Session::destroy();
    }

    static public function getRole()
    {
        if(self::isUserLogged())
        {
            return Session::get('APPUSERROLE');
        }else{
            return null;
        }
    }

    static public function getId()
    {
        if(self::isUserLogged())
        {
            return Session::get('APPUSERID');
        }else{
            return null;
        }
    }
}