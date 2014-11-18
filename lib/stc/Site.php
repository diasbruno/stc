<?php

namespace STC;

class Site extends Data
{
  public function __construct() {}

  public function load($data_folder = '')
  {
    $data_loader = new DataLoader();
    $this->data = $data_loader->load(
      $data_folder,
      '/config.json'
    );
  }

  public function name()
  {
    return $this->data['name'];
  }

  public function public_folder()
  {
    return $this->data['public_folder'];
  }
}
