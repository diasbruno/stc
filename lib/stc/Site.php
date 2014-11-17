<?php

namespace STC;

class Site
{
  private $config;
  
  public function Site() {}

  public function load($data_folder = '')
  {
    $data_loader = new DataLoader();
    $this->config = $data_loader->load(
      $data_folder,
      '/config.json'
    );
  }

  public function name()
  {
    return $this->config->name;
  }

  public function public_folder()
  {
    return $this->config->public_folder;
  }
}