<?php
include_once __DIR__ . "/../../../global.php";
session_start();
if (!isset($_SESSION["usuario_logado"])) {
  !http_response_code(403);
  echo json_encode(
    ["error" => "Acesso negado"],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
  );
  die();
}

$DatabaseService = new DatabaseService();
$tabela = "pedido";

// Verifica o método HTTP (GET, POST, etc.)
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
  case "GET":
    // Inclui o arquivo read.php para requisições GET
    include_once "read.php";
    break;
  case "POST":
    // Inclui o arquivo insert.php para requisições POST
    include_once "create.php";
    break;
  case "PUT":
    // Inclui o arquivo update.php para requisições PUT
    include_once "update.php";
    break;
  case "DELETE":
    // Inclui o arquivo delete.php para requisições DELETE
    include_once "delete.php";
    break;
  default:
    // Caso o método não seja um dos esperados
    echo "Método não suportado.";
    break;
}

?>
