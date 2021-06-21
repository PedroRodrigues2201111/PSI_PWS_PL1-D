<?php
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Debug;

class UserController extends BaseAuthController implements ResourceControllerInterface
{
    public function show($id){
        $user = User::find([$id]);

        if (is_null($user)) {

        } else {
            return View::make('user.show', ['user' => $user]);
        }
    }

    public function update($id){
        $this->loginFilterByRole('admin');
        $user=User::find([$id]);
        $user->update_attributes(Post::getAll());

        if($user->is_valid()){
            $user->save();
            Redirect::toRoute('user/index');
        }else{
            Redirect::flashToRoute('user/edit', ['user' => $user]);
        }
    }

    public function destroy($id){
        $this->loginFilterByRole('admin');
        $user = User::find([$id]);
        $user->delete();
        Redirect::toRoute('user/index');
    }

    public function index()
    {
        $this->loginFilterByRole('admin');
        $users = User::all(array('conditions' => array('role = ? OR role = ? OR role = ?', 'gestorvoo', 'operadorcheckin', 'admin')));
        return view::make('user.index', ['users'=>$users]);
    }

    public function create()
    {
        $this->loginFilterByRole('admin');
        View::make('user.create');
    }

    public function store()
    {
        $user = new User(Post::getAll());

        if($user->is_valid()){
            $user->save();
            Redirect::toRoute('user/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('user/create', ['user' => $user]);
        }
    }

    public function edit($id)
    {
        $user = User::find([$id]);

        if (is_null($user)) {
            //TODO redirect to standard error page
        } else {
            return View::make('user.edit', ['user' => $user]);
        }
    }
}