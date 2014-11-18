<?php

namespace STC;

class Writer
{
  public function __construct() {}

  private function write_to($file, $data)
  {
    $handler = fopen($file, "w");
    fwrite($handler, $data);
    fclose($handler);
  }

  public function write($path = '', $filename = '', $file = [])
  {
    $the_path = Config::site()->public_folder() . '/' . $path;

    if (@mkdir($the_path, 0755, true)) {
    }
    $this->write_to($the_path . '/'. $filename, $file['html']);
  }
}
