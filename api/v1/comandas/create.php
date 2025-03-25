<?php
$data = [];
$data["mesa_id"] = $_REQUEST["mesa_id"];
$data["aberta"] = 1;
$data["total"] = $_REQUEST["total"];

if ($result = $DatabaseService->create($data, $tabela)) {
  $result = ["success" => $result];
  $mesa = $DatabaseService->update(
    ["disponivel" => 0],
    ["id" => $data["mesa_id"]],
    "mesa"
  );
  echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
  echo json_encode(
    ["error" => "Erro ao criar dado"],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
  );
}
