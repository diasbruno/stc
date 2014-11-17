<?php

namespace STC;

class Files
{
  private $files;

  public function Files()
  {
    $this->files = [];
  }

  public function load($data_folder = '')
  {
    // get all templates file names
    $files = array_diff(
      scandir($data_folder . '/page-data'),
      array('..', '.')
    );

    $pattern = '/(.+).json$/';

    $data_loader = new DataLoader();

    // remove extention and make it the key
    foreach($files as $file) {
      if (preg_match($pattern, $file, $match)) {
        // set the template to the key.
        $this->files[] = $data_loader->load(
          $data_folder . '/page-data',
          $file
        );
      }
    }
  }

  public function count()
  {
    return count($this->files);
  }
}
