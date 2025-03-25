<?php
$data = [];
$data["nome"] = $_REQUEST["nome"];
$data["descricao"] = $_REQUEST["descricao"];
$data["preco"] = $_REQUEST["preco"];
$data["preco_promocional"] = $_REQUEST["preco_promocional"];
$data["disponivel"] = $_REQUEST["disponivel"];
$data["categoria"] = $_REQUEST["categoria"];
$data["serve_pessoas"] = $_REQUEST["serve_pessoas"];
$data["vegano"] = $_REQUEST["vegano"];

if ($result = $DatabaseService->create($data, $tabela)) {
  $result = ["success" => $result];
  echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
  echo json_encode(
    ["error" => "Erro ao criar dado"],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
  );
}
