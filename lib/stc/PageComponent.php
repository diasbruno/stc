<?php

namespace STC;

class PageComponent
{
  private $type;

  public function __construct()
  {
    $this->type = 'page';
  }

  public function build($files)
  {
    $pages = [];
    $files = $files->get_all();

    foreach($files as $file) {
      if ($file['type'] != $this->type) continue;
      $pages[] = $file;
    }

    Config::db()->store('page_list', $pages);
  }
}
