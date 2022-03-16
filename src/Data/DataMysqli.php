<?php
namespace src\Data;
use pdo;
include('DataInterface.php');
include('../config/config.php');
class DataMysqli implements DataInterface
{
  private $host = HOST;
  private $nazwa = NAZWA;
  private $haslo = HASLO;
  private $db = DATA;
  private $typ = TYP;
  protected $data;
  protected $sql=NULL;
  protected $select;
  protected $from;
  protected $where;
  protected $on;
  protected $f;
  public function connect()
  {
    try
    {
      $this->data = new PDO($this->typ.':host='.$this->host.';dbname='.$this->db,
      $this->nazwa,
      $this->haslo,
      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $error)
    {
      echo $error ->getMessage();
      die();
    }
    return $this->data;
  }
  static public function sto($hah)
  {
    echo $hah+1;
  }
  public function ee()
  {
      $lol=100;
      DataMysqli::sto($lol);
  }
  public function GetFrom():string
  {
    return $this->f;
  }
    public function SetFrom(string $f)
  {
    $this->f=$f;
    return $this;
  }
  public function All()
  {
  $this->sql.="Select * from $this->f";
    return $this;
  }
  public function Select(array $query)
  {
      $this->select=implode(",",$query);
      $this->sql="Select $this->select from $this->f";
      return $this;
    }
  public function Where($query)
  {
    $this->sql.=" where $query";
    return $this;
  }
  public function Find_id(INT $id)
  {
      $this->sql="Select * from buty where id = $id";
      return $this;
  }
  public function Orderby($query)
  {
      $this->sql.=" ORDER BY $query";
      return $this;
  }
  public function INNER_JOIN($query)
  {
      $this->sql.=" INNER JOIN $query";
      return $this;
  }
  public function ON(array $query)
  {
      $query=implode(' ',$query);
      $this->sql.=" ON $query";
      return $this;
  }
  public function get()
  {
  /*$sql=array(
             'Select'=>isset($this->select)?$this->select:'*',
             'From'=>isset($this->from)?$this->from:'buty',
             'Where'=>$this->where,
             'ON'=>$this->on
           );
  array_walk($sql,function(&$v,$k){if(isset($v)){$v=$k.' '.$v;}});
  $sql=implode(' ',$sql);
  var_dump($sql);
  */
  $stmt=$this->data->prepare($this->sql);
  $stmt->execute();
  $result=$stmt->fetchAll();
  return $result;
  }

}
 ?>
