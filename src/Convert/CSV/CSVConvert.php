<?php
namespace src\Convert\CSV;
use src\Data;
class CSVConvert
{
  private $csv;
  private $fp;
  public const CSV = 'file.csv';
  public const LINE = 'auto_detect_line_endings';
    public function SaveCsv(array $csv)
    {
      $this->csv = $csv;
      $this->fp =fopen('file.csv','w');
      ini_set('auto_detect_line_endings',TRUE);
      foreach($this->csv as $fields)
      {
        fputcsv($this->fp,$fields,',');
      }
      fclose($this->fp);
    }
}

?>
