<?php
$where = ["id" => $_GET["id"]];
$data = $DatabaseService->read(false, $where, $tabela, true);

if ($result = $DatabaseService->delete($where, $tabela)) {
  $mesa = $DatabaseService->update(
    ["disponivel" => 1],
    ["id" => $data["mesa_id"]],
    "mesa"
  );
  echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
  echo json_encode(
    ["error" => "Erro ao remover dado"],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
  );
}
