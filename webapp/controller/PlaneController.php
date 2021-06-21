<?php
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Redirect;

class PlaneController extends BaseAuthController implements ResourceControllerInterface
{

    /**
     * @return Returns
     */
    public function index()
    {
        $this->loginFilterByRole('gestorvoo');
        $planes = Plane::all();
        return view::make('plane.index', ['planes'=>$planes]);
    }

    /**
     * @return Returns
     */
    public function create()
    {
        View::make('plane.create');
    }

    /**
     * @return Returns
     */
    public function store()
    {
        $plane = new Plane(Post::getAll());

        if($plane->is_valid()){
            $plane->save();
            Redirect::toRoute('plane/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('plane/create', ['plane' => $plane]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $plane = Plane::find([$id]);

        if (is_null($plane)) {

        } else {
            return View::make('plane.show', ['plane' => $plane]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $plane = Plane::find([$id]);

        if (is_null($plane)) {

        } else {
            return View::make('plane.edit', ['plane' => $plane]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        $plane=Plane::find([$id]);
        $plane->update_attributes(Post::getAll());

        if($plane->is_valid()){
            $plane->save();
            Redirect::toRoute('plane/index');
        }else{
            Redirect::flashToRoute('plane/edit', ['plane' => $plane]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $plane = Plane::find([$id]);
        $plane->delete();
        Redirect::toRoute('plane/index');
    }
}