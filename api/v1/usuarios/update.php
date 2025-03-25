<?php
$data = [];
$data["nome"] = $_REQUEST["nome"];
$data["login"] = $_REQUEST["login"];
$data["senha"] = password_hash(trim($_REQUEST["senha"]), PASSWORD_DEFAULT);
$data["cargo"] = $_REQUEST["cargo"];
$data["funcao"] = $_REQUEST["funcao"];
$data["ativo"] = 1;
$where = ["id" => $_GET["id"]];

if ($result = $DatabaseService->update($data, $where, $tabela)) {
  echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
  echo json_encode(
    ["error" => "Erro ao criar dado"],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
  );
}
