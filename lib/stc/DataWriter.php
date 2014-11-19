<?php

namespace STC;

class DataWriter
{
  /**
   * @constructor
   */
  public function __construct() {}

  /**
   * Creates the handler and writes the files.
   * @param $file string | The filename.
   * @return string
   */
  private function write_to($file, $data)
  {
    $handler = fopen($file, "w");
    fwrite($handler, $data);
    fclose($handler);
  }

  /**
   * Write the file.
   * @param $path string | The path where the file is located.
   * @param $file string | The filename.
   * @param $content string | The file content.
   * @return string
   */
  public function write($path = '', $file = '', $content = '')
  {
    $the_path = Config::site()->public_folder() . '/' . $path;

    @mkdir($the_path, 0755, true);
    $this->write_to($the_path . '/'. $file, $content);
  }
}
