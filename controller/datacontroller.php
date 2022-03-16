<?php
namespace controller\datacontroller;
use src\Data;
use contex\contex_data;
use src\mapper\DataMappers;
use src\Convert\CSV;
include "../spl_auto.php";
class datacontroller
{
  public function __construct()
  {
    $Pdo_base=new Data\DataMysqli();
    //$Json_base = new Json();
    $Pdo_content = new contex_data\ContexData($Pdo_base);
    $mapps=new DataMappers\DataMapper($Pdo_base);
    $csv = new CSV\CSVConvert;
    //$Json_content = new Content($Json_base);
    /*$object=$Pdo_base->SetFrom('buty')->Select(['Cena'])->get();

      foreach($object as $value)
      {
        echo ' '.$value['Cena'];
      }
      //var_dump($object);
      $csv->SaveCsv($object);
    //$mapps->save($object);
    //$output=implode(', 'array_map(function($v){return $v}));
    */
    $object=$Pdo_base->ee();
  }
}
$controller = new datacontroller;
?>
