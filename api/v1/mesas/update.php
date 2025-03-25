<?php
$data = [];
$data["capacidade"] = $_REQUEST["capacidade"];
$data["numero"] = $_REQUEST["numero"];
$data["disponivel"] = $_REQUEST["disponivel"];

$where = ["id" => $_GET["id"]];

if ($result = $DatabaseService->update($data, $where, $tabela)) {
  echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
  echo json_encode(
    ["error" => "Erro ao criar dado"],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
  );
}
