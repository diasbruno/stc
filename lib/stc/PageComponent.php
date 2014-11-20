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
   * Filter a file by it type - page.
   * @param $file array | Json file as array.
   * @return bool
   */
  public function filter_by_type($file)
  {
    return $file['type'] == $this->type;
  }

  /**
   * Build.
   */
  public function build($files)
  {
    $pages = [];
    $files = $files->filter_by(array(&$this, 'filter_by_type'));

    foreach($files as $file) {
      if ($file['type'] != $this->type) continue;
      $pages[] = $file;
    }

    Config::db()->store('page_list', $pages);
  }
}
