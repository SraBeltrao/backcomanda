<?php
$select = false;
$where = false;
$unique = false;
if (!empty($_GET)) {
  if (isset($_GET["id"])) {
    $where = ["id" => $_GET["id"]];
    $unique = true;
  }
  if (isset($_GET["cozinha"])) {
    $where = ["cozinha" => $_GET["cozinha"]];
  }
}

$data = $DatabaseService->read($select, $where, $tabela, $unique);

if (isset($_GET["cozinha"])) {
  $data = array_map(function ($pedido) use ($DatabaseService) {
    $pedido["cardapio"] = $DatabaseService->read(
      false,
      ["id" => $pedido["cardapio_id"]],
      "cardapio",
      true
    );
    $comanda = $DatabaseService->read(
      false,
      ["id" => $pedido["comanda_id"]],
      "comanda",
      true
    );
    if ($comanda) {
      $mesa = $DatabaseService->read(
        false,
        ["id" => $comanda["mesa_id"]],
        "mesa",
        true
      );
      $pedido["mesa"] = $mesa["numero"];
      return $pedido;
    } else {
      return $pedido;
    }
  }, $data);
}

echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
