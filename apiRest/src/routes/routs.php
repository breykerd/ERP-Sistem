<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

//require archive
require ('auth.php');

// class and objet


$app = new \Slim\App;



//routs and functions


//GET all Products

$app->get('/api/v1/products', function(Request $request, Response $response){

    $sql = "SELECT * FROM product";

    try{
        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->query($sql);

        if($resultado->rowCount() > 0){
            $Productos = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($Productos);
        }else{
            echo json_encode('No Existen Productos en la base de Datos');
        }

        $resultado = null;
        $db = null;


    }catch(PDOException $e){
        echo '{error : {"text":'.$e->getMessage().'}';
    };




}
);

//GET ID Products

$app->get('/api/v1/products/{id}', function(Request $request, Response $response){

    $idProduct = $request->getAttribute('id');
    $sql = "SELECT * FROM product WHERE idProduct = $idProduct";

    try{
        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->query($sql);

        if($resultado->rowCount() > 0){
            $Productos = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($Productos);
        }else{
            echo json_encode('No Existen Productos en la base de Datos');
        }

        $resultado = null;
        $db = null;


    }catch(PDOException $e){
        echo '{error : {"text":'.$e->getMessage().'}';
    };




}
);

//POST ADD Products

$app->post('/api/v1/products/new', function(Request $request, Response $response){
    //request variable
    $name = $request->getParam('name');
    $description = $request->getParam('description');
    $reference = $request->getParam('reference');
    $image = $request->getParam('image');
    $status = $request->getParam('status');
    $itemCategory = $request->getParam('itemCategory');
    $inventory = $request->getParam('inventory');
    $tax = $request->getParam('tax');
    $category = $request->getParam('category');
    $price = $request->getParam('price');


    $sql = "INSERT INTO product (name, description, reference, image, status, itemCategory, inventory, tax, category, price) VALUE
            (:name, :description, :reference, :image, :status, :itemCategory, :inventory, :tax, :category, :price)";

    try{
        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->prepare($sql);

        $resultado->bindParam(':name',$name);
        $resultado->bindParam(':description',$description);
        $resultado->bindParam(':reference',$reference);
        $resultado->bindParam(':image',$image);
        $resultado->bindParam(':status',$status);
        $resultado->bindParam(':itemCategory',$itemCategory);
        $resultado->bindParam(':inventory',$inventory);
        $resultado->bindParam(':tax',$tax);
        $resultado->bindParam(':category',$category);
        $resultado->bindParam(':price',$price);

        $resultado->execute();
        echo json_encode('New product Add');

        $resultado = null;
        $db = null;

    }catch(PDOException $e){
        echo '{error : {"text":'.$e->getMessage().'}';
    };




}
);


$app->get('/api/v1/auth', function(Request $request, Response $response){

    $auth = new auth();


$header = getallheaders();
if(isset($header["auth"])){
    $tokenValitation = $auth->authToken($header["auth"]);

}else{
    $tokenValitation= "token no enviado invality error";
}

 //echo "este es el token de validacion: ".$tokenValitation;
 
 
 }
);