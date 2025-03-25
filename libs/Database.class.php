<?php
include_once __DIR__ . "/../config.php";

/**
 * Classe de conexão ao banco de dados usando PDO no padrão Singleton.
 */
class Database
{
  protected static $db;

  private function __construct()
  {
    $db_host = DB_HOST;
    $db_name = DB_NAME;
    $db_user = DB_USER;
    $db_pass = DB_PASS;
    $db_port = DB_PORT;
    $db_driver = "mysql";

    // Ativar exibição de erros
    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    try {
      self::$db = new PDO(
        "$db_driver:host=$db_host; port=$db_port; dbname=$db_name",
        $db_user,
        $db_pass
      );

      self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Lança exceções em caso de erro

      // Configurações do banco
      self::$db->exec("SET NAMES utf8");
      self::$db->exec("SET SESSION sort_buffer_size=1024 * 1024");
    } catch (PDOException $e) {
      // Mostra o erro detalhado se houver falha na conexão
      die("Connection Error: " . $e->getMessage());
    }
  }

  public static function connect()
  {
    if (!self::$db) {
      new Database();
    }

    return self::$db;
  }
}
