<?php

require_once "Database.class.php";

/**
 * Classe para fazer as queries
 */
class DatabaseService
{
  private $pdo;

  /**
   * Injeta o PDO como dependência
   */
  public function __construct(PDO $pdo = null)
  {
    if ($pdo) {
      $this->pdo = $pdo;
    } else {
      require_once "Database.class.php";
      $this->pdo = Database::connect();
    }
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function create($array, $table)
  {
    try {
      if (!$table) {
        throw new Exception("Nome da tabela não fornecido.");
      }

      $string = "INSERT INTO {$table} SET ";
      $array = $this->removeEmpty($array);

      $sql = $this->criarInstrucao($array, false, $string);

      $st = $this->pdo->prepare($sql);

      foreach ($array as $k => &$val) {
        $st->bindValue(":" . $k, $val);
      }

      $st->execute();
      return $this->pdo->lastInsertId();
    } catch (PDOException $e) {
      return ["error" => "Erro na criação de registro: " . $e->getMessage()];
    }
  }

  public function update($array, $where, $table)
  {
    try {
      $string = "UPDATE {$table} SET ";
      $array = $this->removeEmpty($array);
      $sql = $this->criarInstrucao($array, $where, $string);

      $st = $this->pdo->prepare($sql);

      foreach ($array as $k => &$val) {
        $st->bindValue(":" . $k, $val === "NULL" ? null : $val);
      }
      foreach ($where as $k => &$val) {
        $st->bindValue(":" . $k, $val === "NULL" ? null : $val);
      }

      $st->execute();
      return $st->rowCount() > 0;
    } catch (PDOException $e) {
      return [
        "error" => "Erro na atualização de registro: " . $e->getMessage(),
      ];
    }
  }

  public function read(
    $array,
    $where,
    $table,
    $strict = false,
    $key_pair = false,
    $order = false
  ) {
    try {
      $string = "SELECT * FROM {$table} ";
      $sql = $this->criarInstrucaoCaptura($array, $where, $string);

      if ($order) {
        $sql .= " " . $order . " ";
      }

      $st = $this->pdo->prepare($sql);

      if ($where) {
        foreach ($where as $k => &$val) {
          $st->bindValue(":" . $k, $val);
        }
      }
      $st->execute();
      if ($strict && !$key_pair) {
        $result = $st->fetch(PDO::FETCH_ASSOC);
        return $result;
      } elseif (!$strict && !$key_pair) {
        $result = $st->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      } else {
        $result = $st->fetchAll(PDO::FETCH_KEY_PAIR);
        return $result;
      }
    } catch (PDOException $e) {
      return ["error" => "Erro na leitura de registro: " . $e->getMessage()];
    }
  }

  public function delete($where, $table)
  {
    try {
      $string = "DELETE FROM {$table} ";
      $sql = $this->criarInstrucaoExclusao($where, $string);

      $st = $this->pdo->prepare($sql);

      if ($where) {
        foreach ($where as $k => &$val) {
          $st->bindValue(":" . $k, $val);
        }
      }

      return $st->execute();
    } catch (PDOException $e) {
      return ["error" => "Erro na exclusão de registro: " . $e->getMessage()];
    }
  }

  /**
   * Sanitariza valores vazios
   **/
  private function removeEmpty($array)
  {
    $tmp = $array;
    foreach ($tmp as $key => $value) {
      if ($value == "" or $key == "tab") {
        unset($array[$key]);
      }
    }
    return $array;
  }

  private function criarInstrucao($array, $where, $string)
  {
    foreach ($array as $key => $value) {
      if ($value != "") {
        $string .= $key . " = :" . $key;
        end($array);
        $key_compare = key($array);
        if ($key_compare != $key) {
          $string .= ", ";
        }
      }
    }
    if ($where) {
      $string .= " WHERE ";
      foreach ($where as $key => $value) {
        if ($value != "") {
          $string .= $key . " = :" . $key;
          end($where);
          $key_compare = key($where);
          if ($key_compare != $key) {
            $string .= " AND ";
          }
        }
      }
    }
    return $string;
  }

  private function criarInstrucaoCaptura($array, $where, $string)
  {
    if ($array) {
      $tmp = "";
      foreach ($array as $key => $value) {
        if ($value != "") {
          $tmp .= $value;
          end($array);
          $key_compare = key($array);
          if ($key_compare != $key) {
            $tmp .= ", ";
          }
        }
      }
      $string = str_replace("*", $tmp, $string);
    }
    if ($where) {
      $string .= " WHERE ";
      foreach ($where as $key => $value) {
        if ($value != "") {
          $string .= $key . " = :" . $key;
          end($where);
          $key_compare = key($where);
          if ($key_compare != $key) {
            $string .= " AND ";
          }
        }
      }
    }
    return $string;
  }

  function criarInstrucaoExclusao($where, $string)
  {
    if ($where) {
      $string .= " WHERE ";
      foreach ($where as $key => $value) {
        if ($value != "") {
          $string .= $key . " = :" . $key;
          end($where);
          $key_compare = key($where);
          if ($key_compare != $key) {
            $string .= " AND ";
          }
        }
      }
    }
    return $string;
  }

  function truncate($text, $limit)
  {
    if (strlen($text) > $limit) {
      $text = substr($text, 0, $limit);
      $etc = "...";
      $text = $text . $etc;
    }
    return $text;
  }

  function validateDate($date, $format = "Y-m-d H:i:s")
  {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
  }

  function in_array_r($needle, $haystack, $strict = false)
  {
    foreach ($haystack as $item) {
      if (
        ($strict ? $item === $needle : $item == $needle) ||
        (is_array($item) && in_array($needle, $item, $strict))
      ) {
        return true;
      }
    }
    return false;
  }

  function formatAmericanDate($date)
  {
    $date = explode("/", $date);
    if (checkdate($date[1], $date[0], $date[2])) {
      return $date[2] . "-" . $date[1] . "-" . $date[0];
    } else {
      return false;
    }
  }

  function formatBrazilianDate($date)
  {
    $date = explode("-", $date);
    return $date[2] . "/" . $date[1] . "/" . $date[0];
  }

  function getMonths($date_ini, $date_end)
  {
    $diff = strtotime($date_end) - strtotime($date_ini);
    $months = floor($diff / (60 * 60 * 24 * 30));
    return $months;
  }

  function getFundingTime($t)
  {
    if ($t < 0) {
      $time = 0;
    } elseif ($t > 0 and $t < 7) {
      $time = 6;
    } elseif ($t > 6 and $t < 13) {
      $time = 12;
    } elseif ($t > 12 and $t < 19) {
      $time = 18;
    } elseif ($t > 18 and $t < 25) {
      $time = 24;
    } elseif ($t > 24 and $t < 37) {
      $time = 36;
    } elseif ($t > 36 and $t < 61) {
      $time = 48;
    } else {
      $time = 48;
    }
    return $time;
  }

  /*
   * returnJsonHttpResponse
   * @param $success: Boolean
   * @param $data: Object or Array
   */
  function returnJsonHttpResponse($cod, $data = null)
  {
    header("Content-type: application/json; charset=utf-8");
    http_response_code($cod);
    if (!empty($data)) {
      echo json_encode($data);
    }
    exit();
  }
}
