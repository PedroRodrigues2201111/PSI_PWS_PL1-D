<?php
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Redirect;

class AirportController extends BaseAuthController implements ResourceControllerInterface
{

    public function index()
    {
        $this->loginFilterByRole('admin');
        $airports = Airport::all();
        return view::make('airport.index', ['airports'=>$airports]);
    }

    public function create()
    {
        $this->loginFilterByRole('admin');
        View::make('airport.create');
    }

    /**
     * @return Returns
     */
    public function store()
    {
        $airport = new Airport(Post::getAll());

        if($airport->is_valid()){
            $airport->save();
            Redirect::toRoute('airport/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('airport/create', ['airport' => $airport]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $airport = Airport::find([$id]);

        if (is_null($airport)) {

        } else {
            return View::make('airport.show', ['airport' => $airport]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $airport = Airport::find([$id]);

        if (is_null($airport)) {

        } else {
            return View::make('airport.edit', ['airport' => $airport]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        $this->loginFilterByRole('admin');
        $airport=Airport::find([$id]);
        $airport->update_attributes(Post::getAll());

        if($airport->is_valid()){
            $airport->save();
            Redirect::toRoute('airport/index');
        }else{
            Redirect::flashToRoute('airport/edit', ['airport' => $airport]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->loginFilterByRole('admin');
        $airport = Airport::find([$id]);
        $airport->delete();
        Redirect::toRoute('airport/index');
    }
}