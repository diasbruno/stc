<?php

namespace STC;

/**
 * @author Bruno Dias <dias.h.bruno@gmail.com>
 * @license MIT License (see LICENSE)
 */
class Templates
{
  private $templates_path;
  private $templates;

  /**
   * @constructor
   */
  public function __construct()
  {
    $this->templates = [];
  }

  /**
   * Returns the templates path.
   * @return string
   */
  public function templates_path()
  {
    return $this->templates_path;
  }

  /**
   * Read a directory.
   * @param $folder string | The folder name.
   * @return array
   */
  private function read_dir($folder = '')
  {
    return array_diff(scandir($folder), array('..', '.'));
  }

  /**
   * Load files from a given directory.
   * @param $data_folder string | The folder name.
   * @return array
   */
  public function load($data_folder = '')
  {
    $this->templates_path = $data_folder . '/templates';

    $files = $this->read_dir($this->templates_path);

    $pattern = '/^(\w+).phtml$/';

    foreach($files as $file) {
      if (preg_match($pattern, $file, $match)) {
        $this->templates[$match[1]] = $file;
      }
    }
  }

  /**
   * Get the template by a key.
   * @param $key string | The key name.
   * @return string
   */
  public function template($key)
  {
    return $this->templates[$key];
  }

  /**
   * Get the number of loaded files.
   * @return int
   */
  public function count()
  {
    return count($this->templates);
  }
}
