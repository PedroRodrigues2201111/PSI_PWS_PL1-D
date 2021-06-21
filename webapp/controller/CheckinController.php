<?php
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Debug;

class CheckinController extends BaseAuthController implements ResourceControllerInterface
{
  // Função para retornar o form show
  public function show($id)
  {
    $user = User::find([$id]);

    if (is_null($user)) {

    } else {
      return View::make('user.show', ['user' => $user]);
    }
  }

  // Função para atualizar o index do user
  public function update($id)
  {
    $this->loginFilterByRole('admin');
    $user = User::find([$id]);
    $user->update_attributes(Post::getAll());

    if ($user->is_valid()) {
      $user->save();
      Redirect::toRoute('user/index');
    } else {
      Redirect::flashToRoute('user/edit', ['user' => $user]);
    }
  }

  // Função para apagar um user
  public function destroy($id)
  {
    $this->loginFilterByRole('admin');
    $user = User::find([$id]);
    $user->delete();
    Redirect::toRoute('user/index');
  }

  // Função para retornar o form do index
  public function index()
  {
    $this->loginFilterByRole('operadorcheckin');

    // Mostrar apenas os passageiros
    $users = User::all(array('conditions' => array('role = ? ', 'passageiro')));
    return view::make('checkin.index', ['users' => $users]);
  }

  // Função para retornar o form para criar um user
  public function create()
  {
    $this->loginFilterByRole('admin');
    View::make('user.create');
  }

  // Função para adicionar user's
  public function store()
  {
    $user = new User(Post::getAll());

    if ($user->is_valid()) {
      $user->save();
      Redirect::toRoute('user/index');
    } else {
      //redirect to form with data and errors
      Redirect::flashToRoute('user/create', ['user' => $user]);
    }
  }

  // Função para retornar o form para editar um user
  public function edit($id)
  {
    $user = User::find([$id]);

    if (is_null($user)) {
      //TODO redirect to standard error page
    } else {
      return View::make('checkin.edit', ['user' => $user]);
    }
  }
}
