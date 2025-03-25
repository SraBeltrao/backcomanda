<?php
$select = false;
$where = false;
$unique = false;

if (!empty($_GET) && isset($_GET["id"])) {
  $where = ["id" => $_GET["id"]];
  $unique = true;
} else {
  $select = [
    "id",
    "mesa_id",
    "aberta",
    "criado_em",
    "atualizado_em",
    "total",
    "pago",
  ];
}

$data = $DatabaseService->read(
  $select,
  $where,
  $tabela,
  $unique,
  false,
  "ORDER BY aberta, atualizado_em DESC"
);
if ($unique) {
  $data["pedidos"] = $DatabaseService->read(
    false,
    ["comanda_id" => $where["id"]],
    "pedido"
  );

  $data["pedidos"] = array_map(function ($pedido) use ($DatabaseService) {
    $pedido["item"] = $DatabaseService->read(
      false,
      ["id" => $pedido["cardapio_id"]],
      "cardapio",
      true
    );
    return $pedido;
  }, $data["pedidos"]);

  $data["mesa"] = $DatabaseService->read(
    false,
    ["id" => $data["mesa_id"]],
    "mesa"
  );
} else {
  $data = array_map(function ($comanda) use ($DatabaseService) {
    $comanda["mesa"] = $DatabaseService->read(
      false,
      ["id" => $comanda["mesa_id"]],
      "mesa",
      true
    );
    return $comanda;
  }, $data);
}

echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
