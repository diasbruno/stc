<?php

namespace STC;

class Files
{
  private $files;

  private $data_path;

  /**
   * @constructor
   */
  public function __construct()
  {
    $this->data_path = '';
    $this->files = [];
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
  public function load($data_folder = '', $pages_data = '')
  {
    $this->data_path = '/' . $pages_data;
    $files = $this->read_dir($data_folder . $this->data_path);

    $pattern = '/(.+).json$/';

    $data_loader = new DataLoader();

    foreach($files as $file) {
      if (preg_match($pattern, $file, $match)) {
        $f = $data_loader->load(
          $data_folder . $this->data_path,
          $file
        );
        $f['file'] = $file;
        $this->files[] = $f;
      }
    }
  }

  /**
   * Get all loaded files.
   * @return array
   */
  public function get_all() { return $this->files; }

  /**
   * Execute a predicate and get back a list of files.
   * @param $fn Function | A function for the filter.
   * @return array
   */
  public function filter_by($fn) { return array_filter($this->files, $fn); }

  /**
   * Get the number of loaded files.
   * @return int
   */
  public function count() { return count($this->files); }
}
