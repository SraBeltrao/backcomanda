<?php
$data = [];
$data["comanda_id"] = $_REQUEST["comanda_id"];
$data["cardapio_id"] = $_REQUEST["cardapio_id"];
$data["quantidade"] = $_REQUEST["quantidade"];
$data["observacao"] = $_REQUEST["observacao"];
$data["status"] = $_REQUEST["status"];
$data["garcom_id"] = $_SESSION["usuario_logado"]["id"];

//Dados Adicionais
$comanda = $DatabaseService->read(
  false,
  ["id" => $data["comanda_id"]],
  "comanda",
  true
);
$cardapio = $DatabaseService->read(
  false,
  ["id" => $data["cardapio_id"]],
  "cardapio",
  true
);

//$preco = $cardapio["preco_promocional"]
//  ? $cardapio["preco_promocional"]
//  : $cardapio["preco"];

$preco = $cardapio["preco"];

$total = $comanda["total"] + $preco;
$comanda = $DatabaseService->update(
  ["total" => $total],
  ["id" => $data["comanda_id"]],
  "comanda"
);

//Preço
$data["preco"] = $cardapio["preco"];
$data["cozinha"] = $cardapio["cozinha"];

if ($result = $DatabaseService->create($data, $tabela)) {
  $result = ["success" => $result];

  //Atualiza valor da comanda
  recalacularComanda($data["comanda_id"]);

  echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
  echo json_encode(
    ["error" => "Erro ao criar dado"],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
  );
}
