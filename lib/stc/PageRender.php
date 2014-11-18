<?php

namespace STC;

use Cocur\Slugify\Slugify;

class PageRender
{
  const TYPE = 'page';
  public function __construct() {}

  public function filter_by_type($file)
  {
    return $file['type'] == PageRender::TYPE;
  }

  private function make_data($template, $file)
  {
    if (!array_key_exists('template', $file)) {
      throw new Exception('x> Current page: ' . $file['title'] . ' does not have a template.');
    }
    printLn('==> Current page: ' . $file['title'] . '.');

    $t = Config::templates()->template($file['template']);
    $c = new \Template(Config::data_folder() . '/');

    $template->set('content', $c->fetch($file['content']));
    $template->set('post', $file);

    $tmpl = $file;
    $slugify = new Slugify();

    if (array_key_exists('is_index', $file)) {
      $tmpl['slug'] = '';
      printLn('===> Page link: /');
    } else {
      $tmpl['slug'] = $slugify->slugify($file['title']);
      printLn('===> Page link: ' . $tmpl['slug']);
    }
    $tmpl['html'] = $template->fetch($t);

    printLn('');

    return $tmpl;
  }

  public function render($files)
  {
    printLn('=> Start PageRender.');
    printLn('');
    $post_files = $files->filter_by(array(&$this, 'filter_by_type'));

    $t = Config::templates()->templates_path() . '/';
    $template = new \Template($t);

    $writer = new DataWriter();

    foreach($post_files as $file) {
      $tmpl = $this->make_data($template, $file);
      $writer->write($tmpl['slug'], 'index.html', $tmpl);
    }
    printLn('=> End PageRender.');
  }
}
