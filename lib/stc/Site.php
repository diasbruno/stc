<?php

namespace STC;

class Site extends Data
{
  /**
   * @constructor
   */
  public function __construct() {}

  /**
   * Load files from a given directory.
   * @param $data_folder string | The folder name.
   * @return array
   */
  public function load($data_folder = '')
  {
    $data_loader = new DataLoader();
    $this->data = $data_loader->load(
      $data_folder,
      '/config.json'
    );
  }

  /**
   * Returns the name of the project.
   * @return string
   */
  public function name()
  {
    return $this->data['name'];
  }

  /**
   * Returns the name of the public folder
   * where all the files will be exported.
   * @return string
   */
  public function public_folder()
  {
    return $this->data['public_folder'];
  }
}
