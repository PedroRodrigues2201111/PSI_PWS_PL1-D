<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Redirect;

class HistoricoController extends BaseController implements ResourceControllerInterface
{

  public function index()
  {
    $flights = Flight::all();
    return view::make('historico.index', ['flights'=>$flights]);
  }

  public function create()
  {
    View::make('flight.create');
  }

  /**
   * @return Returns
   */
  public function store()
  {
    $flight = new Flight(Post::getAll());

    if($flight->is_valid()){
      $flight->save();
      Redirect::toRoute('flight/index');
    } else {
      //redirect to form with data and errors
      Redirect::flashToRoute('flight/create', ['flight' => $flight]);
    }
  }

  /**
   * @param $id
   * @return mixed
   */
  public function show($id)
  {
    $flight = Flight::find([$id]);

    if (is_null($flight)) {

    } else {
      return View::make('flight.show', ['flight' => $flight]);
    }
  }

  /**
   * @param $id
   * @return mixed
   */
  public function edit($id)
  {
    $flight = Flight::find([$id]);

    if (is_null($flight)) {

    } else {
      return View::make('flight.edit', ['flight' => $flight]);
    }
  }

  /**
   * @param $id
   * @return mixed
   */
  public function update($id)
  {
    $flight = Flight::find([$id]);
    $flight->update_attributes(Post::getAll());

    if($flight->is_valid()){
      $flight->save();
      Redirect::toRoute('flight/index');
    }else{
      Redirect::flashToRoute('flight/edit', ['flight' => $flight]);
    }
  }

  /**
   * @param $id
   * @return mixed
   */
  public function destroy($id)
  {
    $flight = Flight::find([$id]);
    $flight->delete();
    Redirect::toRoute('historico/index');
  }

  public function destroyall($id)
  {
    $flight = Flight::all([$id]);
    $flight->delete();
    Redirect::toRoute('historico/index');
  }
}
