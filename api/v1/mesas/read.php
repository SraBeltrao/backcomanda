<?php
$select = false;
$where = false;
$unique = false;
if (!empty($_GET) && isset($_GET["id"])) {
  $where = ["id" => $_GET["id"]];
  $unique = true;
} else {
  $select = ["id", "numero", "capacidade", "disponivel"];
}

$data = $DatabaseService->read($select, $where, $tabela, $unique);

if (!$unique) {
  $data = array_map(function ($mesa) use ($DatabaseService) {
    $mesa["comanda"] = $DatabaseService->read(
      false,
      ["mesa_id" => $mesa["id"], "aberta" => 1],
      "comanda",
      true
    );
    return $mesa;
  }, $data);
}

echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
