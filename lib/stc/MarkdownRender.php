<?php

namespace STC;

/**
 * @author Bruno Dias <dias.h.bruno@gmail.com>
 * @license MIT License (see LICENSE)
 */
class MarkdownRender extends Render
{
  /**
   * @constructor
   */
  public function __construct()
  {
    $this->exts = array('md', 'markdown');
  }

  /**
   * Render the template with options.
   * @param $template string | The template name.
   * @param $options array | A hash with options to render.
   * @return string
   */
  public function render($template, $options = array())
  {
    $pre_render = view($template, $options);
    $md = new Parsedown();

    return $md->text($pre_render);
  }
}
