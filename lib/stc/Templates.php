<?php

namespace STC;

class Templates
{
  private $templates;

  public function Templates()
  {
    $this->templates = [];
  }

  public function load($data_folder = '')
  {
    $files = array_diff(
      scandir($data_folder . '/templates'),
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
