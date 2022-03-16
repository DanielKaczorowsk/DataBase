<?php
namespace src\DataJson;
class DataJson implements datapdo{
  private $host = HOST;
  private $nazwa = NAZWA;
  private $haslo = HASLO;
  private $db = DATA;
  public function connect(){
    /*$data = new Mongo('mongodb://'.$host, array(
    'username' => $nazwa,
    'password' => $haslo,
    'db'       => $db
));*/
  }
}
?>
