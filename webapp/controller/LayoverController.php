<?php
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;

class LayoverController extends BaseAuthController
{

    public function index($id)
    {
        $layovers = Layover::all(array('conditions' => array('idflight = ?', $id)));
        $flight = Flight::find([$id]);

        return View::make('layover.index', ['layovers' => $layovers, 'flight' => $flight]);
    }

    public function create($id)
    {
        $airports = Airport::all();

        return View::make('layover.create',['airports' => $airports, 'idflight' => $id]);
    }

    public function store()
    {
        $layover = new Layover(Post::getAll());

        if($layover->is_valid()){
            $layover->save();
            Redirect::toRoute('flight/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('layover/create', ['layover' => $layover]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $layover = Layover::find([$id]);

        if (is_null($layover)) {

        } else {
            return View::make('layover.show', ['layover' => $layover]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $layover = Layover::find([$id]);
        $airports = Airport::all();

        if (is_null($layover)) {

        } else {
            return View::make('layover.edit', ['layover' => $layover, 'airports' => $airports]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        $layover=Layover::find([$id]);
        $layover->update_attributes(Post::getAll());

        if($layover->is_valid()){
            $layover->save();
            Redirect::toRoute('layover/index');
        }else{
            Redirect::flashToRoute('layover/edit', ['layover' => $layover]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $layover = Layover::find([$id]);
        $layover->delete();
        Redirect::toRoute('layover/index');
    }

    public function done($id)
    {

    }
}
