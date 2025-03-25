<?php
$select = false;
$where = false;
$unique = false;
if (!empty($_GET) && !isset($_GET["id"])) {
  $where = ["id" => $_GET["id"]];
  $unique = true;
} else {
  $select = ["id", "login", "nome", "cargo", "funcao"];
}

$data = $DatabaseService->read($select, $where, $tabela, $unique);
echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
