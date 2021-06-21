<?php
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Debug;

class LoginController extends HomeController
{
    public function getLoginForm(){
        return view::make('login.loginform');
    }

    public function doLogin(){
        $username = Post::get('username');
        $password = Post::get('password');

        $user = User::find_by_username_and_password($username, $password);

        if(!is_null($user))
        {
            $authman = new AuthManager();
            $authman->setLogin($user);
            $role = AuthManager::getRole();
            switch($role){

                // Caso efetue login como 'operadorcheckin' abre a página do operadorcheckin
                case 'operadorcheckin':
                  Redirect::toRoute('operadorcheckin/index');
                  break;
                case 'passageiro':
                    Redirect::toRoute('passenger/index', $user->id);
                    break;
                case 'admin':
                        Redirect::toRoute('admin/index');
                    break;
                case 'gestorvoo':
                        Redirect::toRoute('gestorvoo/index');
                    break;
            }
        }else{
            Redirect::toRoute('login/loginform');
        }
    }

    public function getRegistrationForm(){
        return view::make('login.registerform');
    }

    public function doRegistration(){
        $user = new user(Post::getall());
        $user->role='passageiro';
        if($user->is_valid()){
            $user->save();
            Redirect::toRoute('login/loginform');

        }else{
            \ArmoredCore\WebObjects\Debug::barDump($user);
            Redirect::flashToRoute('login/registerform', ['user' => $user]);
        }

    }
}
