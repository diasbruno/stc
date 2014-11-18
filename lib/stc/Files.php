<?php

namespace STC;

class Files
{
  private $files;

  public function __construct()
  {
    $this->files = [];
  }

  public function load($data_folder = '')
  {
    $files = array_diff(
      scandir($data_folder . '/page-data'),
      array('..', '.')
    );

    $pattern = '/(.+).json$/';

    $data_loader = new DataLoader();

    foreach($files as $file) {
      if (preg_match($pattern, $file, $match)) {
        $this->files[] = $data_loader->load(
          $data_folder . '/page-data',
          $file
        );
      }
    }
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
