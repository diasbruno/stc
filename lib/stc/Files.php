<?php

namespace STC;

class Files
{
  private $files;

  private $data_path;

  public function __construct()
  {
    $this->data_path = '/' . Config::site()->get('pages_data');
    $this->files = [];
  }

  private function read_dir($folder = '')
  {
    return array_diff(scandir($folder), array('..', '.'));
  }

  public function load($data_folder = '')
  {
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

  public function get_all()
  {
    return $this->files;
  }

  public function filter_by($fn)
  {
    return array_filter($this->files, $fn);
  }

  public function count()
  {
    return count($this->files);
  }
}
