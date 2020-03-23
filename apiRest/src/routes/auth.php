<?php


 class auth {

public function authToken($token){
 if($token='123'){
     echo "token validado, el token es: ".$token;
 }else{
     echo "token incorrecto";
 }
}

}