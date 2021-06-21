<?php
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Debug;

class PerfilController extends BaseAuthController implements ResourceControllerInterface
{
  public function show($id){
    $user = User::find([$id]);

    if (is_null($user)) {

    } else {
      return View::make('perfil.show', ['user' => $user]);
    }
  }

  public function update($id){
    $this->loginFilterByRole('admin');
    $user=User::find([$id]);
    $user->update_attributes(Post::getAll());

    if($user->is_valid()){
      $user->save();
      Redirect::toRoute('perfil/index');
    }else{
      Redirect::flashToRoute('perfil/edit', ['user' => $user]);
    }
  }

  public function destroy($id){
    $this->loginFilterByRole('admin');
    $user = User::find([$id]);
    $user->delete();
    Redirect::toRoute('perfil/index');
  }

  public function index()
  {
    $this->loginFilterByRole('passageiro');
    $users = User::all(array('conditions' => array('role = ?', 'passageiro')));
    return view::make('perfil.index', ['users'=>$users]);
  }

  public function create()
  {
    $this->loginFilterByRole('admin');
    View::make('perfil.create');
  }

  public function store()
  {
    $user = new User(Post::getAll());

    if($user->is_valid()){
      $user->save();
      Redirect::toRoute('perfil/index');
    } else {
      //redirect to form with data and errors
      Redirect::flashToRoute('perfil/create', ['user' => $user]);
    }
  }

  public function edit($id)
  {
    $user = User::find([$id]);

    if (is_null($user)) {
      //TODO redirect to standard error page
    } else {
      return View::make('perfil.edit', ['user' => $user]);
    }
  }
}
