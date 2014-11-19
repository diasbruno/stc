<?php

namespace STC;

class PageComponent
{
  public function build($files)
  {
    $pages = [];
    $files = $files->get_all();

    foreach($files as $file) {
      if ($file['type'] != 'page') continue;
      $pages[] = $file;
    }

    Config::db()->store_data('page_list', $pages);
  }
}
