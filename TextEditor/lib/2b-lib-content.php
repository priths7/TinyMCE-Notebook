<?php
class Content {
  protected $pdo = null;
  protected $stmt = null;
  public $error = "";
  public $lastID = null;

  function __construct() {
  // __construct() : connect to the database
  // PARAM : DB_HOST, DB_CHARSET, DB_NAME, DB_USER, DB_PASSWORD

    // ATTEMPT CONNECT
    try {
      $str = "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET;
      if (defined('DB_NAME')) { $str .= ";dbname=" . DB_NAME; }
      $this->pdo = new PDO(
        $str, DB_USER, DB_PASSWORD, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false
        ]
      );
    }

    // ERROR - DO SOMETHING HERE
    // THROW ERROR MESSAGE OR SOMETHING
    catch (Exception $ex) {
      print_r($ex);
      die();
    }
  }

  function __destruct() {
  // __destruct() : close connection when done

    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

  function add($text) {
  // add() : create a new content page
  // PARAM $text : content text

    try {
      $this->stmt = $this->pdo->prepare("INSERT INTO `mydb.pages` (`content`) VALUES (?)");
      $this->stmt->execute([$text]);
      $this->lastID = $this->pdo->lastInsertId();
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
    $this->stmt = null;
    return true;
  }

  function edit($text, $id) {
  // edit() : update content page
  // PARAM $text : content text
  //       $id : content ID

    try {
      $this->stmt = $this->pdo->prepare("UPDATE `mydb.pages` SET `content`=? WHERE `UUID`=?");
      $this->stmt->execute([$text, $id]);
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
    $this->stmt = null;
    return true;
  }

  function get ($id) {
  // get : get content text
  // PARAM $id : content ID

    $result = [];
    try {
      $this->stmt = $this->pdo->prepare("SELECT * FROM `mydb.pages` WHERE `UUID`=?");
      $this->stmt->execute([$id]);
      $result = $this->stmt->fetchAll();
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
    $this->stmt = null;
    return count($result)==0 ? false : $result[0]['content'] ;
  }
}
?>