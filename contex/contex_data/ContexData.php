<?php
namespace contex\contex_data;
use src\Data;
class ContexData
{
  protected $data;
  protected $sql;
  protected $stmt=NULL;
  public function  __construct(Data\DataMysqli $db)
  {
    $this->data = $db->connect();
  }
}
?>
