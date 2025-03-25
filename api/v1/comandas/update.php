<?php
$data = [];
if (isset($_REQUEST["aberta"])) {
  $data["aberta"] = $_REQUEST["aberta"];
}
if (isset($_REQUEST["pago"])) {
  $data["pago"] = $_REQUEST["pago"];
}
$where = ["id" => $_GET["id"]];

$comanda = $DatabaseService->read(false, $where, $tabela, true);

if ($result = $DatabaseService->update($data, $where, $tabela)) {
  if (isset($_REQUEST["aberta"])) {
    if ($data["aberta"] === 0) {
      $mesa = $DatabaseService->update(
        ["disponivel" => 1],
        ["id" => $comanda["mesa_id"]],
        "mesa"
      );
    }
  }
  echo json_encode(
    ["success" => $result],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
  );
} else {
  echo json_encode(
    ["error" => "Erro ao atualizar dado"],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
  );
}
