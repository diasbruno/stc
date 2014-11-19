<?php

namespace STC;

use Cocur\Slugify\Slugify;

class PageRender
{
  const TYPE = 'page';

  private $slugify;

  /**
   * @constructor
   */
  public function __construct()
  {
    $this->slugify = new Slugify();
  }

  /**
   * Filter a file by it type - page.
   * @param $file array | Json file as array.
   * @return bool
   */
  public function filter_by_type($file)
  {
    return $file['type'] == PageRender::TYPE;
  }

  /**
   * Make the page slug.
   * @param $file array | Raw file data.
   * @param $tmpl array | Reference to the new file data.
   * @return void
   */
  private function make_slug($file, &$tmpl)
  {
    if (array_key_exists('is_index', $file)) {
      $tmpl['slug'] = '';
      printLn('===> Page link: /');
    } else {
      $tmpl['slug'] = $this->slugify->slugify($file['title']);
      printLn('===> Page link: ' . $tmpl['slug']);
    }
  }

  /**
   * Format a file to be rendered.
   * @param $template Template | A Template.
   * @param $file array | Json file as array.
   * @return array
   */
  private function make_data($file)
  {
    if (!array_key_exists('template', $file)) {
      throw new Exception('x> Current page: ' . $file['title'] . ' does not have a template.');
    }
    printLn('==> Current page: ' . $file['title'] . '.');

    $t = Config::templates()->template($file['template']);

    $tmpl = $file;
    $this->make_slug($file, $tmpl);

    $tmpl['html'] = view(Config::data_folder() . '/templates/' . $t, [
      'content' => view(Config::data_folder() . '/' . $file['content']),
      'post'=> $file,
    ]);

    printLn('');

    return $tmpl;
  }

  /**
   * Render function.
   * @param $files array | A list of all available entries.
   * @return void
   */
  public function render($files)
  {
    printLn('=> Start PageRender.');
    printLn('');
    $post_files = $files->filter_by(array(&$this, 'filter_by_type'));

    $t = Config::templates()->templates_path() . '/';

    $writer = new DataWriter();

    foreach($post_files as $file) {
      $tmpl = $this->make_data($file);
      $writer->write($tmpl['slug'], 'index.html', $tmpl['html']);
    }
    printLn('=> End PageRender.');
  }
}
