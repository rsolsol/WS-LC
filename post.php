<?php
include_once 'lib/nusoap.php';
//require 'clases/conexion.php';
require 'constructor/constructor.php';
$consultalic = new consulta_Licenia();
//$coneccion = new conexion();
//$coneccion = new Conexion_Sisdeci();
$servicio = new soap_server();
$ns = "urn:miserviciowsdl";
$servicio->configureWSDL("Webservis LicenciaFuncionamiento",$ns);
$servicio->schemaTargetNamespace = $ns;
//$consultalic = consulta_Licenia::listar();
$servicio->register("consulta_Licenia::listar", array('tipoDoc' => 'xsd:integer', 'numDoc' => 'xsd:integer'), array('return' => 'xsd:string'), $ns );

function Mifuncion($tipoDoc, $numDoc){

 $resultadoSuma = $num1 + $num2;
 $resultado = "El resultado de la suma de " . $num1 . "+" .$num2 . " es: " . $resultadoSuma;	
 return $resultado;
 
}
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$servicio->service($HTTP_RAW_POST_DATA); 

/*
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';  
$servidor->service($HTTP_RAW_POST_DATA); 
*/
/*
  listar todos los posts o solo uno
 */
/*
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id']))
    {
      //Mostrar un post
      $sql = $dbConn->prepare("SELECT * FROM posts where id=:id");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
      exit();
      }
    else {
      //Mostrar lista de post
      $sql = $dbConn->prepare("SELECT * FROM posts");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll()  );
      exit();
    }
}*/
?>