<?php
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;

class PassengerController extends BaseAuthController
{
    public function index(){
        $this->loginFilterbyRole('passageiro');
        $flights = Flight::all();

        return view::make('passenger.index', ['flights'=>$flights]);
    }

    public function edit($id){
        $user = User::find([$id]);

        if (is_null($user)) {
            //TODO redirect to standard error page
        } else {
            return View::make('passenger.edit', ['user' => $user]);
        }
    }

    public function update($id){
        $user=User::find([$id]);
        $user->update_attributes(Post::getAll());

        if($user->is_valid()){
            $user->save();
            Redirect::toRoute('passenger/index');
        }else{
            Redirect::flashToRoute('user/edit', ['user' => $user]);
        }
    }
}