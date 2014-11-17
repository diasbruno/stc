<?php

namespace STC;

class Templates
{
  private $templates_path;
  private $templates;

  public function __construct()
  {
    $this->templates = [];
  }

  public function templates_path()
  {
    return $this->templates_path;
  }

  public function load($data_folder = '')
  {
    $this->templates_path = $data_folder . '/templates';

    $files = array_diff(
      scandir($this->templates_path),
      array('..', '.')
    );

    $pattern = '/^(\w+).phtml$/';

    foreach($files as $file) {
      if (preg_match($pattern, $file, $match)) {
        $this->templates[$match[1]] = $data_folder . '/' . $file;
      }
    }
  }

  public function template($key)
  {
    return $this->templates[$key];
  }

  public function count()
  {
    return count($this->templates);
  }
}
