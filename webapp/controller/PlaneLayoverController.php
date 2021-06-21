<?php
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;

class PlaneLayoverController extends BaseAuthController
{

    public function create($id)
    {
        $planes = Plane::all();

        View::make('planelayover.create',['planes' => $planes, 'idleg' => $id]);
    }

    /**
     * @return Returns
     */
    public function store()
    {
        $legplane = new Legplane(Post::getAll());

        if($legplane->is_valid()){
            $legplane->save();
            Redirect::toRoute('gestorvoo/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('planelayover/create', ['legplane' => $legplane]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $planelayover = Planelayover::find([$id]);

        if (is_null($planelayover)) {

        } else {
            return View::make('planelayover.show', ['planelayover' => $planelayover]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $planelayover = Planelayover::find([$id]);

        if (is_null($planelayover)) {

        } else {
            return View::make('planelayover.edit', ['planelayover' => $planelayover]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        $planelayover=Planelayover::find([$id]);
        $planelayover->update_attributes(Post::getAll());

        if($planelayover->is_valid()){
            $planelayover->save();
            Redirect::toRoute('layover/index');
        }else{
            Redirect::flashToRoute('planelayover/edit', ['planelayover' => $planelayover]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->loginFilterByRole('admin');
        $planelayover = Planelayover::find([$id]);
        $planelayover->delete();
        Redirect::toRoute('planelayover/index');
    }
}