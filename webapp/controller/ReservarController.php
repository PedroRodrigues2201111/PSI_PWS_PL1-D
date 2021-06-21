<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Redirect;

class ReservarController extends BaseController implements ResourceControllerInterface
{
  public function open()
  {
    $flights = Flight::all();
    return view::make('reservar.start', ['flights'=>$flights]);
  }

  public function reservar()
  {
    $flights = Flight::all();
    return view::make('reservar.detalhes', ['flights'=>$flights]);
  }

  public function index()
  {
    $flights = Flight::all();
    return view::make('reservar.index', ['flights'=>$flights]);
  }

  public function busca()
  {
    $flights = Flight::all();
    return view::make('reservar.busca', ['flights'=>$flights]);
  }

  public function create()
  {
    View::make('flight.create');
  }

  public function pesquisarorigem()
  {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "webapp";

    //Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

    $pesquisar = $_POST['pesquisar'];
    $result_pesquisa = "SELECT * FROM flights WHERE origem LIKE '%$pesquisar%' LIMIT 5";
    $resultado_pesquisa = mysqli_query($conn, $result_pesquisa);

    if ($rows_pesquisa = mysqli_fetch_array($resultado_pesquisa)) {
      echo "Origem encontrada: " . $rows_pesquisa['origem'] . "<br>";
    } else {
      echo "Não foram encontradas origens com o seguinte resultado: " . $pesquisar . "<br>";
    }
  }

  // Função para pesquisar o destino
  public function pesquisadestino()
  {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "webapp";

    //Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

    $pesquisar = $_POST['pesquisar'];
    $result_pesquisa = "SELECT * FROM flights WHERE destino LIKE '%$pesquisar%' LIMIT 5";
    $resultado_pesquisa = mysqli_query($conn, $result_pesquisa);

    if ($rows_pesquisa = mysqli_fetch_array($resultado_pesquisa)) {
      echo "Destino encontrado: " . $rows_pesquisa['destino'];
    } else {
      echo "Não foram encontrados destinos com o seguinte resultado: " . $pesquisar;
    }
  }

  public function pesquisardataorigem()
  {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "webapp";

    //Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

    $pesquisar = $_POST['pesquisar'];
    $result_pesquisa = "SELECT * FROM flights WHERE dtorigin LIKE '%$pesquisar%' LIMIT 5";
    $resultado_pesquisa = mysqli_query($conn, $result_pesquisa);

    if ($rows_pesquisa = mysqli_fetch_array($resultado_pesquisa)) {
      echo "Data de origem encontrada: " . $rows_pesquisa['dtorigin'] . "<br>";
    } else {
      echo "Não foram encontradas origens com a seguinte data: " . $pesquisar . "<br>";
    }
  }

  public function pesquisardatadestino()
  {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "webapp";

    //Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

    $pesquisar = $_POST['pesquisar'];
    $result_pesquisa = "SELECT * FROM flights WHERE dtdestination LIKE '%$pesquisar%' LIMIT 5";
    $resultado_pesquisa = mysqli_query($conn, $result_pesquisa);

    if ($rows_pesquisa = mysqli_fetch_array($resultado_pesquisa)) {
      echo "Data de destino encontrada: " . $rows_pesquisa['dtdestination'] . "<br>";
    } else {
      echo "Não foram encontrados destinos com a seguinte data: " . $pesquisar . "<br>";
    }
  }

  /**
   * @return Returns
   */
  public function store()
  {
    $flight = new Flight(Post::getAll());

    if($flight->is_valid()){
      $flight->save();
      Redirect::toRoute('reservar/pagamento');
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
      return View::make('reservar.detalhes', ['flight' => $flight]);
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
      Redirect::toRoute('reservar/pagamento');
    }else{
      Redirect::flashToRoute('reservar/detalhes', ['flight' => $flight]);
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
    Redirect::toRoute('reservar/pagamento');
  }

}

