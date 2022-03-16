<?php
namespace src\mapper\DataMappers;
use src\Data;
use DateTime;
use DateTimeZone;
class DataMapper
{
  private $data;
  private $sql;
  private $date;
  private $datezone;
    public function __construct(Data\DataMysqli $data)
    {
      $this->data=$data;
      $this->date= new \DateTime();
      $this->datezone=$this->date->getTimezone();
      $this->date=$this->date->format('Y-m-d H:i:s');
      echo $this->date;
    }
    public function save(array $dane)
    {
      $this->sql="INSERT INTO mapper (Name,Data) VALUES (:Name,:Data)";
      $this->data = $this->data->connect()->prepare($this->sql);
      //$implode = implode($dane);
      $this->data->bindParam("Name",$dane[1]);
      $this->data->bindParam("Data",$this->date);
      $this->data->execute();
    }
}
?>
