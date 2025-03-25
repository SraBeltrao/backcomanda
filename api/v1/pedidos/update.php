<?php
$data = [];
if (isset($_REQUEST["comanda_id"])) {
  $data["comanda_id"] = $_REQUEST["comanda_id"];
}
if (isset($_REQUEST["cardapio_id"])) {
  $data["cardapio_id"] = $_REQUEST["cardapio_id"];
}
if (isset($_REQUEST["quantidade"])) {
  $data["quantidade"] = $_REQUEST["quantidade"];
}
if (isset($_REQUEST["observacao"])) {
  $data["observacao"] = $_REQUEST["observacao"];
}
if (isset($_REQUEST["preco"])) {
  $data["preco"] = $_REQUEST["preco"];
}
if (isset($_REQUEST["status"])) {
  $data["status"] = $_REQUEST["status"];
}
if (isset($_REQUEST["garcom_id"])) {
  $data["garcom_id"] = $_REQUEST["garcom_id"];
}
$where = ["id" => $_GET["id"]];

if ($result = $DatabaseService->update($data, $where, $tabela)) {
  //Atualiza valor da comanda
  $data = $DatabaseService->read(false, $where, $tabela, true);
  recalacularComanda($data["comanda_id"]);
  echo json_encode(
    ["success" => $result],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
  );
} else {
  echo json_encode(
    ["error" => "Erro ao criar dado"],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
  );
}
