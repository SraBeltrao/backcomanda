<?php
$where = ["id" => $_GET["id"]];

if ($result = $DatabaseService->delete($where, $tabela)) {
  echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
  echo json_encode(
    ["error" => "Erro ao remover dado"],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
  );
}
