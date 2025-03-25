<?php
$where = ["id" => $_GET["id"]];

$pedido = $DatabaseService->read(false, $where, $tabela, true);
$data = $DatabaseService->read(false, $where, $tabela, true);
if ($result = $DatabaseService->delete($where, $tabela)) {
  //Atualiza valor da comanda

  recalacularComanda($data["comanda_id"]);

  echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
  echo json_encode(
    ["error" => "Erro ao remover dado"],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
  );
}
