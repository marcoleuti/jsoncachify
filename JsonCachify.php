<?php
class JsonCachify
{
  private $data;

  public $filename;
  public $folder_cache_path = "";
  private $filepath;

  function __construct($filename, $folder_cache_path)
  {

    $folder = rtrim($folder_cache_path, '/');

    $this->filename = $filename;
    $this->folder_cache_path = $folder_cache_path;
    $this->filepath = $folder_cache_path . "/" . $filename;
  }

  public function get_filepath()
  {
    return $this->filepath;
  }

  public function cachify($data_to_append)
  {

    $this->folder_cache_path = rtrim($this->folder_cache_path, '/');
    $filepath = $this->filepath = $this->folder_cache_path . "/" . $this->filename;

    try {
      if (file_exists($filepath)) {
        $myfile = fopen($filepath, "r") or die("Unable to open file!");
      } else {
        $myfile = fopen($filepath, "r");
      }

      // Try to open existing file and convert it to JSON
      $filestream = fread($myfile, filesize($filepath));
      $filestream_decoded = json_decode($filestream);

      // Create empty JSON if file was empty
      if (!$filestream_decoded) {
        $filestream_decoded = array();
      }

      // Append new data to existing file
      $filestream_decoded = array_merge($filestream_decoded, $data_to_append);
      fclose($myfile);
      $myfile = fopen($filepath, "w") or die("Unable to open file!");
      fwrite($myfile, json_encode($filestream_decoded));
      fclose($myfile);

      return true;
    } catch (Exception $e) {
      echo 'Caught exception: ',  $e->getMessage(), "\n";
      return false;
    }
  }
}
