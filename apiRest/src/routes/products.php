<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = new \Slim\App;

//GET all Products

$app->get('/api/products', function(Request $request, Response $response){

    $sql = "SELECT * FROM product";

    try{
        $db = new db();
        $db = $db->conectDB();
        $resultado = $db->query($sql);

        if($resultado->rowCount() > 0){
            $Productos = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($Productos);
        }else{
            echo json_encode("No Existen Productos en la base de Datos");
        }

        $resultado = null;
        $db = null;


    }catch(PDOException $e){
        echo '{error : {"text":'.$e->getMessage().'}';
    };



    //echo 'all Products';

}
);