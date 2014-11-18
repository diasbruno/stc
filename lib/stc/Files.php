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

  public function load($data_folder = '')
  {
    $files = array_diff(
      scandir($data_folder . $this->data_path),
      array('..', '.')
    );

    $pattern = '/(.+).json$/';

    $data_loader = new DataLoader();

    foreach($files as $file) {
      if (preg_match($pattern, $file, $match)) {
        $this->files[] = $data_loader->load(
          $data_folder . $this->data_path,
          $file
        );
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
