<?php

namespace STC;

/**
 * @author Bruno Dias <dias.h.bruno@gmail.com>
 * @license MIT License (see LICENSE)
 */
class DefaultRender
{
  /**
   * Store the list of extension that can be rendered by this renders.
   * @var array
   */
  private $exts; 

  /**
   * @constructor
   */
  public function __construct()
  {
    $this->exts = array('phtml', 'php');
  }

  /**
   * Return true if the extension is available.
   * @param $ext string | The file extension.
   * @return bool
   */
  public function can_use($ext = '')
  {
    return in_array($ext, $this->exts);
  }

  /**
   * Render the template with options.
   * @param $template string | The template name.
   * @param $options array | A hash with options to render.
   * @return string
   */
  public function render($template, $options = array())
  {
    return view($template, $options);
  }
}
