<?php
// Mostrar erros
ini_set("display_errors", 1);
error_reporting(E_ALL);

//Captura do front
$inputJSON = file_get_contents("php://input");
if (!empty($inputJSON)) {
  $_REQUEST = json_decode($inputJSON, true);
}

// Configurações de CORS
$origin = isset($_SERVER["HTTP_ORIGIN"]) ? $_SERVER["HTTP_ORIGIN"] : "*";

header("Access-Control-Allow-Origin: " . $origin); // Permite todas as origens
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Cabeçalhos permitidos
header("Content-Type: application/json; charset=utf-8"); // Garante imprimir em JSON

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
  http_response_code(200);
  exit();
}

//Banco de dados
define("DB_HOST", "localhost");
define("DB_NAME", "commanda_digital");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_PORT", "3306");
