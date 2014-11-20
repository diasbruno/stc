<?php

namespace STC;

class PageComponent
{
  /**
   * The type.
   * @ar string
   */
  private $type;

  /**
   * @constructor
   */
  public function __construct()
  {
    $this->type = 'page';
  }

  /**
   * Build.
   */
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
