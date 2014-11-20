<?php

namespace STC;

/**
 * @author Bruno Dias <dias.h.bruno@gmail.com>
 * @license MIT License (see LICENSE)
 */
class DataLoader
{
  /**
   * @constructor
   */
  public function __construct() {}

  /**
   * Creates the handler and reads the files.
   * @param $file string | The filename.
   * @return string
   */
  private function read_file($file)
  {
    $handler = fopen($file, "r");
    $file_content = fread($handler, filesize($file));
    fclose($handler);

    return $file_content;
  }

  /**
   * Load the file.
   * @param $path string | The path where the file is located.
   * @param $file string | The filename.
   * @return string
   */
  public function load($path, $file)
  {
    $the_file = $path . '/' . $file;

    return json_decode($this->read_file($the_file), true);
  }
}
