<?php

namespace STC;

class DataLoader
{
  public function DataLoader() {}

  private function read_file($file)
  {
    $handler = fopen($file, "r");
    $file_content = fread($handler, filesize($file));
    fclose($handler);

    return $file_content;
  }

  public function load($path, $file)
  {
    $the_file = $path . '/' . $file;

    return json_decode($this->read_file($the_file));
  }
}
