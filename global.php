<?php
include_once __DIR__ . "/libs/Database.service.php";

function recalacularComanda($idComanda)
{
  global $DatabaseService;
  $pedidos = $DatabaseService->read(
    false,
    ["comanda_id" => $idComanda],
    "pedido",
    false
  );

  $total = 0;

  foreach ($pedidos as $item) {
    if ($item["status"] !== "Cancelado") {
      $total += $item["preco"];
    }
  }

  $comanda = $DatabaseService->update(
    ["total" => $total],
    ["id" => $idComanda],
    "comanda"
  );
}
