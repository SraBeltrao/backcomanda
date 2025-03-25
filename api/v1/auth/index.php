<?php
include_once __DIR__ . "/../../../global.php";

$DatabaseService = new DatabaseService();
$tabela = "usuario";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $login = trim($_REQUEST["login"]);
  $senha = trim($_REQUEST["senha"]);

  $select = ["id", "login", "nome", "cargo", "funcao", "senha"];
  $where = ["login" => $login];

  $data = $DatabaseService->read($select, $where, $tabela, true);

  if (!empty($data)) {
    // Verificar a senha usando password_verify()
    if (password_verify($senha, $data["senha"])) {
      // Remover o hash da senha antes de enviar como resposta
      unset($data["senha"]);
      $data["access_token"] = session_id();
      $_SESSION["usuario_logado"] = $data;
      echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
      echo json_encode(
        ["error" => "Login ou senha inválidos"],
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
      );
    }
  } else {
    echo json_encode(
      ["error" => "Usuário não encontrado"],
      JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );
  }
} else {
  echo "Método não suportado.";
}
