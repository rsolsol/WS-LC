<?php
include_once 'lib/nusoap.php';
//require 'clases/conexion.php';
require 'constructor/constructor.php';
$consultalic = new consulta_Licencia();
$servicio = new soap_server();
$ns = "urn:WebServiceMDPP_LF"; //LICENCIA DE FUNCIONAMIENTO
$servicio->configureWSDL("Webservice Licencia Funcionamiento",$ns);
$servicio->schemaTargetNamespace = $ns;
//$consultalic = consulta_Licenia::listar();
$servicio->register('consulta_Licencia.listar', array('tipoDoc' => 'xsd:integer', 'numDoc' => 'xsd:integer'), array('return' => 'xsd:array'), $ns );
/*
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$servicio->service($HTTP_RAW_POST_DATA); */
  $servicio->service(file_get_contents("php://input"));

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